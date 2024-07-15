<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'mission_id',
        'campaign_id',
        'amount',
        'is_recurring'
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    /**
     * @return BelongsTo
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
