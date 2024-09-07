@section('content')

@include('admin.panel')

<h1 class="title">{{{ $sitename }}} Economy</h1>

<div class="economy-graph">
	<h3>Top 15 holders of {{{ $currency_1 }}}</h3>
	<canvas id="chart1" class="economy-graph" width="500" height="400"></canvas>
</div>

<div class="economy-graph">
	<h3>Top 15 holders of {{{ $currency_1 }}} (without staff)</h3>
	<canvas id="chart2" class="economy-graph" width="500" height="400"></canvas>
</div>

<h3>Daily Economy History ({{{ $currency_1 }}} - past week)</h3>
<canvas id="chart3" width="1100" height="400"></canvas>

@stop

@section('additional-js')
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1-beta/Chart.min.js"></script>
@stop
@section('additional-script')
var data1 = {
    @if (count($top15_username) < 15)
        labels: [@for ($i = 1; $i <= count($top15_username); $i++) "{{{ $top15_username[$i] }}}", @endfor],
    @else
        labels: [@for ($i = 1; $i <= 15; $i++) "{{{ $top15_username[$i] }}}", @endfor],
    @endif
    datasets: [
        {
            label: "{{{ $currency_1 }}}",
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            @if (count($top15_username) < 15)
                data: [@for ($i = 1; $i <= count($top15_currency); $i++) "{{{ $top15_currency[$i] }}}", @endfor]
            @else
                data: [@for ($i = 1; $i <= 15; $i++) "{{{ $top15_currency[$i] }}}", @endfor]
            @endif
        }
    ]
};
var data2 = {
    @if (count($top15_username) < 15)
        labels: [@for ($i = 1; $i <= count($top15_username_2); $i++) "{{{ $top15_username_2[$i] }}}", @endfor],
    @else
        labels: [@for ($i = 1; $i <= 15; $i++) "{{{ $top15_username_2[$i] }}}", @endfor],
    @endif
    datasets: [
        {
            label: "{{{ $currency_1 }}}",
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            @if (count($top15_username) < 15)
                data: [@for ($i = 1; $i <= count($top15_currency_2); $i++) "{{{ $top15_currency_2[$i] }}}", @endfor]
            @else
                data: [@for ($i = 1; $i <= 15; $i++) "{{{ $top15_currency_2[$i] }}}", @endfor]
            @endif
        }
    ]
};
var data3 = {
    @if (Economy::where('type', '=', 'daily')->count() < 7)
    	labels: [@for ($i = 1; $i <= Economy::where('type', '=', 'daily')->count(); $i++) "{{{ $economy_date[$i]->toFormattedDateString() }}}", @endfor],
    @else
    	labels: [@for ($i = 1; $i <= 7; $i++) "{{{ $economy_date[$i]->toFormattedDateString() }}}", @endfor],
    @endif
    datasets: [
        {
            label: "{{{ $currency_1 }}}",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            @if (Economy::where('type', '=', 'daily')->count() < 7)
            	data: [@for ($i = 1; $i <= Economy::where('type', '=', 'daily')->count(); $i++) "{{{ $economy_total[$i] }}}", @endfor]
            @else
            	data: [@for ($i = 1; $i <= 7; $i++) "{{{ $economy_total[$i] }}}", @endfor]
            @endif
        }
    ]
};
var chart1 = new Chart($("#chart1").get(0).getContext("2d")).Bar(data1);
var chart2 = new Chart($("#chart2").get(0).getContext("2d")).Bar(data2);
var chart3 = new Chart($("#chart3").get(0).getContext("2d")).Line(data3);
@stop