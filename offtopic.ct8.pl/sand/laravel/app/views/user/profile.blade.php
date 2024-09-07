@section('content')

	@if (Auth::check() && Auth::user()->id == $user->id)

		<div id="forum-panel">
			<div class="pull-right">
				<a href="{{ url('/user/profile/edit') }}" class="btn-normal blue"><i class="fa fa-pencil"></i>Edit Profile</a>
			</div>
		</div>

	@endif

	@if( Session::has('banned') )
		<div class="well success-well">
			<p>This user has been successfully banned!</p>
		</div>
	@endif 

	@if( Session::has('unbanned') )
		<div class="well success-well">
			<p>This user has been successfully unbanned!</p>
		</div>
	@endif 

	@if( Session::has('success') )
		<div class="well success-well">
			<p>That action has been completed successfully!</p>
		</div>
	@endif 

	@if (!empty($user->profile_banner))
		<div style="background: url('{{ url('/user_img/profile/'.$user->profile_banner.'') }}')" class="profile-banner"></div>
	@endif

	<div id="profile-username">
	<h2>{{ $user->username }}'s Profile</h2>
	</div>

	<div id="profile-av-row">
		<div id="profile-av-sidebar">
			<div id="profile-av">
				<img id="avatar" src="{{$user->getAvatarURL()}}">
			</div>
			@if (Auth::check() && Auth::user()->id != $user->id)
				<div id="profile-buttons">
					<a href="{{url('user/pm/from/'.$user->id)}}" class="profile-btn btn-blue-stripe">Private Message</a>
					<!--<a href="{{url('user/friends/send/'.$user->id)}}" class="profile-btn btn-green-stripe">Add as Friend</a>-->
					<a href="#" class="profile-btn btn-purple-stripe">Donate Money</a>
					<a href="#" class="profile-btn btn-red-stripe">Report User</a>
				</div>
			@endif
		</div>
		<div id="profile-info">
			<h2>Profile Description</h2>
			<hr>
			@if (empty($user->description))
				<div class="well">
					<p>This user hasn't set a description yet! :(</p>
				</div>
			@else
				<p>{{ $user->description }}</p>
			@endif
			<h2>User Information</h2>
			<hr>
			<div id="profile-info-info">
				<div class="profile-info"><strong>Username:</strong><span>{{ $user->username }}</span></div>
				<div class="profile-info"><strong>Gender:</strong><span>
					@if ($user->gender)
						{{ ucfirst($user->gender) }}
					@else
						Not Specified
					@endif
				</span></div>
				<div class="profile-info"><strong>Post Count:</strong><span>{{ $user->countPosts() }}</span></div>
				<div class="profile-info">
					<strong>Website Rank:</strong>
					<span>
						{{ $user->getProfileRank() }}
					</span>
				</div>
				<div class="profile-info">
					<strong>Last Active:</strong>
					<span>{{ $user->last_activity->diffForHumans() }}</span>
				</div>
				<div class="profile-info"><strong>Join Date:</strong>
				<span>
					@if (Auth::check())
						{{ $user->created_at->timezone(Auth::user()->timezone)->toDayDateTimeString() }}
					@else
						{{ $user->created_at->toDayDateTimeString() }}
					@endif
				</span>
				</div>
			</div>
					<div id="profile-badges">
			<h4>{{{ $user->username }}}'s Badges</h4>
			<hr>
			<div class="badge-row">
				@foreach ($badges as $badge)
					<div class="badge">
						<img src="{{ asset('user_img/badges/'.BadgeType::find($badge->badge_id)->filename) }}" title="{{ BadgeType::find($badge->badge_id)->name }}">
					</div>
				@endforeach
			</div>
		</div>
		</div>
	</div>

	@if (Auth::check() && Auth::user()->hasRole('Administrator'))

		<div id="forum-panel">
			<div class="pull-left">
				<a href="{{ url('/admin/badges/assign/'.$user->id) }}" class="btn-normal blue"><i class="fa fa-tag"></i>Assign a Badge</a>
				<a href="{{ url('/admin/badges/remove/'.$user->id) }}" class="btn-normal yellow"><i class="fa fa-remove"></i>Remove a Badge</a>
				<a href="{{ url('/admin/roles/assign/'.$user->id) }}" class="btn-normal blue"><i class="fa fa-user"></i>Assign a Role</a>
				<a href="{{ url('/admin/roles/remove/'.$user->id) }}" class="btn-normal yellow"><i class="fa fa-remove"></i>Remove a Role</a>
				<a href="{{ url('/admin/edituser/'.$user->id) }}" class="btn-normal blue"><i class="fa fa-pencil"></i>Modify User</a>
			</div>
			<div class="pull-right">
				@if ($user->isBanned())
					<a href="{{ url('/admin/unban/'.$user->id) }}" class="btn-normal red"><i class="fa fa-legal"></i>Unban User</a>
				@else
					<a href="{{ url('/admin/ban/'.$user->id) }}" class="btn-normal red"><i class="fa fa-legal"></i>Ban User</a>
				@endif
			</div>
		</div>

	@endif

@stop