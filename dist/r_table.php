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
                <li class="breadcrumb-item text-muted">Table Data </li>
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

        <div id="kt_app_toolbar_container" class="app-container container-fluid">

            <!-- code for radmin table data page  -->
            <!-- Starting code -->
            <?php
        if ($_SESSION['usertype'] == 'radmin') {
        ?>

            <a href="#" class="btn btn-primary hover-elevate-up" data-bs-toggle="modal"
                data-bs-target="#kt_modal_stacked_1">Add New Table</a>

            <?php };?>
            <!-- End Code -->

            <!-- code for admin table data page  -->
            <!-- Starting code -->

            <?php
        if ($_SESSION['usertype'] == 'admin') {
        ?>
            <div class="row g-5 g-xl-10 mb-5 mb-xl-1">

                <div style="display:flex;">
                    <form id="form" action="#" class="col-md-3 col-lg-4 col-xl-4 col-xxl-5 mb-md-4 mb-xl-4"
                        method="post" style="display:flex;">
                        <select name="user" class="form-select" data-control="select2"
                            data-placeholder="Select an option">
                            <option></option>


                            <?php
                        $sql = "SELECT username,r_name FROM `users` WHERE usertype='radmin';";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {

                        ?>
                            <option value="<?php echo $row['r_name']; ?>">
                                <?php echo $row['r_name'] .  " (" . $row['username'] . ")"; ?>
                            </option>
                            <?php
                            }
                        }


                        ?>
                        </select>
                        <button type="submit" id="get" name="get" class="btn btn-primary ms-5">Get</button>
                    </form>
                    <a style="align-self: self-start;" href="#" class="btn btn-primary hover-elevate-up ms-5"
                        data-bs-toggle="modal" data-bs-target="#kt_modal_stacked_1">Add New Table</a>
                </div>
                <?php 
           if(isset($_POST['get'])){
            $r_name = $_POST['user'];
            ?>

                <h1 class="mb-10 mt-10"
                    style="font-size:4rem;font-weight:800;border-bottom:3px solid #202B46;color:#202B46;">
                    <?php echo $r_name;?></h1>

                <?php
            $sql1 = "SELECT * FROM t_users LEFT JOIN users ON t_users.ruserid = users.uid where r_name='$r_name'";

            $result = $conn->query($sql1);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
            ?>
                <div id="kt_app_toolbar_container" class="app-container column container-fluid d-flex flex-stack">
                    <div class="card" style="width: 25rem;cursor: pointer;">
                        <img src="assets/media/images/table.png" class="card-img-top" alt="table_img">
                        <div class="card-body" style="text-align:center">
                            <h5 class="card-title"><?php echo $row["username"] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $row["capacity"] ?> seats</h6>
                            <!-- <a href="#" class="btn btn-primary hover-elevate-up">Generate Bill</a> -->
                        </div>
                    </div>
                </div>
                <?php
                }
            }
        }
        
            ?>



            </div>
            <?php
     
        };
        ?>
            <!-- End code -->


        </div>

    </div>
    <?php
        if ($_SESSION['usertype'] == 'radmin') {
        ?>
    <div class="row">

        <?php

                $uid = $_SESSION['uid'];


                $sql = "SELECT * FROM `t_users` WHERE `ruserid`='$uid'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {

                ?>

        <div id="kt_app_toolbar_container" class="column container-fluid d-flex flex-stack">
            <div class="card hover-none" style="width: 25rem;">
                <img src="assets/media/images/table.png" class="card-img-top" alt="table_img">
                <div class="card-body" style="text-align:center">
                    <h5 class="card-title"><?php echo $row["username"] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $row["capacity"] ?> seats</h6>
                    <a href="#" class="btn btn-success hover-elevate-up"
                        onclick="generateQR(<?php echo $row['tid']; ?>)">Generate
                        QR</a>
                </div>
            </div>
        </div>
        <?php

                    }
                } else {
                    echo "No table created";
                }


                ?>

    </div>
    <?php
        };
        ?>

    <!-- Modal for QR Code -->
    <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrModalLabel">Scan QR to Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="qrImage" src="" alt="QR Code" class="img-fluid border rounded" />
                    <div class="mt-3">
                        <button id="downloadBtn" class="btn btn-success me-2" onclick="downloadQR()">Download
                            QR</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        function generateQR(tid, username, password) {
            $.ajax({
                url: 'generate_qr.php',
                method: 'POST',
                data: {
                    tid: tid
                },
                success: function(data) {
                    $('#qrImage').attr('src', 'qrcode_' + tid + '.png');
                    var qrModal = new bootstrap.Modal(document.getElementById('qrModal'));
                    qrModal.show();
                }
            });
        }

        function downloadQR() {
            const qrImageSrc = $('#qrImage').attr('src');
            const link = document.createElement('a');
            link.href = qrImageSrc;
            link.download = qrImageSrc.split('/').pop();
            link.click();
        }
        </script>

        <div class="modal fade" tabindex="-1" id="kt_modal_stacked_1">
            <div class="modal-dialog modal-dialog-centered" style="max-width:700px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Create New Table</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="fa fa-times fs-1"><i class="path1"></i><i class="path2"></i></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form method="POST" action="#">

                        <div class="modal-body">

                            <!--begin::Input group-->
                            <div class="form-floating mb-7">
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Enter UserName" />
                                <label for="username">UserName</label>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="form-floating mb-7">
                                <input type="text" class="form-control" id="password" name="password"
                                    placeholder="Enter Password" />
                                <label for="password">Password</label>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="form-floating mb-7">
                                <input type="number" min="1" max="10" class="form-control" name="capacity" id="capacity"
                                    placeholder="Enter Seat's Capacity" />
                                <label for="capacity">Seat Capacity</label>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="form-floating">
                                <?php if ($_SESSION['usertype'] == 'admin') { ?>

                                <select name="uid" class="form-select" data-control="select2"
                                    data-placeholder="Select an option">
                                    <option></option>


                                    <?php
                                        $sql = "SELECT uid,username,r_name FROM `users` WHERE usertype='radmin';";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {

                                        ?>
                                    <option value="<?php echo $row['uid']; ?>">
                                        <?php echo $row['r_name'] .  " (" . $row['username'] . ")"; ?>
                                    </option>
                                    <?php
                                            }
                                        }


                                        ?>
                                </select>
                                <?php } else { ?>
                                <input type="hidden" class="form-control" id="username" name="uid"
                                    value="<?php echo $_SESSION['uid']; ?>" />
                                <?php } ?>
                            </div>
                            <!--end::Input group-->

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                    <?php

