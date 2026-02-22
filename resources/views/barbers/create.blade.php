@extends('admin.admin')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-sm-6">
        <h2 class="text-white font-weight-bold italic">PREMIUM <span class="text-warning">SERVICES</span></h2>
        <p class="text-muted small">จัดการรายการเมนูและราคาสำหรับการจองคิว</p>
    </div>
    <div class="col-sm-6 text-right">
        <button class="btn btn-warning shadow-sm rounded-pill px-4 font-weight-bold">
            <i class="fas fa-plus-circle mr-2"></i> เพิ่มบริการใหม่
        </button>
    </div>
</div>

<div class="row">
    @foreach($services as $service)
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card card-outline card-warning shadow-lg h-100" style="background-color: #161b22; border: 1px solid #30363d;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="service-icon bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="fas fa-cut fa-lg"></i>
                    </div>
                    <span class="badge badge-warning p-2 px-3 rounded-pill shadow-sm">
                        {{ number_format($service->price) }} ฿
                    </span>
                </div>

                <h4 class="text-warning font-weight-bold mb-1">{{ $service->name }}</h4>
                <p class="text-muted small mb-3">
                    <i class="far fa-clock mr-1"></i> ระยะเวลาประมาณ {{ $service->duration }} นาที
                </p>

                <hr style="border-top: 1px solid #30363d;">

                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button class="btn btn-outline-light btn-sm rounded-pill px-3 mr-2">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('ยืนยันการลบเมนูนี้?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="switch{{ $service->id }}" checked>
                        <label class="custom-control-label text-muted small" for="switch{{ $service->id }}">เปิดใช้งาน</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<style>
    /* เพิ่มลูกเล่นเวลาเอาเมาส์วาง (Hover) */
    .card:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
        border-color: #f59e0b !important;
        box-shadow: 0 10px 20px rgba(245, 158, 11, 0.1) !important;
    }
    .service-icon {
        box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3);
    }
</style>
@endsection