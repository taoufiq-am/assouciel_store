<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\CategorieController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategorieControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /** @test  */
    public function index_method_return_index_view()
    {
        Categorie::factory(10)->create();
        $response = $this->get(route("categories.index"));

        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
        $response->assertViewHas("categories");
    }
    /** @test  */
    //  or start the method name with test
    public function create_method_return_create_view()
    {
        $response = $this->get(route("categories.create"));

        $response->assertStatus(200);
        $response->assertViewIs('categories.create');
    }
    public function test_store_method_add_categorie_to_DB(): void
    {

        $request = new Request([
            'designation' => fake()->sentence(),
            'description' => 'cell phone'
        ]);
        $controller = new CategorieController();


        $response = $controller->store($request);

        $this->assertEquals(302, $response->status());
    }
    /** @test  */
    public function show_method_return_show_view()
    {
        $id = Categorie::latest()->first()->id;
        $cat = Categorie::find($id);

        $response = $this->get(route("categories.show", ['category' => $id]));

        $response->assertStatus(200);
        $response->assertViewIs('categories.show');
        $response->assertViewHas("cat");
    }
    /** @test  */
    public function edit_method_return_edit_view()
    {
        $id = Categorie::latest("id")->first();
        $cat = Categorie::find($id);

        $response = $this->get(route("categories.edit", ['category' => $id]));

        $response->assertStatus(200);
        $response->assertViewIs('categories.edit');
        $response->assertViewHas("cat");
    }
}
