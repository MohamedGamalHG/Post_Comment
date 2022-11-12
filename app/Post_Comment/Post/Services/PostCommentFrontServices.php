<?php


namespace Post_Comment\Post\Services;


use Post_Comment\Post\Models\Comment;
use Post_Comment\Post\Models\Post;
use Illuminate\Http\Request;


class PostCommentFrontServices
{
    public function all_post()
    {
        $posts = Post::with('images')->get();
        return view('User.homepage',compact('posts'));
    }
    public function show($id)
    {
        $post = Post::findOrFail($id);
        //$post_comment = Post::with('comments')->where('id',$id)->find();
        $post_comment = Post::with('comments')->find($id);
       // return dd($post_comment);
        return view('User.show',compact('post','post_comment'));
    }
    public function store_comment($request)
    {
        try{
                $comment = new Comment();
                $comment->content = $request->comment;
                $comment->post_id = $request->post_id;
                $comment->save();
                return redirect()->route('user.show',$request->post_id);
        }catch (\Exception $e)
        {
            return redirect()->route('user.index');
        }

    }
}
