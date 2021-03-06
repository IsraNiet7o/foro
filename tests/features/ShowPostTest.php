<?php

class ShowPostTest extends FeatureTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_see_the_post_details()
    {
        // Having
        $user =  $this->defaultUser([
            'first_name' => 'Israel',
            'last_name' => 'Nieto'
        ]);

        $post = factory(\Foro\Post::class)->create([
            'title' => 'Este es el titulo del post',
            'content' => 'Este es el contenido del post',
        ]);
        $user->posts()->save($post);

        // When

        $this->visit($post->url)//post/2324
            ->seeInElement('h1', $post->title)
            ->see($post->content)
            ->see($user->name);

    }
    
    /** @test */
    function test_old_urls_are_redirected()
    {
        // Having
        $user =  $this->defaultUser();

        $post = factory(\Foro\Post::class)->create([
            'title' => 'Old title',
        ]);
        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title'=> "New title"]);

        $this->visit($url)
            ->seePageIs($post->url);
    }


}
