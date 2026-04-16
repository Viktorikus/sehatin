<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiseaseReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'health_center_id',
        'disease_name',
        'symptom_start_date',
        'symptoms',
        'severity',
        'location_description',
        'latitude',
        'longitude',
        'status',
        'medical_assessment',
    ];

    protected $casts = [
        'symptom_start_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function healthCenter(): BelongsTo
    {
        return $this->belongsTo(HealthCenter::class);
    }
}
