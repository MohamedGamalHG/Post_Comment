<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Post_Comment\Post\Services\PostCommentFrontServices;

class UserController extends Controller
{
    protected PostCommentFrontServices $post_comment;
    public function __construct(PostCommentFrontServices $p_c)
    {
            $this->post_comment = $p_c;
        $this->middleware('checktypeuser')->only(['store']);
    }

    public function index()
    {
        return $this->post_comment->all_post();
    }

    public function show($id)
    {
        return $this->post_comment->show($id);
    }
    public function store(Request $request)
    {

        return $this->post_comment->store_comment($request);
    }
}
