<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบเสร็จการจอง | IT BARBER</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300;400;600;700&family=Prompt:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        :root { --gold: #ffcc00; --dark: #121212; }
        body { background: var(--dark); font-family: 'Chakra Petch', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; padding: 20px; }
        #official-receipt { background: #fff; color: #000; width: 100%; max-width: 500px; padding: 50px 40px; box-shadow: 0 30px 100px rgba(0,0,0,0.7); border-radius: 10px; position: relative; border-top: 12px solid var(--gold); }
        .receipt-header { text-align: center; margin-bottom: 35px; }
        .receipt-logo { width: 100px; height: 100px; border-radius: 50%; border: 3px solid #eee; margin-bottom: 15px; object-fit: cover; }
        .receipt-header h2 { font-weight: 800; font-size: 28px; margin: 0; color: #000; letter-spacing: 2px; }
        .receipt-header p { font-size: 13px; color: #666; margin: 2px 0; }
        .meta-section { display: flex; justify-content: space-between; border-bottom: 2px solid #f0f0f0; padding-bottom: 15px; margin-bottom: 25px; font-size: 14px; font-weight: 600; color: #444; }
        .receipt-table { width: 100%; margin-bottom: 30px; }
        .receipt-table th { border-bottom: 2px solid #000; padding: 12px 0; font-size: 12px; text-transform: uppercase; color: #888; }
        .receipt-table td { padding: 20px 0; vertical-align: middle; }
        .item-name { font-family: 'Prompt', sans-serif; font-size: 18px; font-weight: 700; color: #000; display: block; }
        .item-sub { font-size: 13px; color: #777; }
        .item-price { text-align: right; font-size: 20px; font-weight: 700; color: #000; }
        .booking-details { background: #fcfcfc; border: 1px solid #eee; border-radius: 20px; padding: 25px; margin-bottom: 30px; }
        .detail-row { display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 15px; }
        .detail-label { color: #888; font-weight: 500; }
        .detail-value { font-weight: 700; color: #000; text-align: right; }
        .time-focus { background: #000; color: var(--gold); text-align: center; padding: 20px; border-radius: 15px; margin-top: 10px; }
        .time-focus span { font-size: 35px; font-weight: 800; display: block; line-height: 1; }
        .time-label { font-size: 11px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 5px; opacity: 0.8; }
        .dashed-divider { border-top: 2px dashed #eee; margin: 30px 0; }
        .action-area { width: 100%; max-width: 500px; margin-top: 30px; }
        .btn-main { background: var(--gold); color: #000; border: none; width: 100%; padding: 18px; border-radius: 15px; font-weight: 800; font-size: 18px; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 30px rgba(255, 204, 0, 0.3); display: block; text-align: center; text-decoration: none; }
        .btn-main:hover { background: #fff; transform: translateY(-5px); text-decoration: none; color: #000; }
    </style>
</head>
<body>

<div class="container-fluid d-flex flex-column align-items-center">
    
    @if($appointment)
        <div id="official-receipt">
            <div class="receipt-header">
                <img src="https://i.postimg.cc/wBXNS8BC/634279408-927069233189594-6692013687990253917-n.jpg" class="receipt-logo">
                <h2>IT BARBER</h2>
                <p>สาขา: {{ $appointment->branch }}</p>
                <p>ออกเมื่อ: {{ \Carbon\Carbon::now('Asia/Bangkok')->locale('th')->translatedFormat('j F Y | H:i') }} น.</p>
            </div>

            <div class="meta-section">
                <span>ID: #{{ str_pad($appointment->id, 6, '0', STR_PAD_LEFT) }}</span>
                <span class="text-success"><i class="fas fa-check-circle"></i> CONFIRMED</span>
            </div>

            <table class="receipt-table">
                <thead>
                    <tr>
                        <th>บริการ / ช่าง</th>
                        <th class="text-right">ราคา</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span class="item-name">{{ $appointment->service->name }}</span>
                            <span class="item-sub">Barber: {{ $appointment->barber->name }}</span>
                        </td>
                        <td class="item-price">฿{{ number_format($appointment->service->price, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="booking-details">
                <div class="detail-row">
                    <span class="detail-label">ชื่อลูกค้า:</span>
                    <span class="detail-value">{{ $appointment->customer_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">วันที่นัด:</span>
                    <span class="detail-value">
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->locale('th')->translatedFormat('lที่ j F Y') }}
                    </span>
                </div>

                <div class="time-focus">
                    <div class="time-label">เวลาที่จองไว้</div>
                    <span>{{ date('H:i', strtotime($appointment->appointment_time)) }} น.</span>
                </div>
            </div>

            <div class="dashed-divider"></div>

            <div class="text-center">
                <p class="small text-muted mb-3">กรุณามาก่อนเวลานัด 5-10 นาที<br>ขอบคุณที่ใช้บริการ IT BARBER ครับ</p>
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=ITB-{{ $appointment->id }}" style="width: 90px; filter: grayscale(1);">
            </div>
        </div>

        <div class="action-area no-print">
            <button onclick="saveImage()" class="btn-main mb-3">
                <i class="fas fa-camera mr-2"></i> บันทึกเป็นรูปภาพ
            </button>
            <div class="text-center">
                <a href="/" class="text-white-50 small">
                    <i class="fas fa-home mr-1"></i> กลับหน้าแรก
                </a>
            </div>
        </div>
    @endif
</div>

<script>
    function saveImage() {
        const receipt = document.getElementById('official-receipt');
        html2canvas(receipt, {
            scale: 2,
            backgroundColor: "#ffffff",
        }).then(canvas => {
            const link = document.createElement('a');
            link.download = 'IT-BARBER-Receipt-{{ $appointment->id }}.png';
            link.href = canvas.toDataURL();
            link.click();
        });
    }
</script>

</body>
</html>