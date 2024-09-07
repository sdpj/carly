@section('content')

	<h1 class="title">{{{ $item->name }}}</h1>

	@if( Session::has('success') )
		<div class="well success-well">
			<p>You've successfully purchased <strong>{{{ $item->name }}}</strong>! Your <strong>{{{ $siteconfig->currency_1 }}}</strong> balance is now <strong>{{{ Auth::user()->currency_1 }}}</strong>.</p>
		</div>
	@endif 

	<div id="store-item-preview">
		<img src="{{ url('/user_img/avatar/'.$item->filename) }}">
	</div>

	<div id="store-item-info">
		<div id="store-item-info-desc">
			<h3>Item Information</h3>
			<hr>
			<p>{{{ $item->description }}}</p>
			<hr>
			<div class="store-item-info-list"><strong>Type:</strong><span>{{{ ucfirst($item->category) }}}</span></div>
			<div class="store-item-info-list"><strong>Uploaded:</strong><span>{{{ $item->created_at->diffForHumans() }}}</span></div>
			<div class="store-item-info-list"><strong>Uploaded by:</strong><span>{{{ User::find($item->user_id)->username }}}</span></div>
			<div class="store-item-info-list"><strong>Number of Purchases:</strong><span>{{{ Inventory::where('item_id', '=', $item->id)->count() }}}</span></div>
		</div>
		<div id="store-item-info-purchase">
			<h3>Purchase Item</h3>
			<hr>

			@if (!Auth::check())
				<span class="cost">You are not logged in!</span>
				<a href="#" class="purchase-btn btn-disabled">Purchase Item</a>
			@elseif ($item->owned($item->id))
				<span class="cost">You already own this item!</span>
				<a href="#" class="purchase-btn btn-disabled">Purchase Item</a>
			@elseif ($item->cost > Auth::user()->currency_1)
				@if ($item->currency_type == "currency_1")
					<span class="cost">This item costs <strong>{{{ $item->cost }}} {{{ $siteconfig->currency_1 }}}</strong></span>
				@endif
				<a href="#" class="purchase-btn btn-disabled">Not Enough Funds</a>
			@else
				@if ($item->currency_type == "currency_1")
					<span class="cost">This item costs <strong>{{{ $item->cost }}} {{{ $siteconfig->currency_1 }}}</strong></span>
				@endif
				<a href="#" id="purchase-item" class="purchase-btn btn-green-stripe">Purchase Item</a>
			@endif
		</div>
	</div>

@if (Auth::check())
	<div id="purchase-item-modal" class="modal">
		<h2>Purchasing {{{ $item->name }}}</h2>
		<hr>

		<span>Your current <strong>{{{ $siteconfig->currency_1 }}}</strong> balance is <strong>{{{ Auth::user()->currency_1 }}}</strong></span>
		<br>
		<span>The item <strong>{{{ $item->name }}}</strong> costs <strong>{{{ $item->cost }}} {{{ $siteconfig->currency_1 }}}</strong></span>
		<br>
		<span>After this purchase, your <strong>{{{ $siteconfig->currency_1 }}}</strong> balance will be <strong>{{{ Auth::user()->currency_1 - $item->cost }}}</strong></span>
		<br>
		<br>
		
		<a href="{{ url('/store/item/'.$item->id.'/purchase') }}" class="btn-green-stripe">Confirm Purchase</a>
		<a href="#" id="purchase-item-close" class="btn-red-stripe">Cancel Purchase</a>
	</div>
@endif

@stop
@section('additional-script')
	$(function() {
	  $("#purchase-item").click(function(event) {
	  	event.preventDefault();
	    $("#modal-overlay").addClass("active");
	    $("#purchase-item-modal").addClass("active");
	  });
	  $("#purchase-item-close").click(function(event) {
	  	event.preventDefault();
	  	$("#modal-overlay").removeClass("active");
	    $("#purchase-item-modal").removeClass("active");
	  });
	});
@stop
@section('additional-jquery')
	$(document.body).append("<div id='modal-overlay'></div>");
@stop