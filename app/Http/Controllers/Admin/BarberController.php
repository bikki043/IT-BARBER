<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarberController extends Controller
{
    // แสดงรายชื่อช่างทั้งหมด
    public function index()
    {
        $barbers = Barber::latest()->get();
        return view('barbers.index', compact('barbers'));
    }

    // หน้าฟอร์มเพิ่มช่าง
    public function create()
    {
        return view('   barbers.create');
    }

    // บันทึกข้อมูลช่างใหม่
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // จำกัดขนาด 2MB
        ]);

        $data = $request->all();

        // จัดการอัปโหลดรูปภาพ
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('barbers', 'public');
        }

        Barber::create($data);

        return redirect()->route('barbers.index')->with('success', 'เพิ่มช่างใหม่เข้าระบบ ITBARBER เรียบร้อย!');
    }

    // ฟังก์ชันลบข้อมูล
    public function destroy(Barber $barber)
    {
        if ($barber->image) {
            Storage::disk('public')->delete($barber->image);
        }
        $barber->delete();
        return redirect()->route('barbers.index')->with('success', 'ลบข้อมูลช่างเรียบร้อย');
    }
}