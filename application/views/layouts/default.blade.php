<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Tekkit Item Calculator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<?=Asset::container('bootstrapper')->styles()?>
		@yield('styles')

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</head>

	<body>
		{{ $topmenu }}
		<div class="container">
			@if(isset($crumbs))
			{{ Breadcrumbs::create($crumbs) }}
			@endif
			@yield('content')
		</div>

		<?=Asset::container('bootstrapper')->scripts()?>
		@yield('scripts')
	</body>
</html>