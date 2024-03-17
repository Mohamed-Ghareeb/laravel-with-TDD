<?php

namespace Tests\Feature;

use Database\Factories\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    /** @test */
    public function a_user_can_create_project()
    {
        $attributes = (new ProjectFactory)->raw();

        $this->post('projects', $attributes)->assertRedirect('projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $attributes = (new ProjectFactory)->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $attributes = (new ProjectFactory)->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors(['description']);
    }
}
