<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Provider;
use App\Models\Order;
use App\Models\Review;
use App\Models\Message;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@badalhajiumerah.com',
            'role' => 'admin',
        ]);

        // Create sample clients
        $clients = User::factory(10)->create([
            'role' => 'client',
        ]);

        // Create service provider users
        $providerUsers = User::factory(8)->create([
            'role' => 'service_provider',
        ]);

        // Create service providers
        $serviceProviders = collect();
        foreach ($providerUsers as $user) {
            $provider = Provider::factory()->create([
                'user_id' => $user->id,
                'is_verified' => true,
            ]);
            $serviceProviders->push($provider);
        }

        // Create orders
        $orders = collect();
        foreach ($clients->take(5) as $client) {
            $randomProvider = $serviceProviders->random();
            $order = Order::factory()->create([
                'client_id' => $client->id,
                'service_provider_id' => $randomProvider->id,
            ]);
            $orders->push($order);
        }

        // Create completed orders with reviews
        foreach ($clients->skip(5)->take(3) as $client) {
            $randomProvider = $serviceProviders->random();
            $order = Order::factory()->completed()->create([
                'client_id' => $client->id,
                'service_provider_id' => $randomProvider->id,
            ]);
            
            // Create review for completed order
            Review::factory()->create([
                'order_id' => $order->id,
                'client_id' => $client->id,
                'service_provider_id' => $randomProvider->id,
            ]);
            
            $orders->push($order);
        }

        // Create messages for some orders
        foreach ($orders->take(4) as $order) {
            // Client message
            Message::factory()->create([
                'order_id' => $order->id,
                'sender_id' => $order->client_id,
            ]);
            
            // Provider response
            Message::factory()->create([
                'order_id' => $order->id,
                'sender_id' => $order->serviceProvider->user_id,
            ]);
        }

        // Update service provider ratings based on reviews
        foreach ($serviceProviders as $provider) {
            $avgRating = $provider->reviews()->avg('rating') ?? 4.5;
            $totalOrders = $provider->orders()->count();
            
            $provider->update([
                'rating' => round($avgRating, 2),
                'total_orders' => $totalOrders,
            ]);
        }
    }
}