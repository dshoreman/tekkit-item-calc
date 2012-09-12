@layout('layouts/default')

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/app.css') }}" />
@endsection

@section('content')
<div class="row">
	<div class="span5" id="items">
		<ul>
			@foreach ($items as $item)
				<li class="well" data-id="{{ $item->id }}">
					<img src="{{ $item->image_url?:$url($item->alias?:$item->name) }}" title="{{ $item->name }}" />
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
					{{ Buttons::large_disabled_block_primary_normal('Calculate', array('id' => 'calculate')) }}
				</div>
			</div>
		</div>
		<div class="row">
			<div id="result">
				<div class="well">
					<p class="lead">Ingredients will show here when you've<br/>dragged something to the stage</p>
				</div>
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
			receive: function(e, ui)
			{
				if ($('li', '#stage').length === 1)
				{
					$('#inventory .well button').prop('disabled', false).removeClass('disabled');
				}
			},
			revert: true,
		});
		$('#items .well').draggable({
			connectToSortable: '#stage',
			helper: 'clone',
			revert: 'invalid',
		});
		$('#stage, #items').disableSelection();

		$('#items .well img').tooltip();

		$('#calculate').click(function()
		{
			var id_array = new Array();
			$('#stage li').each(function(i, el)
			{
				id_array.push($(this).data('id'));
			})
			$.ajax({
				data: {
					recipes : id_array
				},
				type: 'POST',
				url: '{{ URL::to('ajax/calculate') }}',
				success: function(data)
				{
					var html = '';
					data = $.parseJSON(data);

					$(data).each(function(k, a)
					{
						html += '<li><img src="'+a.image_url+'" title="'+a.name+'" /><span>'+a.count+'</span></li>';
					});

					$('#result .well').html('<ul>'+html+'</ul>');
				}
			});
		});
	});
</script>
@endsection
