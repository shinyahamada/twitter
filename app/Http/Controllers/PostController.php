<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{



  // 全部API


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::where('is_deleted', false)->get();

      return ['result'=>1000, 'data'=>$posts];

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
      $post = $query->first();
      $result = $query->update(['is_deleted' => true],
                               ['content' => $post['content']]);
      if ($result) {
        return ['result'=>1000];
      } else {
        return ['result'=>1009];
      }

    }
}
