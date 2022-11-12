<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Post_Comment\Post\Services\PostServices;
use Illuminate\Http\Request;
use Post_Comment\Post\Request\PostRequest;

class AdminController extends Controller
{
    protected PostServices $post;
    public function __construct(PostServices $postservice)
    {
        $this->post = $postservice;
    }
    public function index()
    {
        return $this->post->index();
    }

    public function show($id)
    {
        return $this->post->show($id);
    }


    public function store(PostRequest $request)
    {
        //return $request->all();

        return $this->post->store($request);
    }


    public function update(PostRequest $request)
    {
        return $this->post->update($request);
    }


    public function destroy(Request $request)
    {
        return  $this->post->delete($request);
    }
}
