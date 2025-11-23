<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $table = 'employees_tbl'; 
    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'phone', 
        'position',
        'salary', 
        'department_id'
    ];

    protected $casts = [
        'salary' => 'decimal:2',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    // Fullname
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}