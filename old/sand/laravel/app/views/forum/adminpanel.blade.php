@section('additional-css')
	<link rel="stylesheet" href="//cdn.jsdelivr.net/dropkick/1.4/dropkick.css">
@stop
<div id="forum-panel">
	<div class="pull-left">
		@if ($thread->locked == 1)
			<a href="{{ url(''.Request::url().'/unlock') }}" class="btn-normal red"><i class="fa fa-lock"></i>Unlock Thread</a>
		@else
			<a href="{{ url(''.Request::url().'/lock') }}" class="btn-normal red"><i class="fa fa-lock"></i>Lock Thread</a>
		@endif
		@if ($thread->sticky == 1)
			<a href="{{ url(''.Request::url().'/unsticky') }}" class="btn-normal yellow"><i class="fa fa-thumb-tack"></i>Unsticky Thread</a>
		@else
			<a href="{{ url(''.Request::url().'/sticky') }}" class="btn-normal yellow"><i class="fa fa-thumb-tack"></i>Sticky Thread</a>
		@endif
		<a href="#" class="btn-normal blue" id="move-thread"><i class="fa fa-share"></i>Move Thread</a>
	</div>
	<div class="pull-right">
		<a href="{{ url(''.Request::url().'/delete') }}" class="btn-normal red danger"><i class="fa fa-trash"></i>Delete Thread</a>
	</div>
</div>

<div id="move-thread-modal" class="modal">
	<h2>So you want to move a thread, huh?</h2>
	<hr>
	<h4>Where do you want to move this thread?</h4>

	{{ Form::open(array('url' => url(''.Request::url().'/move'), 'autocomplete' => 'off'))}}
		
		{{ Form::select('topic', $selectedTopic, null, array('class' => 'default')) }}

		<div class="clear"></div>
		<hr>
		<div id="forum-panel">
			<div class="pull-left">
				<button type="submit" class="btn-normal green"><i class="fa fa-check"></i>Move Thread</a>
			</div>
			<div class="pull-right">
				<a href="#" id="move-thread-close" class="btn-normal red"><i class="fa fa-ban"></i>Cancel</a>
			</div>
		</div>

	{{ Form::close() }}
</div>

@section('additional-script')
	$(function() {
	  $("#move-thread").click(function(event) {
	  	event.preventDefault();
	    $("#modal-overlay").addClass("active");
	    $("#move-thread-modal").addClass("active");
	  });
	  $("#move-thread-close").click(function(event) {
	  	event.preventDefault();
	  	$("#modal-overlay").removeClass("active");
	    $("#move-thread-modal").removeClass("active");
	  });
	});
@stop
@section('additional-js')
	<script src="//cdn.jsdelivr.net/dropkick/1.4/jquery.dropkick-min.js"></script>
@stop
@section('additional-jquery')
	$(document.body).append("<div id='modal-overlay'></div>");
	$('.default').dropkick();
@stop