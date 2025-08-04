<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Review;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $comments = [
            'Pelayanan sangat memuaskan dan dokumentasi lengkap. Terima kasih!',
            'Penyedia layanan sangat profesional dan dapat dipercaya.',
            'Komunikasi lancar dan hasil sesuai harapan. Recommended!',
            'Proses cepat dan bukti video sangat jelas. Jazakallahu khairan.',
            'Sangat puas dengan layanan yang diberikan. Barakallahu fiik.',
            'Pelayanan ramah dan hasil dokumentasi memuaskan.',
        ];

        return [
            'order_id' => Order::factory(),
            'client_id' => User::factory(),
            'service_provider_id' => Provider::factory(),
            'rating' => $this->faker->numberBetween(3, 5),
            'comment' => $this->faker->randomElement($comments),
        ];
    }
}