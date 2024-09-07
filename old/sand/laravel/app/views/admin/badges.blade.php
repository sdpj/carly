@section('content')

@include('admin.panel')

@if (Request::is('admin/badges'))

	<h1 class="title">Badges</h1>

	@if( Session::has('success') )
		<div class="well success-well">
			<p>The badge has been successfully created/modified/deleted!</p>
		</div>
	@endif 

	@foreach ($badges as $badge)

		<div class="admin-badge-row">
			<img src="{{ asset('/user_img/badges/'.$badge->filename) }}">
			<div class="info">
				<h2>{{{ $badge->name }}}</h2>
				<p>{{{ $badge->description }}}</p>
				<span>Issued to <strong>{{ BadgeUser::where('badge_id', '=', $badge->id)->count() }}</strong> users | </span>
				<span>Created <strong>{{ $badge->created_at->diffForHumans() }}</strong></span>
			</div>
			<div class="actions">
				<a href="{{ url('/admin/badges/'.$badge->id.'/delete') }}"><i class="fa fa-close"></i></a>
				<a href="{{ url('/admin/badges/'.$badge->id.'/edit') }}"><i class="fa fa-pencil"></i></a>
			</div>
		</div>

	@endforeach

	<a href="{{ url('/admin/badges/new') }}" class="btn-block btn-submit">Create a New Badge</a>

@elseif (Request::is('admin/badges/new'))

	<h1 class="title">New Badge</h1>

	@if ($errors->any())
		<div class="well error-well">
			<ul>
				{{ implode('', $errors->all('<li>:message</li>')) }}
			</ul>
		</div>
	@endif

	@if( Session::has('dimension_error') )
		<div class="well error-well">
			<p>The image you upload must be in the dimensions 128x128!</p>
		</div>
	@endif 

	@if( Session::has('mime_error') )
		<div class="well error-well">
			<p>The image you upload must be a PNG file!</p>
		</div>
	@endif 

	{{ Form::open(array('url' => '/admin/badges/new', 'autocomplete' => 'off', 'files' => true))}}

		<h3 class="form">Select an Image</h3>

		{{ Form::label('image', 'Upload your Image', array('class' => 'filelabel')); }}
		{{ Form::file('image', array('class' => 'uploadFile', 'id' => 'image', 'style' => 'visibility: hidden; display: none;')); }}

		<div id="imagePreview"></div>

		<h3 class="form">Badge Information</h3>

		{{ Form::label('name', 'Badge Name'); }}
		{{ Form::text('name', '', array('class' => 'fw', 'placeholder' => 'Badge Name')) }}

		{{ Form::label('description', 'Badge Description'); }}
		{{ Form::textarea('description', '', array('class' => 'fw', 'placeholder' => 'Begin writing the description here...')) }}

		{{ Form::submit('Create Badge', array('class' => 'btn-block btn-submit')) }}

	{{ Form::close() }}

@elseif (Request::is('admin/badges/*/edit'))

	<h1 class="title">Edit Badge</h1>

	@if ($errors->any())
		<div class="well error-well">
			<ul>
				{{ implode('', $errors->all('<li>:message</li>')) }}
			</ul>
		</div>
	@endif

	@if( Session::has('dimension_error') )
		<div class="well error-well">
			<p>The image you upload must be in the dimensions 128x128!</p>
		</div>
	@endif 

	@if( Session::has('mime_error') )
		<div class="well error-well">
			<p>The image you upload must be a PNG file!</p>
		</div>
	@endif 

	{{ Form::open(array('url' => '/admin/badges/'.$badge->id.'/edit', 'autocomplete' => 'off', 'files' => true))}}

		<h3 class="form">Select an Image</h3>

		{{ Form::label('image', 'Upload your Image', array('class' => 'filelabel')); }}
		{{ Form::file('image', array('class' => 'uploadFile', 'id' => 'image', 'style' => 'visibility: hidden; display: none;')); }}

		<div id="imagePreview" style="background-image: url('{{ asset('user_img/badges/'.$badge->filename) }}')"></div>

		<h3 class="form">Badge Information</h3>

		{{ Form::label('name', 'Badge Name'); }}
		{{ Form::text('name', $badge->name, array('class' => 'fw', 'placeholder' => 'Badge Name')) }}

		{{ Form::label('description', 'Badge Description'); }}
		{{ Form::textarea('description', $badge->description, array('class' => 'fw', 'placeholder' => 'Begin writing the description here...')) }}

		{{ Form::submit('Update Badge', array('class' => 'btn-block btn-submit')) }}

	{{ Form::close() }}

@elseif (Request::is('admin/badges/assign/*'))

	<h1 class="title">Assign Badge to {{{ $user->username }}}</h1>

	@if ($errors->any())
		<div class="well error-well">
			<ul>
				{{ implode('', $errors->all('<li>:message</li>')) }}
			</ul>
		</div>
	@endif

	{{ Form::open(array('url' => '/admin/badges/assign/'.$user->id, 'autocomplete' => 'off'))}}

		{{ Form::label('type', 'Badge Type') }}
		{{ Form::select('type', $badge_types, '', array('class' => 'default fw')) }}

		{{ Form::submit('Assign Badge to '.$user->username, array('class' => 'btn-block btn-submit')) }}

	{{ Form::close() }}

@elseif (Request::is('admin/badges/remove/*'))

	<h1 class="title">Remove Badge from {{{ $user->username }}}</h1>

	@if ($errors->any())
		<div class="well error-well">
			<ul>
				{{ implode('', $errors->all('<li>:message</li>')) }}
			</ul>
		</div>
	@endif

	{{ Form::open(array('url' => '/admin/badges/remove/'.$user->id, 'autocomplete' => 'off'))}}

		{{ Form::label('type', 'Badge Type') }}
		{{ Form::select('type', $badge_types, '', array('class' => 'default fw')) }}

		{{ Form::submit('Remove Badge from '.$user->username, array('class' => 'btn-block btn-submit')) }}

	{{ Form::close() }}

@endif

@stop

@section('additional-js')
<script src="//cdn.jsdelivr.net/dropkick/1.4/jquery.dropkick-min.js"></script>
@stop
@section('additional-jquery')
$('.default').dropkick();
$(function() {
    $(".uploadFile").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
        }
    });
});
@stop