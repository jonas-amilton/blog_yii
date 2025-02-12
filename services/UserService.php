<?php

namespace app\services;

use app\models\User;

class UserService
{
    private $user;

    public function __construct($id)
    {
        $this->user = User::findOne(['id' => $id]);;
    }

    public function getUser()
    {
        if (!$this->user) {
            return null;
        }

        return $this->user;
    }

    public function getPostByUser()
    {
        if (!$this->user) {
            return null;
        }

        return $this->user->posts;
    }

    public function getProfile()
    {
        if (!($this->user && $this->user->profiles)) {
            return null;
        }

        return array_reverse($this->user->profiles)[0];
    }

    public function getProfilePhoto()
    {
        if (!($this->user && $this->user->profiles)) {
            return 'avatar-default.png';
        }

        $profile = $this->getProfile();

        return "{$profile->avatars[0]->name}.{$profile->avatars[0]->extension}";
    }
}
