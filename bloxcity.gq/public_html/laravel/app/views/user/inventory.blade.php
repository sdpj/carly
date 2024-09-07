@section('content')

	<h1 class="title">User Inventory</h1>

	<div id="inventory-preview">
		<img id="avatar" src="{{ url(Auth::user()->getAvatarURL()) }}">
	</div>

	<div id="inventory-help">
		<h2>How to use the Inventory</h2>
		<hr>
		<p>Using the Inventory to modify your avatar on {{{ $sitename }}} is pretty straight forward. To do so, follow these steps:</p>
		<br>
		<strong>Step 1: </strong><span>Decide which slot you wish to modify (the higher the number, the higher it's priority)</span>
		<br><br>
		<strong>Step 2: </strong><span>Browse your inventory of items and find which one you wish to choose</span>
		<br><br>
		<strong>Step 3: </strong><span>Click the item you wish to assign to your chosen slot</span>
	</div>

	<div id="slots">
		@for ($i = 1; $i <= 8; $i++)
			<div class="slot">
				<a href="{{ url('/user/inventory/slot/'.$i) }}">
					@if (Slot::where('user_id', '=', Auth::user()->id)->first()->{'slot'.$i})
						<img src="{{ url('user_img/avatar/'.Item::find(Slot::where('user_id', '=', Auth::user()->id)->first()->{'slot'.$i})->filename) }}">
					@else
						<img src="{{ url('media/img/blank_slot.png') }}">
					@endif
					<span>Slot {{ $i }}</span>
				</a>
			</div>
		@endfor
	</div>
@stop