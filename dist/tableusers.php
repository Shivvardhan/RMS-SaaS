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
                    <table class="table table-bordered table-hover" id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>UserName</th>
                                <th>Password (encrypted)</th>
                                <th>Capacity</th>
                                <th>Acc Created on</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 1; 
                            $uid = $_SESSION['uid'];
                       $sql = "SELECT * FROM t_users where ruserid = '$uid'";
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
                                <td><?= $row['password'] ?></td>
                                <td><?= $row['capacity'] ?></td>
                                <td><?= $row['timestamp'] ?></td>
                                <td><?= $row['status'] ?></td>


                            </tr>
                            <?php }?>

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
}
else{
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>