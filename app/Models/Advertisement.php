<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company_name',
        'image',
        'link',
        'start_date',
        'end_date',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Check if advertisement is currently running
     */
    public function isRunning()
    {
        return $this->is_active &&
               now()->between($this->start_date, $this->end_date);
    }
}