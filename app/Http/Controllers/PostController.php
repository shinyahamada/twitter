<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{



  // 全部API


    public function like($id) {
      $post = Post::where('id',$id)->with('likes')->first();

      if (! $post) {
        return ['result'=>1009];
      }

      $post->likes()->detach(Auth::user()->id);
      $post->likes()->attach(Auth::user()->id);

      return $post;
    }

    public function unlike($id) {
      $post = Post::where('id',$id)->with('likes')->first();

      if (!$post) {
        return ['result'=>1009];
      }

      $post->likes()->detach(Auth::user()->id);

      return $post;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

      $posts = Post::with(['likes','user'])->where([
        ['is_deleted', false],
        ['posts.user_id', $id]
        ])->latest()
          ->get();

      if (count($posts) == 0) {
        $user = Auth::User();
        return ['data'=>$user];
      }

      return ['result'=>1000, 'data'=>$posts];

    }

    public function timeline() {
      $posts = Post::with(['likes','user'])->where([
        ['is_deleted', false]
      ])->latest()
        ->get();

      return ['data'=>$posts];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::User();
        $post = new Post();
        $post['is_deleted'] = 0;
        $post['user_id'] = $user->id;
        $post['content'] = $request->content;
        $result = $post->save();

        if ($result) {
          return ['result'=>1000];
        } else {
          return ['result'=>1009];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
      if (!isset($id)) {
        return ['result'=>1003];
      }
      $query = Post::where('id',$id)->where('is_deleted', false);
      $result = $query->update(['is_deleted' => true]);
      if ($result) {
        return ['result'=>1000];
      } else {
        return ['result'=>1009, 'debug'=>$id];
      }

    }

    public function addComment(Post $post, Request $request) {
      $comment = new Comment();
      $comment->content = $request->content;
      $comment->user_id = Auth::user()->id;
      $post->comments()->save($comment);

      $new_comment = Comment::where('id',$comment->id)->with('auther')->first();

      return response($new_comment, 201);

    }
}
