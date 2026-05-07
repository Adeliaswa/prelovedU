<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class CartTest extends TestCase
{
    use RefreshDatabase; 

    public function test_authenticated_user_can_add_product_to_cart(): void
    {
        $user = User::factory()->create();
        
        $product = Product::create([
            'name' => 'Preloved Jacket',
            'description' => 'A nice jacket',
            'price' => 150000,
            'stock' => 5,
            'image' => 'jacket.jpg'
        ]);

        // FIX: The route is /api/cart/add/{productId}
        $response = $this->actingAs($user)->postJson('/api/cart/add/' . $product->id, [
            'quantity' => 1
        ]);

        // Assuming your API returns a 200 OK or 201 Created on success
        $response->assertStatus(200); 

        // Check if the data was actually saved in the database
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1
        ]);
    }

    public function test_unauthenticated_user_cannot_add_to_cart(): void
    {
        $product = Product::create([
            'name' => 'Preloved Shoes',
            'price' => 200000,
            'stock' => 2,
        ]);

        // FIX: Update the route here as well
        $response = $this->postJson('/api/cart/add/' . $product->id, [
            'quantity' => 1
        ]);

        // It should reject the user with a 401 Unauthorized
        $response->assertStatus(401);
    }
}