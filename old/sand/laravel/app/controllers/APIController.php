<?php

class APIController extends BaseController {

	public function GetUser($id)
	{
		if (User::find($id)) {
			$user = User::where('id', '=', $id)->get(array(	'id', 'username', 'gender', 'race', 'description',
															'signature', 'timezone', 'created_at', 'last_activity'));
		    return Response::json(array(
		        'error' => false,
		        'user' => $user->toArray()),
		        200
		    );
		} else {
		    return Response::json(array(
		        'error' => true,
		        'message' => 'The selected User ID does not exist'),
		        200
		    );
		}
	}

	public function GetPrivateUser($apikey)
	{
	    if (APIKey::where('key', '=', $apikey)->count() == 0) {
		    return Response::json(array(
		        'error' => true,
		        'message' => 'The selected API key does not exist'),
		        200
		    ); 	
	    } else {
			$user = User::where('id', '=', APIKey::where('key', '=', $apikey)->first()->user_id)->get(array('id', 'email', 'currency_1', 'regip'));
		    return Response::json(array(
		        'error' => false,
		        'user' => $user->toArray()),
		        200
		    );    	
	    }
	}

}