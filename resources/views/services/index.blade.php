@extends('admin.admin')
@section('title', 'Services Menu')

@section('content')
<div class="row mb-4">
    <div class="col-sm-6">
        <p class="text-muted italic">กำหนดรายการบริการและราคาของร้าน ITBARBER</p>
    </div>
    <div class="col-sm-6 text-right">
        <button class="btn btn-dark shadow-sm rounded-pill px-4 hover-scale" onclick="addServiceModal()">
            <i class="fas fa-plus-circle mr-2 text-warning"></i> เพิ่มเมนูบริการ
        </button>
    </div>
</div>

<div class="row">
    @foreach ($services as $service)
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card shadow-sm border-0 mb-4 transition-all" style="border-radius: 20px; overflow: hidden;">
            <div class="card-body p-4 text-center">
                <div class="mb-3">
                    <div class="bg-light d-inline-block p-3 rounded-circle shadow-inner">
                        <i class="fas fa-cut fa-2x text-warning"></i>
                    </div>
                </div>
                <h5 class="font-weight-bold text-dark mb-1">{{ $service->name }}</h5>
                <div class="badge badge-warning px-3 py-2 rounded-pill mb-3">
                    <span class="h6 font-weight-bold mb-0">{{ number_format($service->price) }} ฿</span>
                </div>
                
                <div class="text-muted small mb-4">
                    <i class="far fa-clock mr-1"></i> ใช้เวลา {{ $service->duration }} นาที
                </div>

                <div class="d-flex justify-content-center gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 mr-2" 
                            onclick="viewDetail('{{ $service->name }}', '{{ $service->price }}', '{{ $service->duration }}')">
                        รายละเอียด
                    </button>
                    <form id="del-{{ $service->id }}" action="{{ route('services.destroy', $service->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="button" onclick="confirmDelete({{ $service->id }})" class="btn btn-outline-danger btn-sm rounded-pill px-3">ลบ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<style>
    .hover-scale { transition: transform 0.2s; }
    .hover-scale:hover { transform: scale(1.05); }
    .shadow-inner { box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06); }
</style>

<script>
    // Pop-up แสดงรายละเอียด
    function viewDetail(name, price, duration) {
        Swal.fire({
            title: '<h3 class="font-weight-bold uppercase italic">' + name + '</h3>',
            html: `
                <div class="text-left p-3">
                    <div class="d-flex justify-content-between mb-2 border-bottom pb-2">
                        <span class="text-muted"><i class="fas fa-money-bill-wave mr-2"></i> ราคาบริการ:</span>
                        <span class="font-weight-bold text-warning">${price} ฿</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 border-bottom pb-2">
                        <span class="text-muted"><i class="fas fa-history mr-2"></i> ระยะเวลา:</span>
                        <span class="font-weight-bold text-dark">${duration} นาที</span>
                    </div>
                    <p class="mt-3 text-muted small text-center italic">* ราคานี้รวมภาษีมูลค่าเพิ่มแล้ว</p>
                </div>
            `,
            icon: 'info',
            confirmButtonText: 'รับทราบ',
            confirmButtonColor: '#0f172a',
            customClass: {
                popup: 'rounded-[2rem]'
            }
        });
    }

    // Pop-up ยืนยันการลบ
    function confirmDelete(id) {
        Swal.fire({
            title: 'ลบรายการนี้ใช่ไหม?',
            text: "ข้อมูลบริการจะไม่สามารถกู้คืนได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'ลบออกเลย',
            cancelButtonText: 'ยกเลิก',
            customClass: { popup: 'rounded-[2rem]' }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('del-' + id).submit();
            }
        })
    }
</script>
@endsection