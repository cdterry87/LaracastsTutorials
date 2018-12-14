<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_users_can_not_participate_in_threads()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');
        $this->withoutExceptionHandling();

        $this->post('/threads/some-channel/1/replies', [])
            ->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_participate_in_threads()
    {
        // Create a user and log them in.
        $this->be($user = factory('App\User')->create());

        // Create a thread.
        $thread = create('App\Thread');

        // Create a reply and tie it to the thread.
        $reply = make('App\Reply');
        $this->post($thread->path() . '/replies', $reply->toArray());

        //Check to see if the reply shows up on the thread.
        $this->get($thread->path())->assertSee($reply->body);
    }

    /** @test */
    function a_reply_requires_a_body()
    {
        $this->signIn();

        // Create a thread.
        $thread = create('App\Thread');

        // Create a reply and tie it to the thread.
        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }
}
