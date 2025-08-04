<?php

namespace Database\Factories;

use App\Models\Provider;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Provider>
     */
    protected $model = Provider::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name() . ' Services',
            'description' => $this->faker->paragraphs(3, true),
            'certifications' => [
                'Sertifikat Manasik Haji dari Kementerian Agama',
                'Pengalaman 10+ tahun dalam layanan Badal',
                'Lisensi Travel Umrah Resmi'
            ],
            'experience' => $this->faker->paragraphs(2, true),
            'social_media_links' => [
                [
                    'platform' => 'WhatsApp',
                    'url' => 'https://wa.me/628123456789'
                ],
                [
                    'platform' => 'Instagram',
                    'url' => 'https://instagram.com/badalservices'
                ]
            ],
            'is_verified' => $this->faker->boolean(80),
            'rating' => $this->faker->randomFloat(2, 3.5, 5.0),
            'total_orders' => $this->faker->numberBetween(5, 150),
        ];
    }

    /**
     * Indicate that the service provider is verified.
     */
    public function verified(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_verified' => true,
        ]);
    }

    /**
     * Indicate that the service provider is unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_verified' => false,
        ]);
    }
}