<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>LOGIN - IGT</title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon" sizes="180x180" href="/vendors/images/apple-touch-icon.png" />
		<link rel="icon" type="image/png" sizes="32x32" href="/vendors/images/favicon-32x32.png" />
		<link rel="icon" type="image/png" sizes="16x16" href="/vendors/images/favicon-16x16.png" />

		<!-- Mobile Specific Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="/vendors/styles/core.css" />
		<link rel="stylesheet" type="text/css" href="/vendors/styles/icon-font.min.css" />
		<link rel="stylesheet" type="text/css" href="/vendors/styles/style.css" />

	</head>
	<body class="login-page d-flex">
		<div class="my-auto w-100 d-flex align-items-center flex-wrap justify-content-center" >
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 col-lg-7">
						<img src="/vendors/images/login-page-img.png" alt="" />
					</div>
					<div class="col-md-6 col-lg-5">
						<div class="login-box bg-white box-shadow border-radius-10">
							<div class="login-title">
								<h2 class="text-center text-primary">Login To IGT</h2>
							</div>
    						@include('layout._notification')
							<form method="post" action="{{url('login')}}">
								@csrf
								<div class="input-group custom">
									<input type="text" class="form-control form-control-lg" placeholder="Username" name="username"/>
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
									</div>
								</div>
								<div class="input-group custom">
									<input type="password" class="form-control form-control-lg" placeholder="**********" name="password"/>
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
									</div>
								</div>
								<div class="row pb-30">
									<div class="col-6">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="remember" id="remember"/>
											<label class="custom-control-label" for="remember">Remember</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
											<button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
										</div>
										
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    
		<!-- js -->
		<script src="/vendors/scripts/core.js"></script>
		<script src="/vendors/scripts/script.min.js"></script>
		<script src="/vendors/scripts/process.js"></script>
		<script src="/vendors/scripts/layout-settings.js"></script>
    
	</body>
</html>
