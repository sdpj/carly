<?php

class UpdateController extends BaseController {

	/*

		THIS CONTROLLER AIDS IN THE UPDATING OF SANS FROM THE VERSION SPECIFIED IN
		PREVIOUS VERSION, TO THE VERSION SPECIFIED IN NEW VERSION.

		EACH VERSION HAS A NEW UPDATE CONTROLLER - DO NOT REUSE THIS CONTROLLER FOR
		ANY OTHER VERSION THAN THE ONES SPECIFIED BELOW!

	*/

	protected $layout 			= 'layouts.update';

	protected $current_version;
	protected $previous_version;
	protected $new_version;

	public function __construct()
	{ 
		$this->current_version 	= Config::get('app.version');
		$this->previous_version = "2.0.0";
		$this->new_version 		= "2.0.1";
	}

	public function CheckVersion()
	{
		if ($this->current_version == $this->previous_version) {
			return true;
		} else {
			return false;
		}
	}

	public function ShowUpdate()
	{
		$ready							= $this->CheckVersion();

		$this->layout->title   			= "SANS Update";
		$this->layout->content 			= View::make('update.home', ['ready' => $ready, 'current' => $this->previous_version, 'new' => $this->new_version]);
	}

	public function DoUpdate()
	{
		if (!$this->CheckVersion()) { App::abort(404); }

		if (File::exists('../laravel')) {
			File::copyDirectory('./update_files', '../laravel');
		} elseif (File::exists('../app')) {
			File::copyDirectory('./update_files', '../');
		} else {
			App::abort(404);
		}
		
		Config::write('app.version', $this->new_version);

		return Redirect::to('/update/complete');
	}

	public function ShowComplete()
	{
		$this->layout->title   			= "Complete";
		$this->layout->content 			= View::make('update.complete', ['version' => $this->new_version]);		
	}

}