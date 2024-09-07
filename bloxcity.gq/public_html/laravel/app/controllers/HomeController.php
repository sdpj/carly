<?php

class HomeController extends BaseController {

	protected $layout = 'layouts.master';

	public function ShowHome()
	{
		if (Auth::check()) {
			return Redirect::to('/user/dashboard');
		}
		$this->layout->title   			= "Home";
		$this->layout->content 			= View::make('home');
	}

}