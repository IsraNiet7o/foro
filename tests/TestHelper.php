<?php

namespace Tests;

use Foro\Post;
use Foro\User;

trait TestHelper
{
    protected $defaultUser;


    /**
     * @param array $attributes
     * @return mixed
     */
    public function defaultUser($attributes = [])
    {
        if ($this->defaultUser) {
            return $this->defaultUser;
        }
        return $this->defaultUser = factory(User::class)->create($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    protected function createPost(array $attributes = [])
    {
        return factory(Post::class)->create($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    protected function anyone(array $attributes = [])
    {
        return factory(User::class)->create($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    protected function actingAsAnyone(array $attributes = [])
    {
        $user = $this->anyone($attributes);
        $this->actingAs($user);
        return $user;
    }

}