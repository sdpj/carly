<?php

class StoreController extends BaseController {

	protected $layout = 'layouts.master';

	public function ShowStore()
	{
		$items 							= Item::orderBy('id', 'DESC')->paginate(12);

		$this->layout->title   			= "Store";
		$this->layout->content 			= View::make('store.home', ['items' => $items]);
	}

	public function ShowStoreCategory($category)
	{
		$categories 					= array('clothing', 'headgear', 'accessories', 'addons');

		if (!in_array(Request::segment(2), $categories))
		{
			App::abort(404);
		}

		$items 							= Item::where('category', '=', $category)->paginate(12);

		$this->layout->title   			= "Store";
		$this->layout->content 			= View::make('store.home', ['items' => $items]);
	}

	public function ShowItem($id)
	{
		$item 							= Item::findOrFail($id);

		$this->layout->title 			= $item->name;
		$this->layout->content 			= View::make('store.item', ['item' => $item]);
	}

	public function PurchaseItem($id)
	{
		//if (URL::previous() != 'http://'.Request::server("HTTP_HOST").'/'.Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3)){
		//	App::abort(404);
		//}
		
		$item 							= Item::findOrFail($id);
		$user							= Auth::user();
		$user->currency_1				= $user->currency_1 - $item->cost;

		if ($item->cost > $user->currency_1)
		{
		//	App::abort(404);
		}

		$user->save();

		$inventory 						= new Inventory;
		$inventory->user_id				= $user->id;
		$inventory->item_id 			= $item->id;
		$inventory->save();

		Logging::LogEventWithData('item_purchase', $user->id, $_SERVER['REMOTE_ADDR'], $user->currency_1, $item->id);

		return Redirect::to('/store/item/'.$id)->with('success', 1);
	}

	public function ShowUpload()
	{		
		$ue = SiteConfig::find(1)->userstore;
		
		if (!Auth::user()->can('CanUpload') && $ue == "false"){
			App::abort(404);
		}
		

		$this->layout->title 			= "Upload Item";
		$this->layout->content 			= View::make('store.upload');
	}

	public function DoUpload() {

		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'image'          		=> 'required|image',
		        'name'             		=> 'required|min:1',
		        'description'          	=> 'required|min:1',
		        'cost'  				=> 'required|integer|min:1',
		        'category'			    => 'required|in:clothing,headgear,accessories,addons'
		    );
		$messages = array(
		    'image.image'    			=> 'You must upload an image!',
		    'min'	         			=> 'The :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/store/upload')
		                ->withErrors($validator->messages());
		} elseif (Image::make(Input::file('image'))->width() != 170 || Image::make(Input::file('image'))->height() != 300) {
			return Redirect::to('/store/upload')->with('dimension_error', 1);
		} elseif (Image::make(Input::file('image'))->mime() != 'image/png') {
			return Redirect::to('/store/upload')->with('mime_error', 1);
		} else {
				$file 					= Input::file('image');

			    $destinationPath    	= 'user_img/avatar/';
			    $extension          	= $file->getClientOriginalExtension();
			    $rand					= str_random();
			    $filename           	= 'usr_'.  Auth::user()->id . '_str=' . $rand . '_file='. md5($file->getClientOriginalName()) .'.'. $extension;
			    $upload_success     	= $file->move($destinationPath, $filename);

				$new_item 				= new Item;
				$new_item->user_id		= Auth::user()->id;
				$new_item->name 		= Input::get('name');
				$new_item->description	= Input::get('description');
				$new_item->cost 		= Input::get('cost');
				$new_item->category 	= Input::get('category');
				$new_item->filename 	= $filename;
				$new_item->save();

				return Redirect::to('/store/item/'.$new_item->id);
		}
	}

}

?>