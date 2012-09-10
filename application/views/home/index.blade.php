@layout('layouts/default')

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/app.css') }}" />
@endsection

@section('content')
<div class="row">
	<div class="span5" id="items">
		@foreach ($items as $item)
			<div class="well">
				<img src="{{ $url($item->alias?:$item->name) }}" title="{{ $item->name }}" />
			</div>
		@endforeach
	</div>
	<div class="span7">
		<div class="row">
			<div id="inventory">
				<div class="well"></div>
			</div>
		</div>
		<div class="row">
			<div id="result">
				<div class="well"></div>
			</div>
		</div>
	</div>
</div>

@endsection
