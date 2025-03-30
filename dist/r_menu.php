<?php
require "d_head.php";
$stmt = $conn->prepare("SELECT l_token FROM `users` WHERE `username` = ?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user['l_token'] == isset($_SESSION['token']) && isset($_SESSION['username']) && session_status() === PHP_SESSION_ACTIVE && $_SESSION['usertype']) {
    require "menu.php"; ?>


    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Default</h1>
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
                    <li class="breadcrumb-item text-muted">Menu</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->



            </div>

        </div>
        <!--end::Toolbar container-->
    </div>

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">

            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack" style="justify-content: flex-end;">

                <a href="#" class="btn btn-primary hover-elevate-up" data-bs-toggle="modal" data-bs-target="#kt_modal_stacked_1">Add New Item</a>

            </div>
        </div>

        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">

            <div class="container">
                <div class="screen-togo">
                    <h2 style="margin-bottom:70px;text-align:center">Menu</h2>
                    <ul class="menu1-items">
                        <?php

                        $uid = $_SESSION['uid'];


                        $sql = "SELECT * FROM `r_menu` WHERE `uid`='$uid'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {

                        ?>

                                <!--    Menu Item Start    -->
                                <li class="menu1-item">
                                    <img src="uploads/<?php echo $row['image']; ?>" alt="item image" class="menu1-image">
                                    <div class="menu1-item-dets">
                                        <div>
                                            <p class="menu1-item-heading" style="font-weight:700;text-transform:capitalize;">
                                                <?php echo $row['item'] ?></p>
                                            <p style="width:80%" class="menu1-item-heading">
                                                <?php echo $row['description'] ?></p>

                                        </div>
                                        <div style="display:flex;justify-content:end;margin-top:-10%;margin-right:5px;">
                                            <button data-bs-toggle="modal" data-bs-target="#kt_modal_<?php echo $row['m_id']; ?>" type="button" style="margin-right:2%" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                            <!-- Modal Start -->
                                            <div class="modal fade" tabindex="-1" id="kt_modal_<?php echo $row['m_id']; ?>">
                                                <div class="modal-dialog">
                                                    <form method="POST" action="#">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title">Update Item Detail's</h3>

                                                                <!--begin::Close-->
                                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i class="fa fa-times fs-1"><i class="path1"></i><i class="path2"></i></i>
                                                                </div>
                                                                <!--end::Close-->
                                                            </div>

                                                            <div class="modal-body">
                                                                <input type="hidden" class="form-control" name="m_id" value="<?php echo $row['m_id']; ?>" />

                                                                <!--begin::Input group-->
                                                                <div class="form-floating mb-7">
                                                                    <input name="iname" type="text" class="form-control" id="item" value="<?php echo $row['item']; ?>" />
                                                                    <label for="item">Item Name</label>
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="form-floating mb-7">
                                                                    <input name="desc" type="text" class="form-control" id="desc" value="<?php echo $row['description']; ?>" value="test@example.com" />
                                                                    <label for="phone">Item Description</label>
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!-- script for getting file -->
                                                                <!-- start -->
                                                                <script>
                                                                    function setFileValue() {
                                                                        var fileInput = document.getElementById('fileInput');
                                                                        fileInput.click();
                                                                    }
                                                                </script>
                                                                <!-- end -->


                                                                <!--begin::Input group-->
                                                                <div class="form-floating mb-7">
                                                                    <input type="number" name="price" class="form-control" id="price" placeholder="Enter Item Price" value="<?php echo $row['price']; ?>" />
                                                                    <label for="price">Item Price</label>
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="form-floating mb-7">
                                                                    <input type="number" name="dprice" class="form-control" id="d_price" placeholder="Enter Item Discount Price" value="<?php echo $row['d_price']; ?>" />
                                                                    <label for="d_price">Item Discounted Price</label>
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="form-floating mb-7">
                                                                    <select name="avail" class="form-select" id="avail" aria-label="Select example">
                                                                        <option value="<?php echo $row['avaibility']; ?>">
                                                                            <?php echo $row['avaibility']; ?></option>
                                                                        <?php if ($row['avaibility'] == 'Out of stock') { ?>
                                                                            <option value="In-stock">In-stock</option>
                                                                        <?php } ?>
                                                                        <?php if ($row['avaibility'] == 'In-stock') { ?>
                                                                            <option value="Out of stock">Out of stock</option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <label for="avail">Item Availability</label>
                                                                </div>

                                                                <!--end::Input group-->

                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                    </form>

                                                    <!-- Updating data with PHP code -->
                                                    <!-- Start Code -->
                                                    <?php

                                                    if (isset($_POST["submit"])) {
                                                        $m_id = $_POST['m_id'];
                                                        $iname = $_POST['iname'];
                                                        $desc = $_POST['desc'];
                                                        $price = $_POST['price'];
                                                        $dprice = $_POST['dprice'];
                                                        $avail = $_POST['avail'];

                                                        $sql = $query = "UPDATE `r_menu` SET `item`='$iname',`description`='$desc',`price`='$price',`avaibility`='$avail',`d_price`='$dprice' WHERE m_id='$m_id';";

                                                        if ($conn->query($sql) === TRUE) {
                                                    ?>

                                                            <script>
                                                                Swal.fire({
                                                                    text: "Your Item detail's has been updated successfully!",
                                                                    icon: "success",
                                                                    buttonsStyling: false,
                                                                    confirmButtonText: "Ok, got it!",
                                                                    customClass: {
                                                                        confirmButton: "btn btn-primary"
                                                                    }
                                                                }).then(function() {
                                                                    window.location = "r_menu.php";
                                                                });
                                                            </script>

                                                    <?php
                                                        } else {
                                                            echo "Error: " . $sql . "<br>" . $conn->error;
                                                        }
                                                    }
                                                    ?>
                                                    <!-- End Code -->


                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal End -->
                                        <form action="#" method="POST">

                                            <button type="submit" name="update<?php echo $row['m_id'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                        <?php
                                        if (isset($_POST["update" . $row['m_id']])) {
                                            $mid = $row['m_id'];
                                            $sql = "DELETE FROM `r_menu` WHERE m_id='$mid';";

                                            if ($conn->query($sql) === TRUE) {
                                        ?>

                                                <script>
                                                    Swal.fire({
                                                        text: "Your Item has been deleted successfully!",
                                                        icon: "success",
                                                        buttonsStyling: false,
                                                        confirmButtonText: "Ok, got it!",
                                                        customClass: {
                                                            confirmButton: "btn btn-primary"
                                                        }
                                                    }).then(function() {
                                                        window.location = "r_menu.php";
                                                    });
                                                </script>

                                        <?php
                                            } else {
                                                echo "Error: " . $sql . "<br>" . $conn->error;
                                            }
                                        }
                                        ?>

                                    </div>
                                    <div style="display:flex;justify-content:end;margin-top:5px;">
                                        <button data-bs-toggle="modal" data-bs-target="#kt_modal_update<?php echo $row['m_id']; ?>" type=" submit" name="delete<?php echo $row['m_id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-camera" aria-hidden="true"></i>Update
                                            Image</button>
                                    </div>

                                    <!-- Update image code start -->
                                    <div class="modal fade" tabindex="-1" id="kt_modal_update<?php echo $row['m_id']; ?>">
                                        <div class="modal-dialog modal-dialog-centered" style="max-width:700px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Update Image</h3>

                                                    <!--begin::Close-->
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="fa fa-times fs-1"><i class="path1"></i><i class="path2"></i></i>
                                                    </div>
                                                    <!--end::Close-->
                                                </div>

                                                <form method="POST" enctype="multipart/form-data" action="#">

                                                    <div class="modal-body">

                                                        <div class="form-floating mb-7">
                                                            <input type="file" name="image" class="form-control" id="image" placeholder="Select Image For Item" />
                                                            <label for="image">Item Image</label>
                                                        </div>
                                                        <!--end::Input group-->



                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" id="submit" name="update1" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>

                                                <?php
                                                if (isset($_POST["update1"])) {
                                                    $id = $row['m_id'];
                                                    echo "<script>console.log('hello')</script>";
                                                    echo "<script>console.log('" . $_FILES['image'] . " ')</script>";
                                                    if (isset($_FILES["image"])) {
                                                        $targetDir = "uploads/"; // Directory where the uploaded images will be stored
                                                        $targetFile = $targetDir . basename($_FILES["image"]["name"]); // File path of the uploaded image
                                                        $imageFileType = mb_strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // File extension of the uploaded image

                                                        // Generate new file name with MD5 hash of current date/time
                                                        $newFileName = md5(date("YmdHis")) . "." . $imageFileType;
                                                        $targetFile = $targetDir . $newFileName;


                                                        // Check if the uploaded file is a valid image
                                                        $allowedExtensions = array("jpg", "jpeg", "png", "gif",);
                                                        echo "<script>console.log('" . $targetFile . "')</script>";
                                                        if (in_array($imageFileType, $allowedExtensions)) {
                                                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {

                                                                $query = "UPDATE `r_menu` SET `image`='$newFileName' WHERE m_id='$id';";

                                                                mysqli_query($conn, $query);
                                                ?>

                                                                <script>
                                                                    Swal.fire({
                                                                        text: "Your Item Image has been updated successfully!",
                                                                        icon: "success",
                                                                        buttonsStyling: false,
                                                                        confirmButtonText: "Ok, got it!",
                                                                        customClass: {
                                                                            confirmButton: "btn btn-primary"
                                                                        }
                                                                    }).then(function() {
                                                                        window.location = "r_menu.php";
                                                                    });
                                                                </script>

                                                            <?php
                                                            } else {
                                                            ?>

                                                                <script>
                                                                    Swal.fire({
                                                                        text: "Image file not upload!",
                                                                        icon: "error",
                                                                        buttonsStyling: false,
                                                                        confirmButtonText: "ERROR!",
                                                                        customClass: {
                                                                            confirmButton: "btn btn-danger"
                                                                        }
                                                                    }).then(function() {
                                                                        window.location = "r_menu.php";
                                                                    });
                                                                </script>

                                                            <?php
                                                            }
                                                        } else {
                                                            ?>

                                                            <script>
                                                                Swal.fire({
                                                                    text: "Invalid image file type. Allowed file types are: jpg, jpeg, png, gif.",
                                                                    icon: "error",
                                                                    buttonsStyling: false,
                                                                    confirmButtonText: "ERROR!",
                                                                    customClass: {
                                                                        confirmButton: "btn btn-danger"
                                                                    }
                                                                }).then(function() {
                                                                    window.location = "r_menu.php";
                                                                });
                                                            </script>

                                                        <?php
                                                        }
                                                    } else {
                                                        ?>

                                                        <script>
                                                            Swal.fire({
                                                                text: "Error uploading image:",
                                                                icon: "error",
                                                                buttonsStyling: false,
                                                                confirmButtonText: "ERROR!",
                                                                customClass: {
                                                                    confirmButton: "btn btn-danger"
                                                                }
                                                            }).then(function() {
                                                                window.location = "r_menu.php";
                                                            });
                                                        </script>

                                                <?php
                                                    }
                                                }

                                                // End Code

                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Update image code end-->

                                    <?php if ($row['d_price'] > 0 && $row['d_price'] !== $row['price']) { ?>
                                        <h1><s>₹<?php echo $row['price'] ?></s> ₹<?php echo $row['d_price'] ?></h1>
                                    <?php } ?>
                                    <?php if ($row['d_price'] <= 0 || $row['d_price'] == $row['price']) { ?>
                                        <h1>₹<?php echo $row['price'] ?></h1>
                                    <?php } ?>
                </div>
                <!-- <button
              class="add-button"
              data-title="Salmon and Vegetables"
              data-price="8.99">Add to Cart</button> -->
                </li>
                <!-- Menu Item End -->
        <?php
                            }
                        }
        ?>

        </ul>
            </div>

        </div>

    </div>

    <div class="modal fade" tabindex="-1" id="kt_modal_stacked_1">
        <div class="modal-dialog modal-dialog-centered" style="max-width:700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Create Item</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times fs-1"><i class="path1"></i><i class="path2"></i></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">

                        <!--begin::Input group-->
                        <div class="form-floating mb-7">
                            <input type="text" name="iname" class="form-control" id="iname" placeholder="Enter Your Item Name" />
                            <label for="iname">Item Name</label>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="form-floating mb-7">
                            <input type="text" name="desc" class="form-control" id="desc" placeholder="Enter Your Item Description" />
                            <label for="desc">Item Description</label>
                        </div>
                        <!--end::Input group-->

                        <div class="form-floating mb-7">
                            <input type="file" name="image" class="form-control" id="image" placeholder="Select Image For Item" />
                            <label for="image">Item Image</label>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="form-floating mb-7">
                            <input type="number" name="price" class="form-control" id="price" placeholder="Enter Item Price" value="00.00" />
                            <label for="price">Item Price</label>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="form-floating mb-7">
                            <input type="number" name="dprice" class="form-control" id="d_price" placeholder="Enter Item Discount Price" value="00.00" />
                            <label for="d_price">Item Discounted Price</label>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="form-floating mb-7">
                            <select name="avail" class="form-select" id="avail" aria-label="Select example">
                                <option value="Out of stock">Out of stock</option>
                                <option value="In-stock">In-stock</option>

                            </select>
                            <label for="avail">Item Availability</label>
                        </div>

                        <!--end::Input group-->

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit1" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <!-- Form connection Start Code -->
                <?php

                // image file upload Start Code 
                if (isset($_POST['submit1'])) {
                    $uid = $_SESSION['uid'];
                    $item = $_POST['iname'];
                    $desc = $_POST['desc'];
                    $price = $_POST['price'];
                    $dprice = $_POST['dprice'];
                    $avail = $_POST['avail'];

                    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                        $targetDir = "uploads/"; // Directory where the uploaded images will be stored
                        $targetFile = $targetDir . basename($_FILES["image"]["name"]); // File path of the uploaded image
                        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // File extension of the uploaded image

                        // Generate new file name with MD5 hash of current date/time
                        $newFileName = md5(date("YmdHis")) . "." . $imageFileType;
                        $targetFile = $targetDir . $newFileName;


                        // Check if the uploaded file is a valid image
                        $allowedExtensions = array("jpg", "jpeg", "png", "gif", "");
                        if (in_array($imageFileType, $allowedExtensions)) {
                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {


                                $query = "INSERT INTO `r_menu`(`uid`, `item`, `image`, `description`, `price`, `avaibility`, `d_price`) VALUES ('$uid','$item','$newFileName','$desc','$price','$avail','$dprice');";

                                mysqli_query($conn, $query);
                ?>

                                <script>
                                    Swal.fire({
                                        text: "Your Item Details has been added successfully!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function() {
                                        window.location = "r_menu.php";
                                    });
                                </script>

                            <?php
                            } else {
                            ?>

                                <script>
                                    Swal.fire({
                                        text: "Image file not upload!",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "ERROR!",
                                        customClass: {
                                            confirmButton: "btn btn-danger"
                                        }
                                    }).then(function() {
                                        window.location = "r_menu.php";
                                    });
                                </script>

                            <?php
                            }
                        } else {
                            ?>

                            <script>
                                Swal.fire({
                                    text: "Invalid image file type. Allowed file types are: jpg, jpeg, png, gif.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "ERROR!",
                                    customClass: {
                                        confirmButton: "btn btn-danger"
                                    }
                                }).then(function() {
                                    window.location = "r_menu.php";
                                });
                            </script>

                        <?php
                        }
                    } else {
                        ?>

                        <script>
                            Swal.fire({
                                text: "Error uploading image:",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "ERROR!",
                                customClass: {
                                    confirmButton: "btn btn-danger"
                                }
                            }).then(function() {
                                window.location = "r_menu.php";
                            });
                        </script>

                <?php
                    }
                }

                // End Code

                ?>
            </div>
        </div>
    </div>





    </div>

    <!--end::Content wrapper-->

