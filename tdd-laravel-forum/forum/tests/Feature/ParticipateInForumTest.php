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

        $this->post('/threads/1/replies', []);
    }

    /** @test */
    public function authenticated_users_can_participate_in_threads()
    {
        // Create a user and log them in.
        $this->be($user = factory('App\User')->create());

        // Create a thread.
        $thread = factory('App\Thread')->create();

        // Create a reply and tie it to the thread.
        $reply = factory('App\Reply')->make();
        $this->post('/threads/' . $thread->id . '/replies', $reply->toArray());

        //Check to see if the reply shows up on the thread.
        $this->get('/threads/' . $thread->id)->assertSee($reply->body);
    }
}
