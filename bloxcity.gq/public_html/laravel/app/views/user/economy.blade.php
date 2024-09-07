@section('content')

	<h1 class="title">User Economy Statistics</h1>

	@if (count($logs) != 0)

		<table id="economy-logs">
			<thead>
				<tr>
					<th><strong>Type</strong></th>
					<th><strong>Change</strong></th>
					<th><strong>New Balance</strong></th>
					<th><strong>Additional Info</strong></th>
					<th><strong>Date / Time</strong></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($logs as $log)
					<tr>
						@if ($log->type == "stipend")
							<td>Daily Stipend</td>
							<td class="positive">+ {{{ $log->new_data - $log->old_data }}}</td>
							<td>{{{ $log->new_data }}}</td>
							<td></td>
						@elseif ($log->type == "item_purchase")
							<td>Item Purchase</td>
							<td class="negative">- {{{ Item::find($log->new_data)->cost }}}</td>
							<td>{{{ $log->old_data }}}</td>
							<td>{{{ Item::find($log->new_data)->name }}}</td>
						@elseif ($log->type == "donation_out")
							<td>Outbound Donation</td>
							<td class="negative">- {{{ $log->old_data }}}</td>
							<td>{{{ $log->new_data }}}</td>
							<td>{{{ User::find($log->data_3)->username }}}</td>
						@elseif ($log->type == "donation_in")
							<td>Inbound Donation</td>
							<td class="positive">+ {{{ $log->old_data }}}</td>
							<td>{{{ $log->new_data }}}</td>
							<td>{{{ User::find($log->data_3)->username }}}</td>
						@endif
						<td>{{ $log->created_at->timezone(Auth::user()->timezone)->toDayDateTimeString() }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	  	{{ $logs->links() }}

	@else
	  <div class="well">
	    <p>Your account has no economy history!</p>
	  </div>
	@endif

@stop