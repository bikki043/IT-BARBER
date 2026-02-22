<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration',
        'image_url', // เพิ่มตัวนี้เพื่อให้บันทึกรูปได้
    ];

    /**
     * เชื่อมโยงไปยังข้อมูลการจอง (Appointments)
     * ช่วยให้ลบข้อมูลที่เกี่ยวข้องกันได้จาก AdminController
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'service_id');
    }
}