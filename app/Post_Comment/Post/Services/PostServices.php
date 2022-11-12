<?php


namespace Post_Comment\Post\Services;


use Carbon\Carbon;
use Post_Comment\Post\Models\Image;
use Post_Comment\Post\Models\Post;
use Post_Comment\Post\Repository\PostRepository;

class PostServices
{

    const Path = 'images/';
    /*private PostRepository $post;
    public function __construct(PostRepository $postrepository)
    {
        $this->post = $postrepository;
    }*/

    public function index()
    {
        $posts = Post::get();
        return view('Admin.index',compact('posts'));
    }

    public function show($id)
    {
        $post = Post::with('images')->find($id);
    /*    $post = Post::with(['images' => function($q){
            $q->select('id','name');
        }])->select('title')->where('id',$id)->get();*/
        /*$post = Post::with(['images' => function($q){
            $q->select('id','name');
        }])->select('title')->find($id);*/
        return view('admin.show',compact('post'));
    }

    public function store($request)
    {
        try {
            $post = new Post();
            $post->title = $request->title;

            $post->date = Carbon::today();
            $post->user_id = auth()->user()->id;

            $post->save();
            //return dd($request);
            $this->saveImage($request->images,$post->id);

            return redirect()->route('admin.index');
        }catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }
    }
    public function update($request)
    {
        $post = Post::findOrFail($request->id);
        if(!$post)
            return redirect()->route('admin.index');

        try {
            $post->title = $request->title;
            $post->date = Carbon::today();
            $post->user_id = auth()->user()->id;
             $post->save();
            if(!empty($request->images)) {
                $image = Image::where('post_id', $request->id)->get();
                $this->deleteImageFromSource($image,$request->id);
                $this->deleteImage($request->id);
            }
            $this->saveImage($request->images,$post->id);
            return redirect()->route('admin.index');
        }catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }
    }
    public function delete($request)
    {
        $post = Post::with('comments')->find($request->id);
        $image = Image::where('post_id',$request->id)->get();

        if(!$post)
            return redirect()->route('admin.index');
        $this->deleteImageFromSource($image,$post->id);
        $post->delete();
        return redirect()->route('admin.index');
    }

    private function saveImage($images,$post_id)
    {
        if(!empty($images)) {
            foreach ($images as $image) {
                $image->storeAs('images/' . $post_id, $image->getClientOriginalName(), 'public');
                $image->move(public_path('images/' . $post_id), $image->getClientOriginalName());

                $img = new Image();
                $img->name = $image->getClientOriginalName();
                $img->post_id = $post_id;
                $img->save();
            }
        }
    }

    private function deleteImageFromSource($images,$post_id)
    {
            foreach ($images as $item) {
                if (file_exists(self::Path . $post_id . '/' . $item->name))
                    unlink(self::Path . $post_id . '/' . $item->name);
            }
            return true;
    }
    private function deleteImage($id)
    {
        return Image::where('post_id',$id)->delete();
    }
}
