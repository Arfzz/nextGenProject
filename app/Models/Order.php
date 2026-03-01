<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'name',
        'email',
        'phone',
        'package',
        'amount',
        'snap_token',
        'status',
        'midtrans_response',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'midtrans_response' => 'array',
            'paid_at' => 'datetime',
            'amount' => 'integer',
        ];
    }

    public function getPackageLabelAttribute(): string
    {
        return match ($this->package) {
            'scholar-vault' => 'Scholar Vault',
            'private-copilot' => 'Private Co-Pilot',
            default => $this->package,
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'paid' => 'active',
            'pending' => 'pending',
            default => 'inactive',
        };
    }
}
