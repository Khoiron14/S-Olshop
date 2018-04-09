<?php

namespace App\Http\Controllers\Users;

use App\Models\Shops\Store;
use App\Models\Users\Comment;
use App\Models\Shops\Items\Item;
use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CommentRequest  $request
     * @param  App\Models\Shops\Store  $store
     * @param  App\Models\Shops\Items\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, Store $store, Item $item)
    {
        $item->comments()->create([
            'user_id' => auth()->user()->id,
            'message' => $request->message
        ]);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CommentRequest  $request
     * @param  App\Models\Shops\Store  $store
     * @param  App\Models\Shops\Items\Item  $item
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Store $store, Item $item, Comment $comment)
    {
        $comment->update($request->only('message'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Http\Requests\CommentRequest  $request
     * @param  App\Models\Shops\Store  $store
     * @param  App\Models\Shops\Items\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentRequest $request, Store $store, Item $item, Comment $comment)
    {
        $comment->destroy();

        return redirect()->back();
    }
}