<?php require "footer.php";
} else {
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>

<script>
    var elements = Array.prototype.slice.call(document.querySelectorAll("[data-bs-stacked-modal]"));

    if (elements && elements.length > 0) {
        elements.forEach((element) => {
            if (element.getAttribute("data-kt-initialized") === "1") {
                return;
            }

            element.setAttribute("data-kt-initialized", "1");

            element.addEventListener("click", function(e) {
                e.preventDefault();

                const modalEl = document.querySelector(this.getAttribute("data-bs-stacked-modal"));

                if (modalEl) {
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();
                }
            });
        });
    }
</script>

<style>
    body {
        background-image: url('../img/background.webp');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        min-height: 100vh;
        font-family: "Poppins", sans-serif;
    }

    h2,
    .g-price {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 50px;
    }

    s,
    strike {
        text-decoration: none;
        position: relative;
    }

    s::before,
    strike::before {
        top: 50%;
        /*tweak this to adjust the vertical position if it's off a bit due to your font family */
        background: red;
        /*this is the color of the line*/
        opacity: .7;
        content: '';
        width: 110%;
        position: absolute;
        height: .1em;
        border-radius: .1em;
        left: -5%;
        white-space: nowrap;
        display: block;
        transform: rotate(-15deg);
    }

    s.straight::before,
    strike.straight::before {
        transform: rotate(0deg);
        left: -1%;
        width: 102%;
    }

    .g-price {
        margin: 8px 0;
    }



    .container {

        margin: 0 auto;
        padding: 0px 0;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 950px) {
        .container {
            display: block;
        }
    }

    @media (max-width: 470px) {

        .screen-togo,
        .screen-cart {
            width: 400px !important;
        }

    }

    .screen-togo,
    .screen-cart {
        width: 900px;
        border: solid #d1d4e3 3px;
        border-radius: 5px;
        background: white;
        padding-top: 10px;
        padding-left: 30px;
        margin: 20px;
        box-shadow: 0px 0px 70px rgba(0, 0, 0, 0.1);
    }

    ul {
        padding: 0;
        list-style: none;
    }

    .menu1-item {
        background: #E4F0FD;
        border-radius: 20px 0 0 20px;
        margin: 30px 0;
        padding-top: 15px;
        padding-right: 30px;
        padding-bottom: 10px;
        position: relative;
    }

    .menu1-item:nth-child(2n) {
        background: #FBE4F0;
    }

    .menu1-item:nth-child(3n) {
        background: #F7F7FE;
    }

    .menu1-item:nth-child(4n) {
        background: #E4FDF1;
    }

    .menu1-item img {
        width: 150px;
        position: absolute;
        top: -20px;
        left: -20px;
    }

    .menu1-item .add-button {
        position: absolute;
        border: none;
        background: #6B00F5;
        padding: 6px 20px 4px;
        border-radius: 20px;
        color: white;
        font-weight: 700;
        font-size: 16px;
        bottom: -10px;
        left: 150px;
        transition: all 0.3s;
    }

    .menu1-item .add-button:hover {
        background: #5815AE;
    }

    .menu1-item-dets {
        margin-left: 150px;
        padding-bottom: 15px;
    }

    .menu1-item-heading {
        font-size: 18px;
        margin: 10px 0 12px;
    }

    .screen-cart {
        padding-right: 30px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translate(10px);
        }

        to {
            opacity: 1;
            transform: translate(0);
        }
    }

    .cart-item {
        display: flex;
        align-items: flex-start;
        padding-bottom: 25px;
        margin-bottom: 25px;
        border-bottom: 1px solid #D7D7F9;
        animation: fadeIn 0.3s;
    }

    .cart-item:last-child {
        border-bottom: 5px solid #D7D7F9;
    }

    .cart-item img {
        width: 65px;
    }

    .cart-item .g-price {
        font-size: 24px;
    }

    .cart-item-dets {
        margin-left: 15px;
        width: 100%;
    }

    .cart-item-heading {
        margin: 10px 0;
    }

    .cart-math-item {
        margin: 5px 0;
        font-weight: 700;
    }

    .cart-math-item span {
        display: inline-block;
        text-align: right;
    }

    .cart-math-item .cart-math-header {
        width: 50%;
    }

    .cart-math-item .g-price {
        width: 40%;
    }
