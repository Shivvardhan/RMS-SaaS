<?php
require "d_head_t.php";
$stmt = $conn->prepare("SELECT l_token FROM `t_users` WHERE `username` = ?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user['l_token'] == isset($_SESSION['token']) && isset($_SESSION['username']) && session_status() === PHP_SESSION_ACTIVE) {
    require "menu_t.php"; ?>


<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Place Order!!
            </h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="dash.php" class="text-muted text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Dashboards</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->



        </div>

    </div>
    <!--end::Toolbar container-->
</div>

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">

    <div id="kt_app_content_container" class="app-container container-fluid">

        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

            <div id="orderDiv" class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                <?php
    if (isset($_POST['cartBtn'])) {

        // Get the JSON payload from the request
        $jsonPayload = $_POST['payload'];


        // Decode the JSON payload into a PHP array
        $receivedArray = json_decode($jsonPayload, true);


        $subarrays = [];
        foreach ($receivedArray as $item) {
            $id = $item['id'];
            if (!isset($subarrays[$id])) {
                $subarrays[$id] = [$item];
            } else {
                $subarrays[$id][] = $item;
            }
        }

        
        $result = array_values($subarrays);
        
        $maxQtyItems = [];
            
        foreach ($result as $subarray) {
            $maxQty = 0;
            $maxQtyItem = null;
            
            foreach ($subarray as $item) {
                if ($item['qty'] > $maxQty) {
                    $maxQty = $item['qty'];
                    $maxQtyItem = $item;
                }
            }
            
            if ($maxQtyItem !== null) {
                $maxQtyItems[] = $maxQtyItem;
            }
        }

        $length = count($maxQtyItems);

        $totalAmount = 0;
        $totalQty = 0;
        $placeOrder = json_encode($maxQtyItems);

        

        // Access the received array
        for ($i = 0; $i < $length; $i++) {
            $mid = $maxQtyItems[$i]['id'];

            $sql = "SELECT `m_id`, `uid`, `item`, `price`, `avaibility`, `rating`, `d_price` FROM `r_menu` WHERE m_id ='$mid';";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {

    ?>
                <div
                    style="width:80%;margin-bottom:20px;border:1px solid #F75D59;padding:20px;padding-bottom:10px;border-radius:10px;background-color:#FFFFFF;">
                    <div style="display:flex;">
                        <div style="display:grid;">
                            <h3><?php echo $row['item']?></h3>
                            <h3>₹<?php $totalAmount += $row['d_price'] * $maxQtyItems[$i]['qty'];  echo $row['d_price'] * $maxQtyItems[$i]['qty'];?>
                            </h3>
                        </div>
                        <div style="display:flex; flex-grow: 1; justify-content: flex-end;">
                            <div style="display:grid;">
                                <h3>Qty</h3>
                                <h3 style="padding-left:10px;">
                                    <?php $totalQty += $maxQtyItems[$i]['qty']; echo $maxQtyItems[$i]['qty'];?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                            }    
            }
                 }
    }
    ?>
                <form action="#" method="POST">
                    <input type="hidden" name="tableId" id="tableId" value="<?php echo $_SESSION['tableid'];?>">
                    <input type="hidden" name="UId" id="UId" value="<?php echo $_SESSION['uid'];?>">
                    <input type="hidden" name="total" id="total" value="<?php echo $totalAmount;?>">
                    <input type="hidden" name="quantity" id="quantity" value="<?php echo $totalQty;?>">
                    <input type="hidden" name="menuItem" id="menuItem"
                        value="<?php echo htmlspecialchars(json_encode($placeOrder)) ?>">
                    <button href="#" type="submit" name="placeOrderBtn" class="btn btn-danger hover-elevate-up">
                        <div style="display:flex;gap:2rem;">
                            <div style="display:grid;line-height:0.8;">
                                <p style="font-size:12px;margin-bottom:05px;">₹<?php echo $totalAmount; ?></p>
                                <p style="line-height:0;font-size:12px;color:#F5F5DC;margin-bottom:0px;">Total</p>
                            </div>
                            <div>
                                Place
                                Order
                                <span class="menu-icon" style="margin-right:5px;">
                                    <span class="svg-icon svg-icon-2">
                                        <i style="font-size:1.5rem;" class="fa-duotone fa-angles-right "></i>
                                    </span>
                                </span>
                            </div>
                        </div>

                    </button>
                </form>
                <?php
                
                if(isset($_POST['placeOrderBtn'])) {
                    $tableid = $_POST['tableId'];
                    $uid = $_POST['UId'];
                    $total = $_POST['total'];
                    $quantity = $_POST['quantity'];
                    $menuItem = json_decode($_POST['menuItem'], true);

                    $sql = $query = "INSERT INTO `orders`( `table_id`, `uid`, `total`, `menu_item`, `quanity`) VALUES ('$tableid','$uid','$total','$menuItem','$quantity')";

                                                        if ($conn->query($sql) === TRUE) {
                                                    ?>

                <script>
                var div = document.getElementById("orderDiv");
                div.style.display = "none";
                Swal.fire({
                    text: "Your Order has been placed successfully!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function() {
                    window.location = "dash_t.php";
                });
                </script>

                <?php
                                                        } else {
                                                            echo "Error: " . $sql . "<br>" . $conn->error;
                                                        }
                                                    }

                ?>
            </div>

        </div>

    </div>

</div>

<!--end::Content wrapper-->

<?php require "footer_t.php";
} else {
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>