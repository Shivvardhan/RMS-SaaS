<!DOCTYPE html>

<?php
session_start();
require('dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password = md5($password);
	$status = "active";
	// Check if user exists in the database
	$stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = ? and `status` = ?");
	$stmt->bind_param('ss', $username, $status);
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();

	if ($user && ($user['password'] == $password)) {
		// Login successful, set session variables

		$_SESSION['username'] = $user['username'];
		$_SESSION['email'] = $user['email'];
		$_SESSION['fname'] = $user['fname'];
		$_SESSION['lname'] = $user['lname'];
		$_SESSION['usertype'] = $user['usertype'];
		$_SESSION['uid'] = $user['uid'];

		$_SESSION['token'] = $token = bin2hex(random_bytes(20));

		$stmts = $conn->prepare("SELECT * FROM `u_details` WHERE `username` = ?");
		$stmts->bind_param('s', $username);
		$stmts->execute();
		$results = $stmts->get_result();
		$users = $results->fetch_assoc();
		$_SESSION['bio'] = $users['bio'];
		$_SESSION['dob'] = $users['dob'];


		$time = date('Y-m-d H:i:s');
		$user = $user['username'];



		// $stmt = $conn->prepare("INSERT INTO users (l_token, l_time) VALUES (?, ?)");
		$stmt = $conn->prepare("UPDATE `users` SET `l_token` = ?, l_time = ? WHERE `users`.`username`  = ?");
		$stmt->bind_param("sss", $token, $time, $user);
		$stmt->execute();


		$ip_address = $_SERVER['REMOTE_ADDR'];
		$user_agent = $_SERVER['HTTP_USER_AGENT'] ;
		$mac_address = exec("arp $ip_address | awk '{print $4}'");
		$stmt = $conn->prepare("INSERT INTO `u_login_log`( `uid`, `ipaddress`, `useragent`, `macaddress`) VALUES (?,?,?,?)");
		$stmt->bind_param("isss", $_SESSION['uid'], $ip_address, $user_agent, $mac_address);
		$stmt->execute();



		header('Location: dash.php');
		exit;
	} else {
		// Login failed, display error message
		$error = 'Invalid username or password';
	}
}
?>
<html lang="en">
<!--begin::Head-->

<head>
	<title>SYSTEM VISTA</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<link rel="icon" type="image/x-icon" href="assets/media/images/logo_w.png">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank app-blank">
	<!--begin::Theme mode setup on page load-->
	<script>
		var defaultThemeMode = "light";
		var themeMode;
		if (document.documentElement) {
			if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
				themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
			} else {
				if (localStorage.getItem("data-bs-theme") !== null) {
					themeMode = localStorage.getItem("data-bs-theme");
				} else {
					themeMode = defaultThemeMode;
				}
			}
			if (themeMode === "system") {
				themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
			}
			document.documentElement.setAttribute("data-bs-theme", themeMode);
		}
	</script>
	<!--end::Theme mode setup on page load-->
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root" id="kt_app_root">
		<!--begin::Authentication - Sign-in -->
		<div class="d-flex flex-column flex-lg-row flex-column-fluid">
			<!--begin::Aside-->
			<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center" style="background-image: url(assets/media/misc/auth-bg.png)">
				<!--begin::Content-->
				<div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">
					<!--begin::Logo-->
					<a href="Index.php" class="mb-0 mb-lg-20">
						<img alt="Logo" src="assets/media/stock/etc/logo_w.png" class="h-40px h-lg-80px" />
					</a>
					<!--end::Logo-->
					<!--begin::Image-->
					<img class="d-none d-lg-block mx-auto w-300px w-lg-75 w-xl-500px mb-10 mb-lg-20" src="assets/media/stock/etc/index.png" alt="" />
					<!--end::Image-->
					<!--begin::Title-->
					<h1 class="d-none d-lg-block text-white fs-2qx fw-bold text-center mb-7">Fast, Efficient and Productive</h1>
					<!--end::Title-->
					<!--begin::Text-->
					<div class="d-none d-lg-block text-white fs-base text-center">Delicious & flexible menu with a wide
						range of home goods - fresh<br>
						sandwiches, hot hearty lunches,
						assorted homemade sweet & savoury<br>
						pastries & cakes.</div>
					<!--end::Text-->
				</div>
				<!--end::Content-->
			</div>
			<!--begin::Aside-->
			<!--begin::Body-->
			<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
				<!--begin::Form-->
				<div class="d-flex flex-center flex-column flex-lg-row-fluid">
					<!--begin::Wrapper-->
					<div class="w-lg-500px p-10">
						<!--begin::Form-->
						<form class="form w-100" action="#" method="POST">
							<!--begin::Heading-->
							<div class="text-center mb-11">
								<!--begin::Title-->
								<h1 class="text-dark fw-bolder mb-3">Restaurant Sign In</h1>
								<h1 class="text-danger fw-bolder mb-3"><?php if (isset($error)) {
																			echo $error;
																		} ?></h1>
								<!--end::Title-->
								<!--begin::Subtitle-->

								<!--end::Subtitle=-->
							</div>
							<!--begin::Heading-->
							<!--begin::Login options-->

							<!--end::Login options-->
							<!--begin::Separator-->

							<!--end::Separator-->
							<!--begin::Input group=-->
							<div class="fv-row mb-8">
								<!--begin::Email-->
								<input type="text" placeholder="Email" name="username" autocomplete="off" class="form-control bg-transparent" />
								<!--end::Email-->
							</div>
							<!--end::Input group=-->
							<div class="fv-row mb-3">
								<!--begin::Password-->
								<input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
								<!--end::Password-->
							</div>
							<!--end::Input group=-->
							<!--begin::Wrapper-->
							<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
								<div></div>
								<!--begin::Link-->
								<a href="reset.php" class="link-primary">Forgot Password ?</a>
								<!--end::Link-->
							</div>
							<!--end::Wrapper-->
							<!--begin::Submit button-->
							<div class="d-grid mb-10">
								<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
									<!--begin::Indicator label-->
									<span class="indicator-label">Sign In</span>
									<!--end::Indicator label-->
									<!--begin::Indicator progress-->
									<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									<!--end::Indicator progress-->
								</button>
							</div>
							<!--end::Submit button-->
							<!--begin::Sign up-->
							<!-- <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
								<a href="../../demo1/dist/authentication/layouts/corporate/sign-up.html" class="link-primary">Sign up</a>
							</div> -->
							<div class="text-gray-500 text-center fw-semibold fs-6">

							</div>
							<div class="text-gray-500 text-center fw-semibold fs-6">
								<a href="tablelogin.php" class="link-primary">Login as Table Account</a>
							</div>
							<!--end::Sign up-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Form-->
				<!--begin::Footer-->
				<div class="d-flex flex-center flex-wrap px-5">
					<!--begin::Links-->
					<div class="d-flex fw-semibold text-primary fs-base">
						<a href="#" class="px-5" target="_blank">Developed By &#x1F525; Harshit & &#128526; shubham. & &#128526; shivvardhan</a>

					</div>
					<!--end::Links-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Authentication - Sign-in-->
	</div>
	<!--end::Root-->
	<!--begin::Javascript-->
	<script>
		var hostUrl = "assets/";
	</script>
	<!--begin::Global Javascript Bundle(mandatory for all pages)-->
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Custom Javascript(used for this page only)-->
	<script src="assets/js/custom/authentication/sign-in/general.js"></script>
	<!--end::Custom Javascript-->
	<!--end::Javascript-->
</body>




<!--end::Body-->

</html>