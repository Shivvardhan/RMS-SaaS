<?php
require "d_head.php";
$stmt = $conn->prepare("SELECT l_token FROM `users` WHERE `username` = ?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user['l_token'] == isset($_SESSION['token']) && isset($_SESSION['username']) && session_status() === PHP_SESSION_ACTIVE && $_SESSION['usertype'] == 'admin') {

    require "menu.php";

?>


    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">All Users
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
                    <li class="breadcrumb-item text-muted">Users</li>
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
                        <div class="card mb-5 mb-lg-10">

                            <div class="card-header">

                                <div class="card-title">
                                    <h3>Login Sessions</h3>
                                </div>
                            </div>
                            <div class="card-body p-5">
                                <table class="table table-bordered table-hover" id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>username</th>
                                            <th>email</th>
                                            <th>phone</th>
                                            <th>rname</th>
                                            <th>fname</th>
                                            <th>lname</th>
                                            <th>Acc Created on</th>
                                            <th>status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $id = 1;
                                        $sql = "SELECT *  FROM users WHERE usertype = 'radmin'";
                                        $stmt = $conn->prepare($sql);
                                        //    $stmt->bind_param("s", $roll);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?php echo $id;
                                                    $id++; ?></td>
                                                <td><?= $row['username'] ?></td>
                                                <td><?= $row['email'] ?></td>
                                                <td><?= $row['phone'] ?></td>
                                                <td><?= $row['r_name'] ?></td>
                                                <td><?= $row['fname'] ?></td>
                                                <td><?= $row['lname'] ?></td>
                                                <td><?= $row['timestamp'] ?></td>
                                                <td><?= $row['status'] ?></td>
                                                <td><a data-bs-toggle="modal" data-bs-target="#kt_modal_<?php echo $id; ?>" class="btn btn-sm btn-light-primary">
                                                        <i class="fa fa-pencil"></i>
                                                        edit
                                                    </a></td>
                                                <!-- Modal Start -->
                                                <div class="modal fade" tabindex="-1" id="kt_modal_<?php echo $id; ?>">
                                                    <div class="modal-dialog">
                                                        <form method="POST" action="#">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h3 class="modal-title">Update User Detail's</h3>

                                                                    <!--begin::Close-->
                                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                                        <i class="fa fa-times fs-1"><i class="path1"></i><i class="path2"></i></i>
                                                                    </div>
                                                                    <!--end::Close-->
                                                                </div>

                                                                <div class="modal-body">

                                                                    <input type="hidden" class="form-control" name="username" value="<?php echo $row['username']; ?>" />

                                                                    <!--begin::Input group-->
                                                                    <div class="form-floating mb-7">
                                                                        <input name="email" type="email" class="form-control" id="floatingInput" value="<?php echo $row['email']; ?>" />
                                                                        <label for="floatingInput">Email address</label>
                                                                    </div>
                                                                    <!--end::Input group-->

                                                                    <!--begin::Input group-->
                                                                    <div class="form-floating mb-7">
                                                                        <input name="phone" type="number" class="form-control" id="phone" value="<?php echo $row['phone']; ?>" value="test@example.com" />
                                                                        <label for="phone">Phone Number</label>
                                                                    </div>
                                                                    <!--end::Input group-->

                                                                    <!--begin::Input group-->
                                                                    <div class="form-floating mb-7">
                                                                        <input name="rname" type="text" class="form-control" id="rname" value="<?php echo $row['r_name']; ?>" />
                                                                        <label for="rname">Restuarant Name</label>
                                                                    </div>
                                                                    <!--end::Input group-->

                                                                    <!--begin::Input group-->
                                                                    <div class="form-floating mb-7">
                                                                        <input name="fname" type="text" class="form-control" id="fname" value="<?php echo $row['fname']; ?>" />
                                                                        <label for="fname">First Name</label>
                                                                    </div>
                                                                    <!--end::Input group-->

                                                                    <!--begin::Input group-->
                                                                    <div class="form-floating mb-7">
                                                                        <input name="lname" type="text" class="form-control" id="lname" value="<?php echo $row['lname']; ?>" />
                                                                        <label for="lname">Last Name</label>
                                                                    </div>
                                                                    <!--end::Input group-->

                                                                    <!--begin::Input group-->
                                                                    <div class="form-floating mb-7">
                                                                        <select name="status" class="form-select" id="status" aria-label="Select example">
                                                                            <option value="<?php echo $row['status']; ?>">
                                                                                <?php echo $row['status']; ?></option>
                                                                            <?php if ($row['status'] == 'active') { ?>
                                                                                <option value="inactive">Inactive</option>
                                                                            <?php } ?>
                                                                            <?php if ($row['status'] == 'inactive') { ?>
                                                                                <option value="active">active</option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <label for="status">Status</label>
                                                                    </div>

                                                                    <!--end::Input group-->

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                                                                </div>
                                                        </form>

                                                        <!-- Updating data with PHP code -->
                                                        <!-- Start Code -->
                                                        <?php

                                                        if (isset($_POST["submit"])) {
                                                            $rname = $_POST['rname'];
                                                            $email = $_POST['email'];
                                                            $phone = $_POST['phone'];
                                                            $fname = $_POST['fname'];
                                                            $lname = $_POST['lname'];
                                                            $status = $_POST['status'];
                                                            $username = $_POST['username'];

                                                            $sql = "UPDATE `users` SET `r_name`='$rname',`email`='$email',`phone`='$phone',`fname`='$fname',`lname`='$lname',`status`='$status' WHERE username='$username'";

                                                            if ($conn->query($sql) === TRUE) {
                                                        ?>

                                                                <script>
                                                                    Swal.fire({
                                                                        text: "Your User data has been updated successfully!",
                                                                        icon: "success",
                                                                        buttonsStyling: false,
                                                                        confirmButtonText: "Ok, got it!",
                                                                        customClass: {
                                                                            confirmButton: "btn btn-primary"
                                                                        }
                                                                    }).then(function() {
                                                                        window.location = "users.php";
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
                            </tr>
                        <?php } ?>

                        </tbody>

                        </table>
                        </div>
                    </div></div>
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