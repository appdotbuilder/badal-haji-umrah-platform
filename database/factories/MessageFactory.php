<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $messages = [
            'Assalamu\'alaikum, apakah bisa diproses hari ini?',
            'Wa\'alaikumsalam, insyaAllah bisa. Saya akan segera berangkat.',
            'Terima kasih. Mohon dokumentasi yang lengkap ya.',
            'Baik, akan saya kirimkan video dan foto dari lokasi.',
            'Alhamdulillah sudah selesai. Video sudah saya upload.',
            'Jazakallahu khairan. Pelayanan sangat memuaskan.',
            'Apakah ada kendala dalam prosesnya?',
            'Tidak ada kendala. Semuanya berjalan lancar.',
        ];

        return [
            'order_id' => Order::factory(),
            'sender_id' => User::factory(),
            'message' => $this->faker->randomElement($messages),
            'is_read' => $this->faker->boolean(70),
        ];
    }

    /**
     * Indicate that the message is unread.
     */
    public function unread(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_read' => false,
        ]);
    }

    /**
     * Indicate that the message is read.
     */
    public function read(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_read' => true,
        ]);
    }
}