</style>

<!-- jQuery -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

<script>
    let subtotal = 0;

    const calculateTax = subtotal => {
        const tax = subtotal * 0.13;
        const formattedTax = tax.toFixed(2);
        return formattedTax;
    };

    const calculateTotal = subtotal => {
        const tax = calculateTax(subtotal);
        const total = parseFloat(subtotal) + parseFloat(tax);
        const formattedTotal = total.toFixed(2);
        return formattedTotal;
    };

    const getImgLink = title => {
        let imgLink;
        switch (title) {
            case 'French Fies with Ketchup':
                imgLink =
                    'https://images.themodernproper.com/billowy-turkey/production/posts/2022/Homemade-French-Fries_8.jpg?w=960&h=960&q=82&fm=jpg&fit=crop&dm=1662474181&s=f6b09b96f732330eca2aae43140b3ffa';
                break;
            case 'Salmon and Vegetables':
                imgLink = 'https://24carrotkitchen.com/wp-content/uploads/2015/08/DSC_0965_9083.jpg';
                break;
            case 'Spaghetti with Sauce':
                imgLink = 'https://www.hintofhealthy.com/wp-content/uploads/2020/07/Healthy-Spaghetti-Sauce-1.jpg';
                break;
            case 'Tortellini':
                imgLink = 'https://whitneybond.com/wp-content/uploads/2015/03/Vegetarian-Pesto-Tortellini-6.jpg';
                break;
            case 'Chicken Salad':
                imgLink = 'https://www.licious.in/blog/wp-content/uploads/2022/06/shutterstock_1264839352.jpg';
                break;
            default:
                imgLink = 'https://assets.codepen.io/687837/plate__chicken-salad.png';
        }

        return imgLink;
    };

    $('.add-button').on('click', function() {
        const title = $(this).data('title');
        const price = $(this).data('price');
        const imgLink = getImgLink(title);

        const element = `
    <li class="cart-item">
      <img src="${imgLink}" alt="${title}">
      <div class="cart-item-dets">
        <p class="cart-item-heading">${title}</p>
        <p class="g-price">$${price}</p>
      </div>
    </li>
  `;
        $('.cart-items').append(element);

        subtotal = subtotal + price;

        const formattedSubtotal = subtotal.toFixed(2);
        const tax = calculateTax(subtotal);
        const total = calculateTotal(subtotal);

        $('.cart-math').html(`
    <p class="cart-math-item">
      <span class="cart-math-header">Subtotal:</span>
      <span class="g-price subtotal">$${formattedSubtotal}</span>
    </p>
    <p class="cart-math-item">
      <span class="cart-math-header">Tax:</span>
      <span class="g-price tax">$${tax}</span>
    </p>
    <p class="cart-math-item">
      <span class="cart-math-header">Total:</span>
      <span class="g-price total">$${total}</span>
    </p>
  `);
    });
</script>