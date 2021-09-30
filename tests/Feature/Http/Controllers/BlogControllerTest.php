<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BlogController
 */
class BlogControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $blogs = Blog::factory()->count(3)->create();

        $response = $this->get(route('Blog.index'));

        $response->assertOk();
        $response->assertViewIs('Blog.index');
        $response->assertViewHas('blogs');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('Blog.create'));

        $response->assertOk();
        $response->assertViewIs('Blog.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BlogController::class,
            'store',
            \App\Http\Requests\BlogStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $name = $this->faker->name;
        $content = $this->faker->paragraphs(3, true);

        $response = $this->post(route('Blog.store'), [
            'user_id' => $user->id,
            'name' => $name,
            'content' => $content,
        ]);

        $blogs = Blog::query()
            ->where('user_id', $user->id)
            ->where('name', $name)
            ->where('content', $content)
            ->get();
        $this->assertCount(1, $blogs);
        $blog = $blogs->first();

        $response->assertRedirect(route('Blog.index'));
        $response->assertSessionHas('Blog.id', $blog->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $blog = Blog::factory()->create();

        $response = $this->get(route('Blog.show', $blog));

        $response->assertOk();
        $response->assertViewIs('Blog.show');
        $response->assertViewHas('Blog');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $blog = Blog::factory()->create();

        $response = $this->get(route('Blog.edit', $blog));

        $response->assertOk();
        $response->assertViewIs('Blog.edit');
        $response->assertViewHas('Blog');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BlogController::class,
            'update',
            \App\Http\Requests\BlogUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $blog = Blog::factory()->create();
        $user = User::factory()->create();
        $name = $this->faker->name;
        $content = $this->faker->paragraphs(3, true);

        $response = $this->put(route('Blog.update', $blog), [
            'user_id' => $user->id,
            'name' => $name,
            'content' => $content,
        ]);

        $blog->refresh();

        $response->assertRedirect(route('Blog.index'));
        $response->assertSessionHas('Blog.id', $blog->id);

        $this->assertEquals($user->id, $blog->user_id);
        $this->assertEquals($name, $blog->name);
        $this->assertEquals($content, $blog->content);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $blog = Blog::factory()->create();

        $response = $this->delete(route('Blog.destroy', $blog));

        $response->assertRedirect(route('Blog.index'));

        $this->assertDeleted($blog);
    }
}
