@section('content')

<h1 class="title">{{{ $sitename }}} Store</h1>

<div id="store-container">

	<div id="store-sidebar">
		<h3>Categories</h3>

		@if (Request::is('store'))
			<a href="{{ url('/store') }}" class="active">All Items</a>
		@else
			<a href="{{ url('/store') }}">All Items</a>
		@endif
		@if (Request::is('store/clothing'))
			<a href="{{ url('/store/clothing') }}" class="active">Clothing</a>
		@else
			<a href="{{ url('/store/clothing') }}">Clothing</a>
		@endif
		@if (Request::is('store/headgear'))
			<a href="{{ url('/store/headgear') }}" class="active">Headgear</a>
		@else
			<a href="{{ url('/store/headgear') }}">Headgear</a>
		@endif
		@if (Request::is('store/accessories'))
			<a href="{{ url('/store/accessories') }}" class="active">Accessories</a>
		@else
			<a href="{{ url('/store/accessories') }}">Accessories</a>
		@endif
		@if (Request::is('store/addons'))
			<a href="{{ url('/store/addons') }}" class="active">Add-Ons</a>
		@else
			<a href="{{ url('/store/addons') }}">Add-Ons</a>
		@endif
<!--// && Auth::user()->can('CanUpload')-->
		@if (Auth::check() && SiteConfig::find(1)->userstore == 'true')
			<h3>Upload Item</h3>
			<a href="{{ url('/store/upload') }}">Go to Upload Form</a>
		@endif
		
		@if (Auth::check() && Auth::user()->can('CanUpload'))
			<h3>Upload Item</h3>
			<a href="{{ url('/store/upload') }}">Go to Upload Form</a>
		@endif
	</div>

	<div id="store-content">

		@foreach ($items as $item)
			<div class="item">
				<a href="{{ url('/store/item/'.$item->id.'') }}">
					<img src="{{ url('/user_img/avatar/'.$item->filename) }}">
					<span>{{{ str_limit($item->name, $limit = 15, $end = '...') }}}</span>
				</a>
			</div>
		@endforeach

		@if (count($items) == 0)

			<div class="well">
				<p>There are no items in this category!</p>
			</div> 

		@endif

		{{ $items->links() }}

	</div>

</div>

@stop