<?php

class RemindersController extends BaseController {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	protected $layout = 'layouts.master';

	public function ShowRemind()
	{
		if (Auth::check()) {
			return Redirect::to('/user/dashboard');
		}
		$this->layout->title   			= "Forgotten Password";
		$this->layout->content 			= View::make('password.view');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function DoRemind()
	{
		$now = Carbon::now();
		$input = Input::only('username');
		$userrow = User::where('username', '=', $input)->first();
		
		if (!empty($userrow)){
			$email = $userrow->email;
			$getresets = Remind::where('email', '=', $email)->orderBy('created_at', 'desc')->first();
			$lastreset = $getresets->created_at;
			if ($now->diffInMinutes($lastreset) < 5){
				return Redirect::back()->with('error', 'You have had a password reset sent already!');
			}
		}
		switch ($response = Password::remind(Input::only('username'), function($message)
		{
		    $message->subject('Password Reminder');
		})){
			case Password::INVALID_USER:
				return Redirect::back()->with('error', 'That e-mail address does not match any accounts! :(');

			case Password::REMINDER_SENT:
				return Redirect::back()->with('status', Lang::get($response));
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		$this->layout->title   			= "Forgotten Password";
		$this->layout->content 			= View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'username', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:
				return Redirect::to('/user/signin');
		}
	}

}
