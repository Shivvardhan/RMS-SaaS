<?php
require "d_head.php";
$stmt = $conn->prepare("SELECT l_token FROM `users` WHERE `username` = ?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();



if ($user['l_token'] == isset($_SESSION['token']) && isset($_SESSION['username']) && $_SESSION['usertype'] == "admin" && session_status() === PHP_SESSION_ACTIVE  ) {
    require "menu.php"; ?>


<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Add
                Restaurent Admin</h1>
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
                <li class="breadcrumb-item text-muted">Create Restaurant Admin</li>
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
                            <form action="" method="POST" autocomplete="off">
                                <!-- Username -->
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Enter your username" required autofocus />
                                    </div>
                                </div>

                                <!-- Restaurant Name -->
                                <div class="mb-3">
                                    <label for="r_name" class="form-label">Restaurant Name</label>
                                    <input type="text" class="form-control" id="r_name" name="r_name"
                                        placeholder="Enter your restaurant name" required />
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="name@example.com" required />
                                </div>

                                <!-- Contact Number -->
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Contact Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        placeholder="Enter contact number" pattern="[0-9]{10}" minlength="10"
                                        maxlength="10" required />
                                </div>

                                <!-- Name Fields -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="f_name" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="f_name" name="f_name"
                                            placeholder="First Name" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="l_name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="l_name" name="l_name"
                                            placeholder="Last Name" required />
                                    </div>
                                </div>

                                <!-- Password Fields -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Enter password" minlength="6" required />
                                            <button class="btn btn-outline-secondary" type="button"
                                                onclick="togglePassword('password', 'togglePasswordIcon1')">
                                                <i class="bi bi-eye" id="togglePasswordIcon1"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirm_password"
                                                name="confirm_password" placeholder="Confirm password" required />
                                            <button class="btn btn-outline-secondary" type="button"
                                                onclick="togglePassword('confirm_password', 'togglePasswordIcon2')">
                                                <i class="bi bi-eye" id="togglePasswordIcon2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>


<!-- Password Toggle Script -->
<script>
function togglePassword(fieldId, iconId) {
    const passwordField = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);

    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    } else {
        passwordField.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    }
}
</script>

<?php
    if (isset($_POST['submit'])) {
        $stmt = $conn->prepare("INSERT INTO users (username, r_name, email, fname, lname, password, usertype, status , phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssi", $username, $r_name,$email, $first_name, $last_name, $password, $usertype, $status , $phone);
        $username = $_POST["username"];
        $r_name = $_POST["r_name"];
        $email = $_POST["email"];
        $first_name = $_POST["f_name"];
        $last_name = $_POST["l_name"];
        $password = md5($_POST["password"]);
        $confirm_password = md5($_POST["confirm_password"]);
        $usertype = "radmin";
        $status = "active";
        $phone = $_POST["phone"];

        if ($password == $confirm_password) {

            $stmts = $conn->prepare("SELECT * FROM `users` WHERE username = ?");
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
    window.location = "new_radmin.php";
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
}
else{
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>