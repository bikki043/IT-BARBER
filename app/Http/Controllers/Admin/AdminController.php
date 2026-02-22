<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * หน้า Dashboard: ดูรายการจองทั้งหมด
     */
    // app/Http/Controllers/Admin/AdminController.php

    // app/Http/Controllers/Admin/AdminController.php

    // app/Http/Controllers/Admin/AdminController.php

    public function index()
    {
        $bookings = Appointment::with('service')->latest()->get();

        // ดึงข้อมูล services มาด้วยเพื่อแก้ปัญหา Undefined variable
        $services = Service::latest()->get();

        // ส่งทั้ง bookings และ services ไปที่หน้าจอ
        return view('admin.services', compact('bookings', 'services'));
    }

    /**
     * หน้าจัดการบริการ: แสดงรายการบริการที่มีทั้งหมด
     */
    public function manageServices()
    {
        $services = Service::latest()->get();
        return view('admin.services', compact('services'));
    }

    /**
     * บันทึกบริการใหม่
     */
    public function storeService(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|numeric|min:1',
            'image_url' => 'nullable|url'
        ], [
            'name.required' => 'กรุณากรอกชื่อบริการ',
            'price.numeric' => 'ราคาต้องเป็นตัวเลขเท่านั้น',
            'image_url.url' => 'ลิงก์รูปภาพไม่ถูกต้อง'
        ]);

        Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration ?? 30,
            'image_url' => $request->image_url ?? 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?q=80&w=500',
        ]);

        return back()->with('success', 'เพิ่มบริการเรียบร้อยแล้ว!');
    }

    /**
     * ลบบริการออกจากระบบ
     */
    public function deleteService($id)
    {
        DB::beginTransaction();

        try {
            $service = Service::findOrFail($id);

            // ลบการจองที่เชื่อมกับบริการนี้ทิ้งก่อน (ป้องกัน Foreign Key Error)
            if (method_exists($service, 'appointments')) {
                $service->appointments()->delete();
            }

            $service->delete();

            DB::commit();
            return back()->with('success', 'ลบบริการเรียบร้อยแล้ว');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }

    /**
     * อัปเดตสถานะการจอง
     */
    public function updateBookingStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $booking = Appointment::findOrFail($id);
        $booking->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'อัปเดตสถานะสำเร็จ');
    }
}
