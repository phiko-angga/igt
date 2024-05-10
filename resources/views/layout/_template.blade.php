<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1.0"/>
  <title> @if(isset($title)) {{$title}} @else '' @endif </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

		<!-- Site favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png"/>
		<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
		<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />

		<!-- Mobile Specific Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="/vendors/styles/core.css" />
		<link rel="stylesheet" type="text/css" href="/vendors/styles/icon-font.min.css" />
		<link rel="stylesheet" type="text/css" href="/plugins/datatables/css/dataTables.bootstrap4.min.css" />
		<link rel="stylesheet" type="text/css" href="/plugins/datatables/css/responsive.bootstrap4.min.css" />
		<link rel="stylesheet" type="text/css" href="/vendors/styles/style.css" />
		<link rel="stylesheet" type="text/css" href="/styles/theme.css" />

  @yield('style')

</head>

<body>
  
    <!-- @include('layout._preloader') -->
    @include('layout._header')
    @include('layout._sidebar')

		<div class="main-container">
			<div class="xs-pd-20-10 pd-ltr-20">
				@include('layout._page_header')
				@yield('content')
			</div>
		</div>

    <!-- Core JS -->
		<!-- js -->
		<script src="/vendors/scripts/core.js"></script>
		<script src="/vendors/scripts/script.min.js"></script>
		<script src="/vendors/scripts/process.js"></script>
		<script src="/vendors/scripts/layout-settings.js"></script>
		<script src="/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script src="/vendors/scripts/dashboard3.js"></script>
		<script src="/scripts/custom.js"></script>
		<script>
			var baseUrl = "{{url('')}}";
		</script>
    @yield('script')
</body>



