@section('content')

	<h1>Update SANS 2.0</h1>

	<p>This upgrade process is to upgrade your SANS installation from Version <strong>{{ $current }}</strong> to Version <strong>{{ $new }}</strong>.</p>

	@if ($ready)
		<div class="well error-well">
			<span>When updating, any changes you have made to the base code of SANS may be overwritten. We recommend you make a backup of any changes before updating. A full changelog is available in the Update .ZIP file!</span>
		</div>

		<a href="{{ url('/update/start') }}" class="btn">Update Installation</a>
	@else
		<div class="well error-well">
			<span>This is not the correct version of updater for your version of SANS.<br>Please download the correct update .ZIP file and upload the contents to your installation!</span>
		</div>
	@endif

@stop