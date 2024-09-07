@section('content')

	<h1 class="title">Choose an item for Slot {{{ $id }}}</h1>

	@foreach ($inventory as $item)

		<div class="slot">
			<a href="{{ url('/user/inventory/slot/'.$id.'/choose/'.$item->item_id) }}">
				<img src="{{ url('user_img/avatar/'.Item::find($item->item_id)->filename) }}">
				<span>{{{ Item::find($item->item_id)->name }}}</span>
			</a>
		</div>

	@endforeach

	{{ $inventory->links() }}

	@if (count($inventory) == 0)
		<div class="well">
			<span>You have no available items to wear!</span>
		</div> 
	@endif

	<a href="{{ url('/user/inventory/slot/'.$id.'/clear') }}" class="btn-block btn-submit">Clear Slot</a>
	<a href="{{ url('/user/inventory') }}" class="btn-block btn-forgot">Back to Inventory</a>

@stop