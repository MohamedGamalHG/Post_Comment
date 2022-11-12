<?php


namespace Post_Comment\Post\Repository;


use Post_Comment\Base\Repositories\Repository;
use Post_Comment\Post\Models\Post;

class PostRepository extends Repository
{
    public function __construct(Post $post)
    {
        $this->setModel($post);
    }
}
