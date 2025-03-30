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
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Profile</h1>
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
                <li class="breadcrumb-item text-muted">Profile</li>
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
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Content container-->
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <!--begin::Navbar-->
                        <div class="card card-flush mb-9" id="kt_user_profile_panel">
                            <!--begin::Hero nav-->
                            <div class="card-header rounded-top bgi-size-cover h-200px "
                                style="background-position: 100% 50%;background-color: #3E97FF;"></div>
                            <!--end::Hero nav-->
                            <!--begin::Body-->
                            <div class="card-body mt-n19">
                                <!--begin::Details-->
                                <div class="m-0">
                                    <!--begin: Pic-->
                                    <div class="d-flex flex-stack align-items-end pb-4 mt-n19">
                                        <div
                                            class="symbol symbol-125px symbol-lg-150px symbol-fixed position-relative mt-n3">
                                            <img src="assets/media/avatars/blank.png" alt="image"
                                                class="border border-white border-4" style="border-radius: 20px" />
                                        </div>
                                        <!--begin::Toolbar-->
                                        <div class="me-0">

                                            <!--begin::Menu 3-->

                                            <!--end::Menu 3-->
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Pic-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-stack flex-wrap align-items-end">
                                        <!--begin::User-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Name-->
                                            <div class="d-flex align-items-center mb-2">
                                                <a href="#"
                                                    class="text-gray-800 text-hover-primary fs-2 fw-bolder me-1"><?php echo $_SESSION['fname'] . $_SESSION['lname'] ?></a>

                                            </div>
                                            <!--end::Name-->
                                            <!--begin::Text-->
                                            <span
                                                class="fw-bold text-gray-400 fs-6 mb-2 d-block"><?php echo $_SESSION['dob'] ?></span>
                                            <span
                                                class="fw-bold text-gray-600 fs-6 mb-2 d-block"><?php echo $_SESSION['bio'] ?></span>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="card mb-5 mb-lg-10">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Heading-->
                                <div class="card-title">
                                    <h3>Login Sessions</h3>
                                </div>
                                <!--end::Heading-->
                                <!--begin::Toolbar-->

                                <!--end::Toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body p-0">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                        <!--begin::Thead-->
                                        <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                                            <tr>
                                                <th class="min-w-20px">#</th>
                                                <th class="min-w-100px">IP address</th>
                                                <th class="min-w-150px">MAC Address</th>
                                                <th class="min-w-380px">Device</th>
                                                <th class="min-w-150px">Logged In On</th>
                                            </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody class="fw-6 fw-semibold text-gray-600">
                                            <?php $id = 1;
												$uid = $_SESSION['uid'];
												$sql = "SELECT *  FROM u_login_log WHERE uid = $uid ORDER BY `u_login_log`.`timestamp` DESC";
												$stmt = $conn->prepare($sql);
												//    $stmt->bind_param("s", $roll);
												$stmt->execute();
												$result = $stmt->get_result();
												while ($row = $result->fetch_assoc()) {
												?>

                                            <tr>
                                                <td>
                                                    <?php echo $id++ ; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['ipaddress'] ?>
                                                </td>
                                                <td><?php echo $row['macaddress'] ?></td>
                                                <td><?php echo $row['useragent']?></td>
                                                <td><?php echo $row['timestamp'] ?></td>
                                            </tr>
                                            <?php } ?>

                                        </tbody>
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Card body-->
                        </div>



                    </div>

                </div>





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