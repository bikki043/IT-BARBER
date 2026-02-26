<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_phone',
        'barber_id',
        'service_id',
        'branch',
        'appointment_date',
        'appointment_time',
        'status'
    ];

    // แนะนำให้เพิ่มตรงนี้ครับ เพื่อให้เรียกใช้ค่าจาก DB มาโชว์ได้ง่ายขึ้น
    protected $casts = [
        'appointment_date' => 'date',
    ];


    public function customer()
    {
        // ต้องอยู่ในนี้ เพื่อให้ $b->customer ทำงานได้
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }

    /**
     * ความสัมพันธ์กับบริการ
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * ความสัมพันธ์กับช่าง
     */
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}