<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Division extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
    ];

    public function staffProfiles(): HasMany
    {
        return $this->hasMany(StaffProfile::class);
    }

    public function divisionReports(): HasMany
    {
        return $this->hasMany(DivisionReport::class);
    }
}