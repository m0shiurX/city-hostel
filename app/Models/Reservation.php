<?php

namespace App\Models;

// use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    // use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use SoftDeletes, HasFactory;

    public $table = 'reservations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_RADIO = [
        'pending'   => 'Pending',
        'approved'    => 'Approved',
        'cancelled' => 'Cancelled',
        'unpaid'   => 'Unpaid',
    ];

    protected $fillable = [
        'room_id',
        'payable_amount',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function payment()
    {
        return $this->hasOne(
            Payment::class,
            'reservation_id',
            'id'
        );
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
