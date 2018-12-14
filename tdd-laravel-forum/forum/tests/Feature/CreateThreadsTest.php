<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    function guests_may_not_create_threads()
    {
        // Expect the auth exception if a user is not logged in.
        $this->expectException('\Illuminate\Auth\AuthenticationException');
        $this->withoutExceptionHandling();

        // Do not allow guests to get to create page.
        $this->get('/threads/create')->assertRedirect('/login');

        // Do not allow guests to create threads
        $this->post('/threads')->assertRedirect('/login');
    }

    /** @test */
    function an_authenticated_user_can_create_new_forum_threads()
    {
        // If we have an authenticated user,
        // $this->actingAs(create('App\User'));
        $this->signIn();

        // And we hit the endpoint to create a new thread,
        $thread = create('App\Thread');
        $this->post('/threads', $thread->toArray());

        // When we visit the thread page we should see the new thread.
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
