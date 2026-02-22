<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #0f172a; color: #f8fafc; font-family: 'Inter', sans-serif; }
        .card { background-color: #1e293b; border: none; border-radius: 15px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .form-control { background-color: #334155; border: 1px solid #475569; color: white; }
        .form-control:focus { background-color: #334155; color: white; border-color: #fbbf24; box-shadow: none; }
        .table { color: #e2e8f0; vertical-align: middle; }
        .btn-warning { background-color: #fbbf24; border: none; font-weight: 600; }
        .btn-warning:hover { background-color: #f59e0b; }
        .service-img { border-radius: 8px; object-fit: cover; border: 2px solid #334155; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold mb-0">🛠 จัดการบริการ</h2>
                <p class="text-secondary">เพิ่ม หรือ ลบ รายการบริการตัดผมของคุณ</p>
            </div>
            <a href="{{ url('/') }}" class="btn btn-outline-light px-4 shadow-sm">
                <i class="fa-solid fa-house me-2"></i>กลับหน้าหลัก
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
        @endif

        <div class="card mb-5">
            <div class="card-body p-4">
                <h5 class="mb-4 text-warning"><i class="fa-solid fa-plus-circle me-2"></i>เพิ่มบริการใหม่</h5>
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small text-secondary">ชื่อบริการ</label>
                            <input type="text" name="name" class="form-control" placeholder="เช่น ตัดผมชาย" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small text-secondary">ราคา (บาท)</label>
                            <input type="number" name="price" class="form-control" placeholder="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small text-secondary">URL รูปภาพ</label>
                            <input type="text" name="image_url" class="form-control" placeholder="https://...">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-warning w-100">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0">
                        <thead class="table-light text-dark">
                            <tr>
                                <th class="ps-4">รูปภาพ</th>
                                <th>ชื่อบริการ</th>
                                <th>ราคา</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $service)
                            <tr>
                                <td class="ps-4">
                                    <img src="{{ $service->image_url ?? 'https://via.placeholder.com/50' }}" width="50" height="50" class="service-img">
                                </td>
                                <td class="fw-bold">{{ $service->name }}</td>
                                <td><span class="text-warning">{{ number_format($service->price) }} ฿</span></td>
                                <td class="text-center">
                                    <form action="{{ route('admin.services.delete', $service->id) }}" method="POST" onsubmit="return confirm('ยืนยันการลบ?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm">
                                            <i class="fa-solid fa-trash-can me-1"></i> ลบ
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-secondary">ยังไม่มีข้อมูลบริการในระบบ</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>