<?php
require "d_head.php";
$stmt = $conn->prepare("SELECT l_token FROM `users` WHERE `username` = ?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user['l_token'] == isset($_SESSION['token']) && isset($_SESSION['username']) && session_status() === PHP_SESSION_ACTIVE && $_SESSION['usertype'] == 'admin') {
require "menu.php"; ?>

<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Working Logs
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
                <li class="breadcrumb-item text-muted">Logs</li>
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

        <div class="row g-5 g-xl-2 mb-5 mb-xl-10">

            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 22/5/23<br>
                fixing bugs in billprint.php <b>~Harshit Varshney</b> <br>
                fixed bug in navigation (table login) <b>~Harshit Varshney</b> <br>
                working on final project file <b>~Shubham giri goswami</b>
            </div>

            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 21/5/23<br>
                added favicon on billprint.php <b>~Shubham giri goswami</b> <br>
                changed icon in navigations due to issue in font awesome <b>~Shubham giri goswami</b> <br>
                working on final project file <b>~Shubham giri goswami</b> <br>
                worked on structure of billprint.php <b>~Harshit Varshney</b> <br>
                worked on billprint.php <b>~shivvardhan singh</b><br>
            </div>

            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 14/5/23<br>
                working on dashbord for admin (jquery) fetching live data using json <b>~Harshit Varshney</b> <br>
                created new page for creating admin account with connection with database <b>~Harshit Varshney</b>
                <br>
                done with connection with database for radmin account creation page <b>~Harshit Varshney</b> <br>
                working on order page for table account <b>~shivvardhan singh</b><br>
                connection part done on new order page (radmin) <b>~Harshit Varshney</b> <br>
            </div>


            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 13/5/23<br>
                starting working on new orders page (design part) for radmin <b>~Harshit Varshney</b> <br>
                analysing database for charts and graphs <b>~Harshit Varshney</b> <br>
                item add in order page <b>~shivvardhan singh</b><br>
            </div>

            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 30/4/23<br>
                worked on menu page delete button <b>~shivvardhan singh</b> <br>
                worked on the admin UX of the menu page <b>~shivvardhan singh</b><br>
                started workin of order page ( table login account ) <b>~shivvardhan singh</b><br>
                created database table for login logs <b>~Harshit Varshney</b> <br>
                created component in profile page to view login logs <b>~Harshit Varshney</b> <br>
                created u_log.php file for admin login to view login logs of radmin <b>~Harshit Varshney</b> <br>
                solved the bug of DataTable <b>~Harshit Varshney</b> <br>
                started working on final file <b>~shubham giri goswami</b> <br>


            </div>

            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 23/4/23<br>
                searching and update solgan for all images page <b>~shubham giri goswami</b> <br>
                researching on apex chart (column charts-stacked columns 100) & (mixed chart-line column)<b>~shubham
                    giri goswami</b> <br>
                fix bug on reset.php, dash.php, new_radmin.php, mailfunction.php <b>~Harshit Varshney</b> <br>
                worked on image change and slogan in index page, table user login page , reset page, newpass page
                <b>~Harshit Varshney</b> <br>
                worked on menu page dynamic ( image upload & store file name in database and also upload file to
                uploads
                folder) <b>~shivvardhan singh sikarwar</b> <br>
            </div>

            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 22/4/23<br>
                Works on login pages design again , password page design <b>~shubham giri goswami</b> <br>
                work on user type login <b>~harshit varshney</b> <br>
                work on reset page with authentication mail and also with the confirmation mail <b>~harshit
                    varshney</b>
                <br>
                work on table login page with database table <b>~harshit varshney</b> <br>
                created table users login page for radmin<b>~harshit varshney</b> <br>
                genrated google mail credeantials for mail (phpmailer) <b>~harshit varshney</b> <br>
                worked & completed r_table.php page ( dynamic) (different user have different view, admin can view
                all
                data & insert all data, r_admin insert & view own data) <b>~ shivardhan</b> <br>
                worked on user.php for admin user added edit button (dynamic)( done with desinging form with backend
                )
                <b>~shivvardhan singh sikarwar</b> <br>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 20/4/23<br>
                Bug Solved In Token Login<b>~Harshit Varshney</b> <br>



            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 19/4/23<br>
                created favicon <b>~shubham giri goswami</b> <br>
                add favicon in all pages <b>~shubham giri goswami</b><br>


            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 18/4/23<br>
                Login page image changed.<br>
                structure change on menu <br>
                worked on r_table.php(inseting data) creating new table

            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 17/4/23<br>
                worked on table data , menu data , order data <br>
                in table data and menu data created form and showed data

            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 13/4/23<br>
                Created Profile Page. <b>~Harshit Varshney</b><br>
                Designed dashbaord Page,
                implemented google charts for dashboard page <b>~Harshit Varshney</b><br>
                implemented countup js for dashboard page to show number. <b>~Harshit Varshney</b><br>
                incresed security by files prevented user from direct access without login. <b>~Harshit Varshney</b>

            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 12/4/23<br>
                implemeted token based login also added column in db l_token, l_time in users table <b>~Harshit
                    Varshney</b><br>
                created users page , (implemented datatables for use) <b>~Harshit Varshney</b><br>
                changed profile logo <b>~Harshit Varshney</b><br>
                implemented fontawesome v6 pro for icons for navigation bar <b>~Harshit Varshney</b><br>
                installed <b>phpmailer</b> for mail services, mail function created to use mail service. <b>~Harshit
                    Varshney</b>

            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 11/4/23<br>
                Worked on login page (token login generation and store in db) and incresed security using md5
                <b>~Harshit Varshney</b><br>
                created footer added copyright <b>~Harshit Varshney</b> <br>
                done with dasboard clean and setup with header and footer with other file that can be include with
                other
                files. <b>~Harshit Varshney</b>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 10/4/23<br>
                Worked on login page design with db connection <b>~Harshit Varshney</b><br>
                created image for login page, added text on left bootom. <b>~shubham giri goswami</b>

            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                Date :- 9/4/23<br>
                Worked on db create users table, u_detail table (users details)<b>~Harshit Varshney</b>
            </div>

        </div>

    </div>

</div>

<!--end::Content wrapper-->

<?php require "footer.php";
}
else{
    echo "<script>window.location.href = 'index.php'; </script>";
} ?>