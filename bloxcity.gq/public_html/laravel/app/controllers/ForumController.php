<?php

class ForumController extends BaseController {

	protected $layout = 'layouts.master';

	public function ShowHome()
	{
		$categories 					= ForumCat::orderBy('order', 'ASC')->get();
		$this->layout->title   			= "Forum Home";
		$this->layout->content 			= View::make('forum.home', ['categories' => $categories]);
	}

	public function ShowTopic($id)
	{
		if (!ForumTop::find($id)){
			App::abort(404);
		}
		$threads						= ForumTop::find($id)->topic()->paginate(25);
		$category	 					= ForumTop::find($id);
		$this->layout->title   			= $category->name;
		$this->layout->content 			= View::make('forum.topic', ['threads' => $threads, 'category' => $category, 'id' => $id]);
	}

	public function ShowNewThread($id)
	{
		if (!ForumTop::find($id)){
			App::abort(404);
		}
		$category	 					= ForumTop::find($id);
		$this->layout->title   			= "New Thread";
		$this->layout->content 			= View::make('forum.newthread', ['category' => $category, 'id' => $id]);
	}

	public function DoNewThread($id)
	{
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'title'          		=> 'required|regex:/[a-zA-Z0-9@#$%&*+\-_(),{}+\':;?.,<>!\[\]\s\\/]+$/|min:10',
		        'body'             		=> 'required|regex:/[a-zA-Z0-9@#$%&*+\-_(),{}+\':;?.,<>!\[\]\s\\/]+$/|min:15'
		    );
		$messages = array(
		    'required'                  => 'You must enter a :attribute for your thread!',
		    'min'	         			=> 'Your :attribute must be at least :min characters long'
		);

		$validator 	= Validator::make($data, $rule, $messages);

		$hasposted  = ForumPos::where('user_id', '=', Auth::id())->count();

		if ($validator->fails()){
		        return Redirect::to('/forum/topic/'.$id.'/new')
		                ->withErrors($validator->messages());
		} elseif ($hasposted != 0) {
			$last_post = ForumPos::where('user_id', '=', Auth::id())->orderBy('created_at', 'DESC')->first();

			if ($last_post->created_at->diffInSeconds() < 15) {
		        return Redirect::to('/forum/topic/'.$id.'/new')
		                ->withErrors('You really need to slow down with your posting ;)');
		    }
		}
		
		$new_thread 			= new ForumThr;
		$new_thread->topic 		= $id;
		$new_thread->user_id	= Auth::id();
		$new_thread->title 		= Input::get('title');
		$new_thread->save();

		$new_post 				= new ForumPos;
		$new_post->thread 		= $new_thread->id;
		$new_post->user_id		= Auth::id();
		$new_post->body 		= Input::get('body');
		$new_post->save();

		return Redirect::to('/forum/thread/'.$new_thread->id.'');
	}

	public function ShowThread($id)
	{
		if (!ForumThr::find($id)){
			App::abort(404);
		}

		if (Auth::check()) {
			$seen							= ForumSeen::where('user_id', '=', Auth::id())->where('thread', '=', $id)->first();

			if (count($seen) == 0){
				$seen_insert				= new ForumSeen;
				$seen_insert->thread		= $id;
				$seen_insert->user_id		= Auth::id();
				$seen_insert->save();
			} else {
				$seen_update				= ForumSeen::find($seen->id);
				$seen_update->updated_at	= Carbon::now()->addSecond();
				$seen_update->save(); 
			}
		}

		$posts							= ForumThr::find($id)->thread()->paginate(25);
		$thread	 						= ForumThr::find($id);
		$topics							= ForumTop::all();
		$selectedTopic = array();

		foreach($topics as $topic) {
		    $selectedTopic[$topic->id] = $topic->name;
		}

		$this->layout->title   			= $thread->title;
		$this->layout->content 			= View::make('forum.thread', ['selectedTopic' => $selectedTopic, 'posts' => $posts, 'thread' => $thread, 'topics' => $topics, 'id' => $id]);
	}

	public function ShowNewReply($id)
	{
		if (!ForumThr::find($id)){
			App::abort(404);
		}
		$thread	 						= ForumThr::find($id);
		$this->layout->title   			= "New Reply";
		$this->layout->content 			= View::make('forum.newreply', ['thread' => $thread, 'id' => $id]);
	}

	public function ShowNewReplyWithQuote($id, $post_id)
	{
		if (!ForumThr::find($id) || !ForumPos::find($post_id)){
			App::abort(404);
		}
		$thread	 						= ForumThr::find($id);
		$post 							= ForumPos::find($post_id);
		$quote 							= "[quote=".User::find($post->user_id)->username."]".$post->body."[/quote]";
		$this->layout->title   			= "New Reply";
		$this->layout->content 			= View::make('forum.newreply', ['thread' => $thread, 'quote' => $quote, 'id' => $id]);
	}

	public function DoNewReply($id)
	{
		if (!ForumThr::find($id)){
			App::abort(404);
		} elseif (ForumThr::find($id)->locked == 1) {
			App::abort(404);
		}
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'body'             		=> 'required|regex:/[a-zA-Z0-9@#$%&*+\-_(),{}+\':;?.,<>!\[\]\s\\/]+$/|min:15'
		    );
		$messages = array(
		    'required'                  => 'You must enter a :attribute for your thread!',
		    'min'	         			=> 'Your :attribute must be at least :min characters long'
		);

		$validator 	= Validator::make($data, $rule, $messages);

		$hasposted  = ForumPos::where('user_id', '=', Auth::id())->count();

		if ($validator->fails()){
		        return Redirect::to('/forum/thread/'.$id.'/new')
		                ->withErrors($validator->messages())->withInput(Input::except(array('_token')));
		} elseif ($hasposted != 0) {
			$last_post = ForumPos::where('user_id', '=', Auth::id())->orderBy('created_at', 'DESC')->first();

			if ($last_post->created_at->diffInSeconds() < 15) {
		        return Redirect::to('/forum/thread/'.$id.'/new')
		                ->withErrors('You really need to slow down with your posting ;)');
		    }
		}

			$new_post 				= new ForumPos;
			$new_post->thread 		= $id;
			$new_post->user_id		= Auth::id();
			$new_post->body 		= Input::get('body');
			$new_post->save();

			$thread 				= ForumThr::find($id);
			$thread->updated_at		= Carbon::now();
			$thread->save();

			return Redirect::to('/forum/thread/'.$id.'#last');
	}

	public function ShowMy()
	{
		$threads						= ForumThr::where('user_id', '=', Auth::id())->where('sticky', '=', '0')->orderBy('updated_at', 'DESC')->paginate(5);
		$this->layout->title   			= "My Forums";
		$this->layout->content 			= View::make('forum.my', ['threads' => $threads]);
	}

}