<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'barber_id',
        'service_id',
        'branch',
        'appointment_date', // แก้ให้ตรงกับ DB
        'appointment_time', // แก้ให้ตรงกับ DB
        'status'
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}
