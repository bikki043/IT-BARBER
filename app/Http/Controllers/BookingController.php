<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function index()
    {
        $barbers = Barber::where('status', 'active')->get();
        $services = Service::all();
        return view('booking', compact('barbers', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:20',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'service_id'       => 'required',
            'branch'           => 'required',
            'barber_id'        => 'required',
        ]);

        try {
            $appointment = Appointment::create([
                'customer_name'    => $request->customer_name,
                'customer_phone'   => $request->customer_phone,
                'barber_id'        => $request->barber_id,
                'service_id'       => $request->service_id,
                'branch'           => $request->branch,
                'appointment_date' => $request->appointment_date, 
                'appointment_time' => $request->appointment_time, 
                'status'           => 'pending'
            ]);

            // --- แก้ไขจุดนี้: ส่งข้อมูล $appointment ไปกับ Session ด้วย ---
            return redirect()->route('booking.success')->with('appointment', $appointment);

        } catch (\Exception $e) {
            return dd('บันทึกไม่สำเร็จ: ' . $e->getMessage());
        }
    }

    public function success()
    {
        // เช็คว่าถ้าไม่มีข้อมูลใน Session (เช่น คนพิมพ์ URL เข้ามาเอง) ให้ดีดกลับไปหน้าแรก
        if (!session('appointment')) {
            return redirect()->route('home');
        }

        return view('success');
    }
}