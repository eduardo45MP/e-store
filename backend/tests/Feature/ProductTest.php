<?php
// tests/Feature/ProductTest.php

namespace Tests\Feature;

use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateProductWithValidData()
    {
        $response = $this->post('/products', [
            'name' => 'Produto Teste',
            'price' => 100.50,
            'description' => 'Descrição do Produto Teste',
            'stock' => 10,
        ]);

        $response->assertStatus(302); // redirecionamento após sucesso
        $this->assertDatabaseHas('produtos', ['name' => 'Produto Teste']);
    }

    public function testCreateProductWithInvalidData()
    {
        $response = $this->post('/products', [
            'name' => '',
            'price' => -1, // preço inválido
            'stock' => 'abc', // estoque inválido
        ]);

        $response->assertSessionHasErrors(['name', 'price', 'stock']);
    }

    public function testEditProduct()
    {
        $product = Produto::factory()->create();

        $response = $this->put("/products/{$product->id}", [
            'name' => 'Produto Editado',
            'price' => 150.00,
            'stock' => 5,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('produtos', ['name' => 'Produto Editado']);
    }

    public function testDeleteProduct()
    {
        $product = Produto::factory()->create();

        $response = $this->delete("/products/{$product->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('produtos', ['id' => $product->id]);
    }

    public function testProductValidationFailsForEmptyFields()
    {
        $response = $this->post('/products', [
            'name' => '',
            'price' => null,
            'stock' => null,
        ]);

        $response->assertSessionHasErrors(['name', 'price', 'stock']);
    }

    public function testProductListing()
    {
        Produto::factory()->count(10)->create();

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee('Produto Teste 1');
        $response->assertSee('Produto Teste 10');
    }

    public function testProductPagination()
    {
        Produto::factory()->count(50)->create(); // Cria 50 produtos para paginar

        $response = $this->get('/products?page=2');

        $response->assertStatus(200);
        $response->assertSee('Produto Teste 11');
    }

    public function testProductSearch()
    {
        Produto::factory()->create(['name' => 'Produto Especial']);

        $response = $this->get('/products?search=Especial');

        $response->assertStatus(200);
        $response->assertSee('Produto Especial');
    }
}
