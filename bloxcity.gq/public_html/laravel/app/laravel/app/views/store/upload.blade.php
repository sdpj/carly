@section('additional-css')
	<link rel="stylesheet" href="//cdn.jsdelivr.net/dropkick/1.4/dropkick.css">
@stop
@section('content')

	<h1 class="title">Upload an Item to the {{{ $sitename }}} Store</h1>

	@if ($errors->any())
		<div class="well error-well">
			<ul>
				{{ implode('', $errors->all('<li>:message</li>')) }}
			</ul>
		</div>
	@endif
	@if( Session::has('dimension_error') )
		<div class="well error-well">
			<p>That image doesn't have the required dimensions!</p>
		</div>
	@endif 
	@if( Session::has('mime_error') )
		<div class="well error-well">
			<p>That image isn't a PNG file!</p>
		</div>
	@endif 

	{{ Form::open(array('url' => '/store/upload', 'autocomplete' => 'off', 'files' => true))}}

		<h3 class="form">Select an Image</h3>

		{{ Form::label('image', 'Upload your Image', array('class' => 'filelabel')); }}
		{{ Form::file('image', array('class' => 'uploadFile', 'id' => 'image', 'style' => 'visibility: hidden; display: none;')); }}

		<div id="imagePreview"></div>

		<h3 class="form">Item Information</h3>

		{{ Form::label('name', 'Item Name'); }}
		{{ Form::text('name', '', array('class' => 'fw', 'placeholder' => 'Item Name')) }}

		{{ Form::label('description', 'Item Description'); }}
		{{ Form::textarea('description', '', array('class' => 'fw', 'placeholder' => 'Begin writing your description here...')) }}

		{{ Form::label('category', 'Item Category'); }}
		{{ Form::select('category', ['clothing' => 'Clothing', 'headgear' => 'Headgear', 'accessories' => 'Accessories', 'addons' => 'Add-ons'], '', array('class' => 'default fw')) }}

		{{ Form::label('cost', 'Cost in '.$currency_1); }}
		{{ Form::text('cost', '', array('class' => 'fw', 'placeholder' => 'Cost in '.$currency_1)) }}

		{{ Form::submit('Publish Item to Store', array('class' => 'btn-block btn-submit')) }}

	{{ Form::close() }}

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