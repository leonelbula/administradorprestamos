<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function credit(): HasMany
    {
        return $this->hasMany(Credits::class);
    }

    public function loanPayment(): HasMany
    {
        return $this->hasMany(LoanPayment::class);
    }
    public function assignacion(): HasOne
    {
        return $this->hasOne(AssignPayment::class);
    }
}
