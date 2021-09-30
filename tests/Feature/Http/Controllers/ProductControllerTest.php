<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductController
 */
class ProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('Product.index'));

        $response->assertOk();
        $response->assertViewIs('Product.index');
        $response->assertViewHas('products');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('Product.create'));

        $response->assertOk();
        $response->assertViewIs('Product.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'store',
            \App\Http\Requests\ProductStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $name = $this->faker->name;
        $description = $this->faker->text;
        $sku = $this->faker->word;
        $stock = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $variable = $this->faker->word;

        $response = $this->post(route('Product.store'), [
            'user_id' => $user->id,
            'name' => $name,
            'description' => $description,
            'sku' => $sku,
            'stock' => $stock,
            'status' => $status,
            'variable' => $variable,
        ]);

        $products = Product::query()
            ->where('user_id', $user->id)
            ->where('name', $name)
            ->where('description', $description)
            ->where('sku', $sku)
            ->where('stock', $stock)
            ->where('status', $status)
            ->where('variable', $variable)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertRedirect(route('Product.index'));
        $response->assertSessionHas('Product.id', $product->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('Product.show', $product));

        $response->assertOk();
        $response->assertViewIs('Product.show');
        $response->assertViewHas('Product');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('Product.edit', $product));

        $response->assertOk();
        $response->assertViewIs('Product.edit');
        $response->assertViewHas('Product');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'update',
            \App\Http\Requests\ProductUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $product = Product::factory()->create();
        $user = User::factory()->create();
        $name = $this->faker->name;
        $description = $this->faker->text;
        $sku = $this->faker->word;
        $stock = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $variable = $this->faker->word;

        $response = $this->put(route('Product.update', $product), [
            'user_id' => $user->id,
            'name' => $name,
            'description' => $description,
            'sku' => $sku,
            'stock' => $stock,
            'status' => $status,
            'variable' => $variable,
        ]);

        $product->refresh();

        $response->assertRedirect(route('Product.index'));
        $response->assertSessionHas('Product.id', $product->id);

        $this->assertEquals($user->id, $product->user_id);
        $this->assertEquals($name, $product->name);
        $this->assertEquals($description, $product->description);
        $this->assertEquals($sku, $product->sku);
        $this->assertEquals($stock, $product->stock);
        $this->assertEquals($status, $product->status);
        $this->assertEquals($variable, $product->variable);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('Product.destroy', $product));

        $response->assertRedirect(route('Product.index'));

        $this->assertDeleted($product);
    }
}
