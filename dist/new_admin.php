<?php
require "d_head.php";
$stmt = $conn->prepare("SELECT l_token FROM `users` WHERE `username` = ?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();



if ($user['l_token'] == isset($_SESSION['token']) && isset($_SESSION['username']) && $_SESSION['usertype'] == "admin" && session_status() === PHP_SESSION_ACTIVE) {
    require "menu.php"; ?>


    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Add  Admin</h1>
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
                    <li class="breadcrumb-item text-muted">Create new Admin</li>
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
                    <div class="card shadow-sm">

                        <div class="card-body">
                            <div class="form">
                                <form action="#" method="POST" autocomplete="off">
                                    <div class="input-group input-group-solid mb-3">
                                        <span class="input-group-text" id="basic-addon1">@</span>
                                        <input type="text" class="form-control" placeholder="Username" name="username" />
                                    </div>
                                    <div class="input-group input-group-solid mb-3">
                                        <input type="email" class="form-control" placeholder="name@example.com" name="email" />
                                    </div>
                                    <div class="input-group input-group-solid mb-3">
                                        <input type="number" class="form-control" placeholder="0000000000" name="phone" />
                                    </div>
                                    <div class="input-group input-group-solid mb-3">
                                        <input type="text" class="form-control" placeholder="First Name" aria-label="Username" name="firstname" />
                                        <input type="text" class="form-control" placeholder="Last Name" aria-label="Server" name="lastname" />
                                    </div>
                                    <div class="input-group input-group-solid mb-3">
                                        <input type="text" class="form-control" placeholder="Password" aria-label="Username" name="password" />
                                        <input type="text" class="form-control" placeholder="Confirm Password" aria-label="Server" name="confirm_password" />
                                    </div>
                                    <div class="input-group input-group-solid mb-3">
                                        <input type="text" class="form-control" placeholder="User Type" aria-label="Username" readonly value="admin" name="user_type" />
                                        <input type="text" class="form-control" placeholder="Status" aria-label="Server" value="active" name="status" />
                                    </div>
                                    <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                                </form>


                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php
    if (isset($_POST['submit'])) {
        $stmt = $conn->prepare("INSERT INTO users (username, email, fname, lname, password, usertype, status, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $username, $email, $first_name, $last_name, $password, $usertype, $status, $phone);
        $username = $_POST["username"];
        $email = $_POST["email"];
        $first_name = $_POST["firstname"];
        $last_name = $_POST["lastname"];
        $password = md5($_POST["password"]);
        $confirm_password = md5($_POST["confirm_password"]);
        $usertype = $_POST["user_type"];
        $status = $_POST["status"];
        $phone = $_POST["phone"];

        if ($password == $confirm_password) {

            $stmts = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmts->bind_param("s", $username);
            $stmts->execute();

            // check if any row is returned
            $results = $stmts->get_result();
            if ($results->num_rows > 0) {
    ?>

                <script>
                    Swal.fire({
                        text: "Username already exists",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "ERROR!",
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    }).then(function() {
                        window.location = "new_admin.php";
                    });
                </script>
            <?php
            } else {





                $stmt->execute(); ?>

                <script>
                    Swal.fire({
                        text: "New Admin User Added successfully!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {
                        window.location = "new_admin.php";
                    });
                </script>

            <?php
            }
        } else {
            ?>
            <script>
                Swal.fire({
                    text: "password & confirm password should be same",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "ERROR!",
                    customClass: {
                        confirmButton: "btn btn-danger"
                    }
                }).then(function() {
                    window.location = "new_admin.php";
                });
            </script>

    <?php
        }
    }

    ?>

<?php require "footer.php";
} else {
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>