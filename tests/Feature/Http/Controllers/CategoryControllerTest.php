<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Parent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CategoryController
 */
class CategoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $categories = Category::factory()->count(3)->create();

        $response = $this->get(route('Category.index'));

        $response->assertOk();
        $response->assertViewIs('Category.index');
        $response->assertViewHas('categories');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('Category.create'));

        $response->assertOk();
        $response->assertViewIs('Category.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CategoryController::class,
            'store',
            \App\Http\Requests\CategoryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $parent = Parent::factory()->create();
        $name = $this->faker->name;
        $description = $this->faker->text;

        $response = $this->post(route('Category.store'), [
            'user_id' => $user->id,
            'parent_id' => $parent->id,
            'name' => $name,
            'description' => $description,
        ]);

        $categories = Category::query()
            ->where('user_id', $user->id)
            ->where('parent_id', $parent->id)
            ->where('name', $name)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $categories);
        $category = $categories->first();

        $response->assertRedirect(route('Category.index'));
        $response->assertSessionHas('Category.id', $category->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $category = Category::factory()->create();

        $response = $this->get(route('Category.show', $category));

        $response->assertOk();
        $response->assertViewIs('Category.show');
        $response->assertViewHas('Category');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $category = Category::factory()->create();

        $response = $this->get(route('Category.edit', $category));

        $response->assertOk();
        $response->assertViewIs('Category.edit');
        $response->assertViewHas('Category');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CategoryController::class,
            'update',
            \App\Http\Requests\CategoryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();
        $parent = Parent::factory()->create();
        $name = $this->faker->name;
        $description = $this->faker->text;

        $response = $this->put(route('Category.update', $category), [
            'user_id' => $user->id,
            'parent_id' => $parent->id,
            'name' => $name,
            'description' => $description,
        ]);

        $category->refresh();

        $response->assertRedirect(route('Category.index'));
        $response->assertSessionHas('Category.id', $category->id);

        $this->assertEquals($user->id, $category->user_id);
        $this->assertEquals($parent->id, $category->parent_id);
        $this->assertEquals($name, $category->name);
        $this->assertEquals($description, $category->description);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $category = Category::factory()->create();

        $response = $this->delete(route('Category.destroy', $category));

        $response->assertRedirect(route('Category.index'));

        $this->assertDeleted($category);
    }
}
