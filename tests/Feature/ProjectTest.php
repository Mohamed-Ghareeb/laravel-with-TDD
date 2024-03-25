<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guests_cannot_create_a_project()
    {
        $attributes = Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view_a_projects()
    {
        $this->get('/projects')->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view_single_a_project()
    {
        $project = Project::factory()->create();

        $this->get($project->path())->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }

    /** @test */
    public function a_user_can_create_project()
    {
        $this->actingAs(User::factory()->create());


        $attributes = [
            'title' => fake()->title(),
            'description' => fake()->paragraph(),
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_user_can_view_thier_project()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->create([
            'owner_id' => auth()->id()
        ]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors(['description']);
    }
}
