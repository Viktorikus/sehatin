<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HealthCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'city',
        'district',
        'latitude',
        'longitude',
        'description',
        'operating_hours',
        'is_active',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(HealthService::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function workers(): HasMany
    {
        return $this->hasMany(HealthWorker::class);
    }

    public function diseaseReports(): HasMany
    {
        return $this->hasMany(DiseaseReport::class);
    }
}
