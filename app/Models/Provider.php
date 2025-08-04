<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Provider
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property array|null $certifications
 * @property string|null $experience
 * @property array|null $social_media_links
 * @property bool $is_verified
 * @property float $rating
 * @property int $total_orders
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider verified()
 * @method static \Database\Factories\ProviderFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Provider extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'service_providers';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'certifications',
        'experience',
        'social_media_links',
        'is_verified',
        'rating',
        'total_orders',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'certifications' => 'array',
        'social_media_links' => 'array',
        'is_verified' => 'boolean',
        'rating' => 'decimal:2',
        'total_orders' => 'integer',
    ];

    /**
     * Get the user that owns the service provider profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the orders for the service provider.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'service_provider_id');
    }

    /**
     * Get the reviews for the service provider.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'service_provider_id');
    }

    /**
     * Scope a query to only include verified service providers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }
}