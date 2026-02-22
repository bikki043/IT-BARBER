@extends('admin.admin')
@section('title', 'Team Barbers')

@section('content')
<div class="row mb-4 px-2">
    <div class="col-12 d-flex justify-content-between align-items-end">
        <div>
            <h2 class="font-weight-bold text-dark italic">TECHNICIAN <span class="text-warning">SQUAD</span></h2>
            <p class="text-muted small mb-0">จัดการทีมช่างและตรวจสอบสถานะการทำงาน</p>
        </div>
        <button class="btn btn-warning shadow-sm rounded-pill px-4 font-weight-bold" onclick="Swal.fire('ระบบเพิ่มช่าง', 'กำลังพัฒนาหน้าฟอร์ม...', 'info')">
            <i class="fas fa-plus-circle mr-2"></i> เพิ่มช่างใหม่
        </button>
    </div>
</div>

<div class="row">
    @foreach ($barbers as $barber)
    <div class="col-12 col-sm-6 col-lg-3 mb-4">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden; transition: 0.3s;">
            <div class="position-relative">
                <img src="{{ asset('storage/' . $barber->image) }}" 
                     class="card-img-top" 
                     style="height: 200px; object-fit: cover;">
                
                <div class="position-absolute" style="top: 10px; right: 10px;">
                    <span class="badge badge-success px-2 py-1 shadow-sm" style="border-radius: 10px; font-size: 10px;">ONLINE</span>
                </div>
            </div>

            <div class="card-body text-center p-3">
                <h6 class="font-weight-bold mb-1 text-uppercase">ช่าง {{ $barber->nickname }}</h6>
                <p class="text-muted small mb-3 italic">{{ $barber->phone }}</p>
                
                <div class="d-flex justify-content-center flex-wrap gap-2">
                    <button class="btn btn-light btn-sm rounded-pill px-3 border mb-2 mx-1" 
                            onclick="viewBarber('{{ $barber->nickname }}', '{{ $barber->phone }}', '{{ asset('storage/' . $barber->image) }}')">
                        <i class="fas fa-eye text-primary"></i> ข้อมูล
                    </button>
                    
                    <form action="{{ route('barbers.destroy', $barber->id) }}" method="POST" id="del-{{ $barber->id }}">
                        @csrf @method('DELETE')
                        <button type="button" class="btn btn-light btn-sm rounded-pill px-3 border mb-2 mx-1" onclick="confirmDelete({{ $barber->id }})">
                            <i class="fas fa-trash text-danger"></i> ลบ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
    // Pop-up แสดงรายละเอียดช่าง
    function viewBarber(name, phone, img) {
        Swal.fire({
            title: '<span class="italic text-uppercase font-weight-bold">Profile ช่าง</span>',
            html: `
                <div class="text-center">
                    <img src="${img}" class="rounded-circle mb-3 border shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                    <h4>ช่าง ${name}</h4>
                    <p class="text-muted"><i class="fas fa-phone-alt text-warning"></i> ติดต่อ: ${phone}</p>
                    <hr>
                    <div class="badge badge-light p-2">สถานะ: กำลังปฏิบัติงาน</div>
                </div>
            `,
            showConfirmButton: false,
            showCloseButton: true,
            customClass: { popup: 'rounded-20' }
        });
    }

    // Pop-up ยืนยันการลบ
    function confirmDelete(id) {
        Swal.fire({
            title: 'ยืนยันการลบ?',
            text: "คุณกำลังจะลบช่างคนนี้ออกจากระบบ!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'ใช่, ลบเลย',
            cancelButtonText: 'ยกเลิก',
            customClass: { popup: 'rounded-20' }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('del-' + id).submit();
            }
        })
    }
</script>

<style>
    .rounded-20 { border-radius: 20px !important; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
</style>
@endsection