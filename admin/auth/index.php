<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Star Admin2 </title>
	<link rel="stylesheet" href="/css/vertical-layout-light/style.css">
	<link rel="shortcut icon" href="/images/favicon.png" />
</head>

<body>
	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-center auth px-0">
				<div class="row w-100 mx-0">
					<div class="col-lg-4 mx-auto">
						<div class="auth-form-light text-left py-5 px-4 px-sm-5">
							<div class="brand-logo">
								<img src="/images/logo.svg" alt="logo">
							</div>
							<h4>Hello! let's get started</h4>
							<h6 class="fw-light">Sign in to continue.</h6>
							<form class="pt-3" method="GET">
								<div class="form-group">
									<input type="text" class="form-control form-control-lg" id="exampleInputEmail1"
										placeholder="Username" name="email">
								</div>
								<div class="form-group">
									<input type="password" class="form-control form-control-lg"
										id="exampleInputPassword1" placeholder="Password" name="password">
								</div>
								<div class="mt-3">
									<input type="submit" name="s1" value="SIGN IN"
										class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
									<?php require 'login.php';
                                        if (isset($_SESSION["login"])) {
                                            header("location:../layout/dashboard.php");
                                        }
                                    ?>
								</div>
								<div class="my-2 d-flex justify-content-between align-items-center">
									<a href="#" class="auth-link text-black">Forgot password?</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- content-wrapper ends -->
		</div>
		<!-- page-body-wrapper ends -->
	</div>
</body>

</html>
