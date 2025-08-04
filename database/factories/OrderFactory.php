<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $serviceTypes = ['badal_haji', 'badal_umrah'];
        $proofTypes = ['video_recording', 'live_video', 'location_map', 'photo'];
        $statuses = ['pending', 'accepted', 'in_progress', 'completed', 'cancelled'];
        
        $proposedPrice = $this->faker->randomFloat(2, 5000000, 25000000); // 5-25 million IDR
        $status = $this->faker->randomElement($statuses);
        
        return [
            'client_id' => User::factory(),
            'service_provider_id' => Provider::factory(),
            'service_type' => $this->faker->randomElement($serviceTypes),
            'description' => $this->faker->paragraphs(2, true),
            'proposed_price' => $proposedPrice,
            'agreed_price' => $status !== 'pending' ? $this->faker->randomFloat(2, $proposedPrice * 0.8, $proposedPrice * 1.2) : null,
            'proof_type' => $this->faker->randomElement($proofTypes),
            'status' => $status,
            'proof_data' => $status === 'completed' ? [
                'video_url' => 'https://example.com/proof-video.mp4',
                'location' => 'Masjidil Haram, Mecca',
                'timestamp' => now()->toISOString(),
            ] : null,
            'completed_at' => $status === 'completed' ? $this->faker->dateTimeBetween('-1 month', 'now') : null,
        ];
    }

    /**
     * Indicate that the order is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'completed_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'agreed_price' => $this->faker->randomFloat(2, $attributes['proposed_price'] * 0.8, $attributes['proposed_price'] * 1.2),
            'proof_data' => [
                'video_url' => 'https://example.com/proof-video.mp4',
                'location' => 'Masjidil Haram, Mecca',
                'timestamp' => now()->toISOString(),
            ],
        ]);
    }

    /**
     * Indicate that the order is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'agreed_price' => null,
            'proof_data' => null,
            'completed_at' => null,
        ]);
    }
}