@section('content')

@include('admin.panel')

<h1 class="title">Admin Dashboard</h1>

@if( Session::has('success') )
    <div class="well success-well">
        <p>The previously initiated action has been completed successfully!</p>
    </div>
@endif 

<h3 class="subtitle">Site Statistics</h3>

<div class="economy-graph">
	<h3>Recent User Registrations</h3>
	<canvas id="chart1" class="economy-graph" width="500" height="400"></canvas>
</div>

<div class="economy-graph">
	<h3>Administration Actions</h3>
    @if ($maintenance == "off")
        <a href="{{ url('/admin/maintenance') }}" class="btn-block btn-submit">Activate Maintenance</a>
    @else
        <a href="{{ url('/admin/maintenance/recover') }}" class="btn-block btn-submit">Deactivate Maintenance</a>
    @endif
</div>

@stop
@section('additional-js')
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1-beta/Chart.min.js"></script>
@stop
@section('additional-script')
var data1 = {
    labels: [@for ($i = 1; $i <= 7; $i++) "{{{ $recent_reg_date[$i]->toFormattedDateString() }}}", @endfor],
    datasets: [
        {
            label: "Number of Registered Users",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [@for ($i = 1; $i <= 7; $i++) "{{{ $recent_reg_total[$i] }}}", @endfor]
        }
    ]
};
var options1 = {
    bezierCurveTension : 0.2,
    scaleBeginAtZero: true,
};
var chart1 = new Chart($("#chart1").get(0).getContext("2d")).Line(data1, options1);
@stop