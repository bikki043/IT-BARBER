<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT BARBER | จองคิวออนไลน์</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300;400;600;700&family=Oswald:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        :root { 
            --gold: #ffcc00; 
            --gold-glow: rgba(255, 204, 0, 0.4);
            --dark: #050505;
            --glass: rgba(10, 10, 10, 0.85);
            --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        
        body { 
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.85)), 
                        url('https://images.unsplash.com/photo-1503951914875-452162b0f3f1?q=80&w=2000') center/cover fixed;
            color: #ffffff; 
            font-family: 'Chakra Petch', sans-serif;
            min-height: 100vh;
        }

        /* --- Custom Scrollbar --- */
        ::-webkit-scrollbar { height: 5px; width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--gold); border-radius: 10px; }

        .top-nav { padding: 30px 0; }
        .btn-back-lux { 
            border: 1px solid rgba(255,255,255,0.2); padding: 8px 20px; border-radius: 50px;
            color: #fff; text-decoration: none !important; font-size: 0.8rem; letter-spacing: 2px;
            transition: var(--transition); background: rgba(255,255,255,0.05);
        }
        .btn-back-lux:hover { background: var(--gold); color: #000; border-color: var(--gold); box-shadow: 0 0 15px var(--gold-glow); }

        .brand-box { text-align: center; margin-bottom: 60px; }
        .logo-main { 
            width: 130px; border: 3px solid var(--gold); border-radius: 50%; padding: 5px;
            box-shadow: 0 0 40px rgba(0,0,0,0.5); filter: drop-shadow(0 0 10px var(--gold-glow));
        }
        .shop-title { font-family: 'Oswald'; font-size: 3.2rem; letter-spacing: 12px; color: var(--gold); text-transform: uppercase; margin-top: 20px; }

        /* --- Date Scroller --- */
        .scroller-wrapper { position: relative; margin-bottom: 50px; }
        .date-scroller { display: flex; gap: 15px; overflow-x: auto; padding: 20px 5px; scroll-behavior: smooth; }
        .date-card { 
            min-width: 100px; height: 130px; background: var(--glass); border: 1px solid rgba(255,255,255,0.1);
            border-radius: 24px; display: flex; flex-direction: column; align-items: center; justify-content: center;
            cursor: pointer; transition: var(--transition); backdrop-filter: blur(10px);
        }
        .date-radio:checked + .date-card { 
            background: var(--gold); border-color: var(--gold); transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(255, 204, 0, 0.3);
        }
        .date-radio:checked + .date-card * { color: #000 !important; }

        /* --- Service 3 Columns --- */
        .lux-card { 
            position: relative; border-radius: 25px; overflow: hidden; height: 350px;
            border: 1px solid rgba(255,255,255,0.1); cursor: pointer; transition: var(--transition);
        }
        .lux-card img { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.6); transition: var(--transition); }
        .lux-card-body { 
            position: absolute; bottom: 0; left: 0; right: 0; padding: 20px;
            background: linear-gradient(to top, rgba(0,0,0,0.9) 40%, transparent);
        }
        .service-radio:checked + .lux-card { border-color: var(--gold); box-shadow: 0 0 30px var(--gold-glow); }
        .service-radio:checked + .lux-card img { filter: brightness(1); transform: scale(1.05); }

        /* --- Summary Panel --- */
        .summary-panel { 
            background: var(--glass); backdrop-filter: blur(15px); border-radius: 35px;
            padding: 40px; border: 1px solid rgba(255,255,255,0.1); position: sticky; top: 40px;
        }
        .form-label-lux { font-size: 0.75rem; font-weight: 700; color: var(--gold); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px; display: block; }
        .input-lux { 
            background: rgba(0,0,0,0.4) !important; border: 1px solid rgba(255,255,255,0.1) !important;
            color: #fff !important; height: 55px !important; border-radius: 15px !important; margin-bottom: 20px;
        }
        .time-select-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 30px; }
        .time-pill { 
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
            padding: 10px; border-radius: 12px; text-align: center; cursor: pointer; transition: var(--transition); font-size: 0.9rem;
        }
        .time-radio:checked + .time-pill { background: var(--gold); color: #000; font-weight: 700; }

        .btn-lux-submit { 
            background: var(--gold); color: #000; border: none; width: 100%; padding: 20px; 
            border-radius: 20px; font-family: 'Oswald'; font-weight: 700; font-size: 1.5rem;
            text-transform: uppercase; letter-spacing: 2px; transition: var(--transition);
        }
        .btn-lux-submit:hover { transform: translateY(-5px); box-shadow: 0 20px 40px var(--gold-glow); background: #fff; }
    </style>
</head>
<body>

<div class="container">
    <div class="top-nav">
        <a href="{{ url('/') }}" class="btn-back-lux"><i class="fas fa-arrow-left mr-2"></i> BACK TO HOME</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4 shadow" style="border-radius: 20px; background: rgba(220,53,69,0.9); color: #fff; border: none;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle mr-2"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="brand-box">
        <img src="https://i.postimg.cc/wBXNS8BC/634279408-927069233189594-6692013687990253917-n.jpg" class="logo-main shadow-lg">
        <h1 class="shop-title">HUA GRUAY BARBER</h1>
        <p class="text-white-50" style="letter-spacing: 4px;">EST. 2026 | PREMIUM CUTS</p>
    </div>

    <form action="{{ route('book.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-8 pr-lg-5">
                
                <h4 class="mb-4 font-weight-bold" style="font-family: 'Oswald';"><span class="text-warning">01.</span> SELECT APPOINTMENT DATE</h4>
                <div class="scroller-wrapper">
                    <div class="date-scroller">
                        @php
                            $months_th = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                            $days_th = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
                        @endphp
                        @for($i = 0; $i < 14; $i++)
                            @php 
                                $current = now()->addDays($i);
                                $val = $current->format('Y-m-d');
                                $d_name = $days_th[$current->format('w')];
                                $d_num = $current->format('d');
                                $m_name = $months_th[$current->format('n') - 1];
                            @endphp
                            <label class="m-0">
                                <input type="radio" name="appointment_date" value="{{ $val }}" class="date-radio d-none" {{ $i == 0 ? 'checked' : '' }} required>
                                <div class="date-card shadow">
                                    <span class="day text-muted small">{{ $d_name }}</span>
                                    <span class="num">{{ $d_num }}</span>
                                    <span class="mon small">{{ $m_name }}</span>
                                </div>
                            </label>
                        @endfor
                    </div>
                </div>

                <h4 class="mb-4 font-weight-bold" style="font-family: 'Oswald';"><span class="text-warning">02.</span> CHOOSE YOUR STYLE</h4>
                <div class="row row-cols-1 row-cols-md-3">
                    @foreach($services as $service)
                    <div class="col mb-4">
                        <label class="m-0 w-100 h-100">
                            <input type="radio" name="service_id" value="{{ $service->id }}" class="service-radio d-none" required>
                            <div class="lux-card shadow-lg">
                                <img src="{{ $service->image_url ?? 'https://images.unsplash.com/photo-1599351431247-f10b21ce5602?q=80&w=600' }}">
                                <div class="lux-card-body">
                                    <h5 class="font-weight-bold text-uppercase mb-1" style="font-family: 'Oswald';">{{ $service->name }}</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-warning font-weight-bold">฿{{ number_format($service->price) }}</span>
                                        <span class="badge badge-light">60 MINS</span>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-4">
                <div class="summary-panel shadow-2xl">
                    <h3 class="mb-5 font-weight-bold text-center" style="font-family: 'Oswald'; letter-spacing: 2px;">RESERVATION</h3>
                    
                    <div class="form-group">
                        <label class="form-label-lux">LOCATION</label>
                        <select name="branch" class="form-control input-lux" required>
                            <option value="บ้านโป่ง">BRANCH: BAN PONG</option>
                            <option value="หนองอ้อ">BRANCH: NONG OR</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label-lux">PREFERED TIME</label>
                        <div class="time-select-grid">
                            @foreach(['10:00','11:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00'] as $t)
                            <label class="m-0">
                                <input type="radio" name="appointment_time" value="{{ $t }}" class="time-radio d-none" required>
                                <div class="time-pill">{{ $t }}</div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label class="form-label-lux">CONTACT INFO</label>
                        <input type="text" name="customer_name" class="form-control input-lux" placeholder="FULL NAME" value="{{ old('customer_name') }}" required>
                        <input type="tel" name="customer_phone" class="form-control input-lux" placeholder="PHONE NUMBER" value="{{ old('customer_phone') }}" required>
                    </div>

                    <input type="hidden" name="barber_id" value="1">
                    
                    <button type="submit" class="btn-lux-submit shadow">CONFIRM NOW</button>
                    
                    <div class="text-center mt-4 opacity-50 small">
                        <i class="fas fa-lock mr-2"></i> SECURE BOOKING SYSTEM
                    </div>
                </div>
            </div>
        </div>
    </form>

    <footer class="footer-info pb-5">
        <p class="mb-1 text-white-50">© 2026 HUA GRUAY STUDIO CO., LTD. ALL RIGHTS RESERVED.</p>
        <p class="text-warning small font-weight-bold">CONTACT SALES: 061-636-6444 (KHUN NOOK)</p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>