<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Omni;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OmniController
 */
class OmniControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $omnis = Omni::factory()->count(3)->create();

        $response = $this->get(route('omni.index'));

        $response->assertOk();
        $response->assertViewIs('omni.index');
        $response->assertViewHas('omnis');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('omni.create'));

        $response->assertOk();
        $response->assertViewIs('omni.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OmniController::class,
            'store',
            \App\Http\Requests\OmniStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('omni.store'));

        $response->assertRedirect(route('omni.index'));
        $response->assertSessionHas('omni.id', $omni->id);

        $this->assertDatabaseHas(omnis, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $omni = Omni::factory()->create();

        $response = $this->get(route('omni.show', $omni));

        $response->assertOk();
        $response->assertViewIs('omni.show');
        $response->assertViewHas('omni');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $omni = Omni::factory()->create();

        $response = $this->get(route('omni.edit', $omni));

        $response->assertOk();
        $response->assertViewIs('omni.edit');
        $response->assertViewHas('omni');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OmniController::class,
            'update',
            \App\Http\Requests\OmniUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $omni = Omni::factory()->create();

        $response = $this->put(route('omni.update', $omni));

        $omni->refresh();

        $response->assertRedirect(route('omni.index'));
        $response->assertSessionHas('omni.id', $omni->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $omni = Omni::factory()->create();

        $response = $this->delete(route('omni.destroy', $omni));

        $response->assertRedirect(route('omni.index'));

        $this->assertDeleted($omni);
    }
}
