<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'payments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_RADIO = [
        'pending'  => 'Pending',
        'approved' => 'Approved',
        'unpaid'   => 'unpaid',
    ];

    protected $fillable = [
        'amount',
        'seat_id',
        'status',
        'description',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function seat()
    {
        return $this->belongsTo(Room::class, 'seat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
