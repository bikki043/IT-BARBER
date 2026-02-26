<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

class BookingController extends Controller
{
    public function index()
    {
        $barbers = Barber::all();
        $services = Service::all();
        return view('booking', compact('barbers', 'services'));
    }

    public function store(Request $request)
    {
        try {
            // 1. บันทึกข้อมูล
            $appointment = new Appointment();

            // --- เพิ่มบรรทัดนี้ เพื่อเชื่อมโยงกับไอดีสมาชิกที่ล็อกอินอยู่ ---
            if (auth()->guard('customer')->check()) {
                $appointment->customer_id = auth()->guard('customer')->id();
            }
            // --------------------------------------------------

            $appointment->customer_name    = $request->customer_name;
            $appointment->customer_phone   = $request->customer_phone;
            $appointment->barber_id        = $request->barber_id ?? 1;
            $appointment->service_id       = $request->service_id;
            $appointment->branch           = $request->branch;
            $appointment->appointment_date = $request->appointment_date;
            $appointment->appointment_time = $request->appointment_time;
            $appointment->status           = 'pending';
            $appointment->save();

            // 2. เก็บ ID ไว้ใน Session (กันพลาด)
            session()->put('last_booking_id', $appointment->id);
            session()->save();

            // 3. ดีดไปหน้า Success
            return redirect()->to('/booking/success');
        } catch (\Exception $e) {
            Log::error('Booking Error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }

    public function success()
    {
        $appointment = session('appointment');

        if (!$appointment) {
            $bookingId = session('last_booking_id');
            if ($bookingId) {
                // ✅ แก้ไขตรงนี้: เพิ่ม 'customer' ในรายการที่ find
                $appointment = Appointment::with(['service', 'barber', 'customer'])->find($bookingId);
            }
        }

        if (!$appointment) {
            return redirect('/booking')->with('error', 'เซสชันหมดอายุ กรุณาตรวจสอบข้อมูลการจอง');
        }

        return view('booking_success', compact('appointment'));
    }

    public function history()
    {
        $user = auth()->guard('customer')->user();

        // ✅ แก้ไขตรงนี้: เพิ่ม 'customer' เข้าไปใน with
        $appointments = \App\Models\Appointment::with(['service', 'customer'])
            ->where('customer_id', $user->id)
            ->orderBy('appointment_date', 'desc')
            ->get();

        $orders = Order::with(['items.product'])
            ->where('customer_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('auth.customer.booking_history', compact('appointments', 'orders'));
    }
}
