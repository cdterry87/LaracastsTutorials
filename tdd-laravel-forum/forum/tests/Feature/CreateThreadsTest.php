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
        $this->expectException('\Illuminate\Auth\AuthenticationException');
        $this->withoutExceptionHandling();

        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());
    }

    /** @test */
    function guests_cannot_see_the_create_thread_page()
    {
        $this->get('/threads/create')
            ->assertRedirect('/login');
    }

    /** @test */
    function an_authenticated_user_can_create_new_forum_threads()
    {
        // If we have an authenticated user,
        // $this->actingAs(create('App\User'));
        $this->signIn();

        // And we hit the endpoint to create a new thread,
        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());

        // When we visit the thread page we should see the new thread.
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
