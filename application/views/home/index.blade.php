@layout('layouts/default')

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/app.css') }}" />
@endsection

@section('content')
<div class="row">
	<div class="span5" id="items">
		<ul>
			@foreach ($items as $item)
				<li class="well">
					<img src="{{ $url($item->alias?:$item->name) }}" title="{{ $item->name }}" />
					<span>{{ $item->name }}</span>
				</li>
			@endforeach
		</ul>
	</div>
	<div class="span7">
		<div class="row">
			<div id="inventory">
				<div class="well">
					<ul id="stage"></ul>
				</div>
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

@section('scripts')
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('#stage').sortable({
			placeholder: 'info well',
			revert: true,
		});
		$('#items .well').draggable({
			connectToSortable: '#stage',
			helper: 'clone',
			revert: 'invalid',
		});
		$('#stage, #items').disableSelection();

		$('#items .well img').tooltip();
	})
</script>
@endsection
