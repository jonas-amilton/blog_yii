<?php

namespace app\services;

use app\models\Post;

class PostService
{
    private $posts;

    public function __construct()
    {
        $this->posts = $this->getAllPosts();
    }

    private function getAllPosts()
    {
        $posts = Post::find()
            ->with(['images', 'user'])
            ->select(['id', 'title', 'content', 'created_at', 'updated_at', 'user_id'])
            ->orderBy('created_at DESC')
            ->all();

        if (!$posts) {
            return [];
        }

        return $posts;
    }

    public function getLastPost()
    {
        if (!$this->posts) {
            return [];
        }

        return $this->posts[0];
    }

    public function getSecondaryPosts()
    {
        return self::removeElement($this->posts, 0);
    }

    private static function removeElement($elements, $position)
    {
        if (!$elements) {
            return [];
        }

        $elements[$position] = null;

        return $elements;
    }
}
