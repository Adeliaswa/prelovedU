<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_product(): void
    {
        // Create a product directly using the Model
        $product = Product::create([
            'name' => 'Vintage Camera',
            'description' => 'Works perfectly',
            'price' => 500000,
            'stock' => 1,
            'image' => 'camera.jpg'
        ]);

        // Assert the object exists and properties match
        $this->assertNotNull($product);
        $this->assertEquals('Vintage Camera', $product->name);
        $this->assertEquals(500000, $product->price);
        
        // Assert it exists in the actual SQLite/MySQL database
        $this->assertDatabaseHas('products', [
            'name' => 'Vintage Camera'
        ]);
    }
}