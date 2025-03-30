<?php
require "d_head.php";
$stmt = $conn->prepare("SELECT l_token FROM `users` WHERE `username` = ?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user['l_token'] == isset($_SESSION['token']) && isset($_SESSION['username']) && session_status() === PHP_SESSION_ACTIVE && $_SESSION['usertype'] == 'radmin') {

    require "menu.php";

?>


<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">New Orders
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
                <li class="breadcrumb-item text-muted">Orders</li>
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

            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Table Name</th>
                                <th>Date & Time</th>
                                <th>Order Description</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 1;
                                $uid = $_SESSION['uid'];
                                $sql = "SELECT orders.o_id, orders.timestamp, r_table.tablename, orders.menu_item, orders.total,  orders.uid FROM orders LEFT JOIN r_table ON orders.table_id = r_table.tableid where orders.uid = $uid;";
                                $stmt = $conn->prepare($sql);
                                //    $stmt->bind_param("s", $roll);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()) {
                                ?>
                            <tr>
                                <form target="_blank" action="billprint.php" method="GET">
                                    <input type="hidden" name="o_id" value="<?php echo $row['o_id'];?>">
                                    <td><?php echo $id;
                                            $id++; ?> </td>
                                    <td><?= $row['tablename'] ?></td>
                                    <td><?= $row['timestamp'] ?></td>
                                    <td><?php $receivedArray = json_decode($row['menu_item'], true);

                                            $length = count($receivedArray);


                                            for ($i = 0; $i < $length; $i++) {
                                                $mid = $receivedArray[$i]['id'];
                                                $sql1 = "SELECT `m_id`, `uid`, `item`, `price`, `avaibility`, `rating`, `d_price` FROM `r_menu` WHERE m_id ='$mid';";
                                                $result1 = $conn->query($sql1);

                                                if ($result1->num_rows > 0) {
                                                    // output data of each row
                                                    while ($row1 = $result1->fetch_assoc()) {
                                                        echo $row1['item'];
                                                        echo " X ";
                                                        echo $receivedArray[$i]['qty'];
                                                        echo " * ";
                                                        echo $receivedArray[$i]['price'];
                                                        echo "<br>";
                                                    }
                                                }
                                            } ?>
                                    </td>
                                    <td><?= $row['total'] ?></td>
                                    <td><button type="submit" class="btn btn-success btn-sm">Print</button></td>

                                </form>
                            </tr>
                            <?php } ?>

                        </tbody>

                    </table>
                </div>
            </div>

        </div>

    </div>

</div>
<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>

<?php require "footer.php";
} else {
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>