if (isset($_POST["submit"])) {
    // Sanitize input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);
    $status = "active";

    // Check user type to determine user ID
    if ($_SESSION['usertype'] == 'admin') {
        $ruserid = mysqli_real_escape_string($conn, $_POST['uid']);
    } else {
        $ruserid = mysqli_real_escape_string($conn, $_SESSION['uid']);
    }

    // Insert data into t_users table
    $sql = "INSERT INTO t_users (ruserid, tableid, username, password, capacity, status)
            VALUES ('$ruserid', '$ruserid', '$username', '$password', '$capacity', '$status')";

    if ($conn->query($sql) === TRUE) {
        ?>
                    <script>
                    Swal.fire({
                        text: "Your Table has been added successfully!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {
                        window.location = "r_table.php";
                    });
                    </script>
                    <?php
                    } else {
                        // Log error and display user-friendly message
                        error_log("Error: " . $sql . " - " . $conn->error);
                        echo "<script>alert('" . addslashes($conn->error) . "');</script>";
                    }
                }
                ?>

                </div>
            </div>
        </div>





    </div>

    <!--end::Content wrapper-->




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
    .column {
        float: left;
        width: 33.33%;
        margin-bottom: 40px;
    }

    .card:hover {
        transform: none !important;
        scale: 1 !important;
        box-shadow: none !important;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .card:hover {
        scale: 1.05;
        transition: 0.3s ease-out;
    }

    @media screen and (max-width: 600px) {
        .column {
            width: 100%;
            justify-content: center;
            margin-bottom: 40px;
        }

    }
    </style>


    <?php require "footer.php";
} else {
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>