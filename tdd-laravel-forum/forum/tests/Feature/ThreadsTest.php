<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $response = $this->get('/threads');
        $response->assertStatus(200);
        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_view_a_single_thread()
    {
        $response = $this->get('/threads/' . $this->thread->id);
        $response->assertStatus(200);
        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_associated_to_a_thread()
    {
        // We have a thread and the thread includes replies
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        // When we visit a thread page we should see replies
        $this->get('/threads/' . $this->thread->id)->assertSee($reply->body);
    }

}
