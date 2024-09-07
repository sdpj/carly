<?php
/**
 * MIT License
 *
 * Copyright (c) 2022 FoxxoSnoot
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace App\Http\Controllers\Web;

use App\Models\Item;
use App\Models\Inventory;
use App\Models\ForumThread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('web.home.index');
    }

    public function dashboard()
    {
        $updates = ForumThread::where([
            ['topic_id', '=', config('site.updates_forum_topic_id')],
            ['is_deleted', '=', false]
        ])->orderBy('created_at', 'DESC')->get()->take(4);

        $items = Item::where([
            ['status', '=', 'approved'],
            ['public_view', '=', true]
        ])->whereIn('type', config('site.catalog_recent_item_types'))->orderBy('updated_at', 'DESC')->get()->take(6);

        return view('web.home.dashboard')->with([
            'updates' => $updates,
            'items' => $items
        ]);
    }

    public function admin()
    {
        $item = config('site.fake_admin_item_id');

        if (!$item) abort(404);

        $item = Item::where('id', '=', $item)->firstOrFail();

        if (!Auth::user()->ownsItem($item->id)) {
            $inventory = new Inventory;
            $inventory->user_id = Auth::user()->id;
            $inventory->item_id = $item->id;
            $inventory->save();
        }

        return redirect()->route('catalog.item', [$item->id, $item->slug()]);
    }
}
