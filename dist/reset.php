
<?php
require('dbcon.php');
require('mailfunction.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$status = "active";
	// Check if user exists in the database
	$stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = ? and `email` = ?");
	$stmt->bind_param('ss', $username, $email);
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();

	if ($user) {
		$_SESSION['token'] = $token = bin2hex(random_bytes(20));
		$time = date('Y-m-d H:i:s');
		$username = $user['username'];
		$stmt = $conn->prepare("UPDATE `users` SET `f_p_token` = ?, f_time = ? WHERE `users`.`username`  = ?");
		$stmt->bind_param("sss", $token, $time, $username);
		$stmt->execute();
		
		$name = $user['fname'] . " " . $user['lname'];
		$message = 'You have requested for Password reset link click on the below link to reset your password <br> <a href="http://localhost/systemVista/dist/newpass.php?token='. $token.'&username='.$username.'">http://localhost/systemVista/dist/newpass.php?token='. $token.'&username='.$username.'</a>';
		mailsent($email,$name,"reset password link (System Vista)",$message);
		// header('Location: dash.php');
		
		$smessage = "Mail Sent check your email address";
	} else {
		// Login failed, display error message
		$error = 'Invalid Username or Email address';
	}
}
?>






<!DOCTYPE html>
<html lang="en">

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

<body id="kt_body" class="app-blank app-blank">
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
	<div class="d-flex flex-column flex-root" id="kt_app_root">
		<div class="d-flex flex-column flex-lg-row flex-column-fluid">
			<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center" style="background-image: url(assets/media/misc/auth-bg.png)">
				<div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">
					<a href="Index.php" class="mb-0 mb-lg-20">
						<img alt="Logo" src="assets/media/stock/etc/logo_w.png" class="h-40px h-lg-80px" />
					</a>
					<img class="d-none d-lg-block mx-auto w-300px w-lg-75 w-xl-500px mb-10 mb-lg-20 rounded" src="assets/media/stock/etc/fogot.jpg" alt="" />
					<!-- <h1 class="d-none d-lg-block text-white fs-2qx fw-bold text-center mb-7">Dine-in or take-out, our food is always fresh and delicious</h1> -->
					<div class="d-none d-lg-block text-white fs-base text-center " ><span style="font-size:20px;">Dine-in or take-out, <br>our food is always fresh and delicious</span></div>
				</div>
			</div>

			<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">

				<div class="d-flex flex-center flex-column flex-lg-row-fluid">

					<div class="w-lg-500px p-10">

						<form class="form w-100" method="POST" action="#">

							<div class="text-center mb-10">

								<h1 class="text-dark fw-bolder mb-3">Forgot Password ?</h1>

								<div class="text-gray-500 fw-semibold fs-6">Enter your email & username to reset your password.</div>

								<h1 class="text-danger fw-bolder mb-3 mt-5"><?php if(isset($error)){echo $error;} ?></h1>
								<h1 class="text-success fw-bolder mb-3 mt-5"><?php if(isset($smessage)){echo $smessage;} ?></h1>

							</div>

							<div class="fv-row mb-3">

								<input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" required />

							</div>
							<div class="fv-row mb-8">

								<input type="text" placeholder="username" name="username" autocomplete="off" class="form-control bg-transparent" required />

							</div>

							<div class="d-flex flex-wrap justify-content-center pb-lg-0">
								<button type="submit" id="kt_password_reset_submit" class="btn btn-primary me-4">

									<span class="indicator-label">Submit</span>



								</button>
								<a href="Index.php" class="btn btn-light">Cancel</a>
							</div>

						</form>

					</div>

				</div>

				<div class="d-flex flex-center flex-wrap px-5">

					<div class="d-flex fw-semibold text-primary fs-base">
						<a href="#" class="px-5" target="_blank">Developed By &#x1F525; Harshit & &#128526; shubham. & &#128526; shivvardhan</a>

					</div>

				</div>

			</div>

		</div>

	</div>

	<script>
		var hostUrl = "assets/";
	</script>

	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<script src="assets/js/custom/authentication/reset-password/reset-password.js"></script>

</body>

</html>