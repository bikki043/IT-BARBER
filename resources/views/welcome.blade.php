<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT BARBER ตัดผมชาย </title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300;400;700&family=Oswald:wght@500;700&family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        :root { --gold: #ffcc00; --dark: #000; --gray: #111; }
        body { background-color: var(--dark); color: #fff; font-family: 'Chakra Petch', sans-serif; overflow-x: hidden; }

        /* --- Navbar & Logo Left --- */
        .navbar-custom { padding: 20px 50px; display: flex; align-items: center; justify-content: space-between; background: rgba(0,0,0,0.8); sticky: top; z-index: 1000; }
        .nav-logo { width: 80px; height: 80px; border-radius: 50%; border: 2px solid var(--gold); box-shadow: 0 0 15px rgba(255,204,0,0.3); }
        .nav-links { list-style: none; display: flex; margin: 0; padding: 0; }
        .nav-links li { margin: 0 15px; }
        .nav-links a { color: #fff; text-transform: uppercase; font-size: 0.9rem; font-weight: 600; text-decoration: none; transition: 0.3s; }
        .nav-links a:hover, .nav-links a.active { color: var(--gold); }
        .nav-icons i { color: #fff; margin-left: 20px; font-size: 1.2rem; cursor: pointer; transition: 0.3s; }
        .nav-icons i:hover { color: var(--gold); }

        /* --- Hero Section --- */
        .hero-section {
            height: 90vh;
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.8)), 
                        url('https://i.postimg.cc/VkVbVxCr/unnamed-(3)-artguru.png') center/cover no-repeat;
            display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;
        }
        .hero-title { 
            font-family: 'Montserrat'; font-size: clamp(3rem, 10vw, 7rem); font-weight: 900; 
            text-transform: uppercase; line-height: 0.9; text-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .hero-title span { color: var(--gold); }
        .btn-booking { 
            background: #fff; color: #000 !important; font-weight: 800; padding: 20px 60px; 
            font-size: 1.8rem; border-radius: 10px; margin-top: 50px; transition: 0.4s;
            box-shadow: 0 15px 40px rgba(0,0,0,0.5); text-decoration: none !important;
        }
        .btn-booking:hover { background: var(--gold); transform: translateY(-5px); }

        /* --- Showcase Section (New!) --- */
        .section-title { text-align: center; margin-bottom: 60px; }
        .section-title h2 { font-family: 'Oswald'; font-size: 3rem; font-weight: 700; letter-spacing: 5px; }
        .section-title div { width: 80px; height: 4px; background: var(--gold); margin: 10px auto; }

        .portfolio-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 10px; padding: 0 10px; }
        .portfolio-item { position: relative; height: 400px; overflow: hidden; }
        .portfolio-item img { width: 100%; height: 100%; object-fit: cover; transition: 0.6s; filter: grayscale(50%); }
        .portfolio-item:hover img { filter: grayscale(0%); transform: scale(1.1); }
        .portfolio-overlay { 
            position: absolute; bottom: 0; left: 0; right: 0; padding: 40px 20px;
            background: linear-gradient(transparent, rgba(0,0,0,0.9)); opacity: 0; transition: 0.4s;
        }
        .portfolio-item:hover .portfolio-overlay { opacity: 1; }

        /* --- Quote Section --- */
        .quote-container { 
            padding: 150px 20px; background: fixed url('https://images.unsplash.com/photo-1512690196252-7c703fd99f92?q=80&w=2000') center/cover;
            text-align: center; position: relative;
        }
        .quote-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.85); }
        .quote-content { position: relative; z-index: 1; }
        .quote-content i { font-size: 3rem; color: var(--gold); margin-bottom: 30px; }
        .quote-content p { font-size: 2.5rem; font-weight: 700; font-style: italic; max-width: 800px; margin: 0 auto; }

        /* --- Footer --- */
        .footer { padding: 80px 0 30px; background: #050505; border-top: 1px solid #222; }
        .footer-logo { width: 100px; margin-bottom: 20px; }
        .info-box h5 { color: var(--gold); font-family: 'Oswald'; margin-bottom: 20px; }
        
        @media (max-width: 768px) {
            .navbar-custom { padding: 15px 20px; }
            .nav-links { display: none; }
            .hero-title { font-size: 3.5rem; }
        }
    </style>
</head>
<body>

    <nav class="navbar-custom">
        <div class="d-flex align-items-center">
            <img src="https://i.postimg.cc/wBXNS8BC/634279408-927069233189594-6692013687990253917-n.jpg" class="nav-logo" alt="Logo">
        </div>
        <ul class="nav-links">
            <li><a href="#" class="active">Home</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Gallery</a></li>
            <li><a href="#">Branches</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <div class="nav-icons">
            <i class="fas fa-search"></i>
            <i class="fas fa-shopping-cart"></i>
            <i class="far fa-user"></i>
        </div>
    </nav>

    <div class="hero-section">
        <p style="letter-spacing: 5px; color: var(--gold);">ESTABLISHED 2026</p>
        <h1 class="hero-title">IT<br><span>BARBER SHOP</span></h1>
        <a href="{{ route('booking.page') }}" class="btn-booking">จองคิวออนไลน์</a>
    </div>

    <section class="py-5 bg-black">
        <div class="container-fluid">
            <div class="section-title">
                <h2>LATEST WORK</h2>
                <div></div>
                <p class="text-muted">ทรงผมยอดนิยมโดยทีมช่างมืออาชีพ</p>
            </div>
            <div class="portfolio-grid">
                <div class="portfolio-item">
                    <img src="https://images.unsplash.com/photo-1621605815971-fbc98d665033?q=80&w=600">
                    <div class="portfolio-overlay"><h4>Skin Fade</h4><p>ตัดแต่งทรงผมชายสไตล์ทันสมัย</p></div>
                </div>
                <div class="portfolio-item">
                    <img src="https://www.shutterstock.com/image-photo/barber-hairdresser-cutting-hair-beard-600nw-2530126801.jpg">
                    <div class="portfolio-overlay"><h4>Classic Pompadour</h4><p>ความเนี๊ยบระดับตำนาน</p></div>
                </div>
                <div class="portfolio-item">
                    <img src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?q=80&w=600">
                    <div class="portfolio-overlay"><h4>Beard Grooming</h4><p>ดูแลหนวดเคราให้เข้าทรง</p></div>
                </div>
                <div class="portfolio-item">
                    <img src="https://images.unsplash.com/photo-1605497788044-5a32c7078486?q=80&w=600">
                    <div class="portfolio-overlay"><h4>Modern Mullet</h4><p>ทรงผมสุดฮิตสไตล์หัวกรวย</p></div>
                </div>
            </div>
        </div>
    </section>

    <div class="quote-container">
        <div class="quote-overlay"></div>
        <div class="quote-content container">
            <i class="fas fa-quote-left"></i>
            <p>" ไอที นอกจากจะเรียนคอม  เเต่ก็คือช่างตัดผม ที่อยากให้ทุกคนหันมาดูแลตัวเอง "</p>
            <p class="mt-4" style="font-size: 1.2rem; color: var(--gold); font-family: 'Oswald';">CEO OF IT BARBER</p>
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <img src="https://i.postimg.cc/wBXNS8BC/634279408-927069233189594-6692013687990253917-n.jpg" class="footer-logo" alt="Footer Logo">
            <div class="row text-left mt-5">
                <div class="col-md-4 info-box">
                    <h5>LOCATION</h5>
                    <p class="text-muted">บ้านโป่ง | หนองอ้อ | ในเมือง<br>จังหวัดบุรีรัมย์</p>
                </div>
                <div class="col-md-4 info-box">
                    <h5>OPENING HOURS</h5>
                    <p class="text-muted">จันทร์ - อาทิตย์<br>10:00 AM - 20:00 PM</p>
                </div>
                <div class="col-md-4 info-box">
                    <h5>CONTACT US</h5>
                    <p class="text-muted">Line ID: @IT-BARBER<br>Tel: 0984784512</p>
                </div>
            </div>
            <hr style="border-color: #222;" class="my-5">
            <p class="text-muted small">© 2026 IT BARBER SQUAD. ALL RIGHTS RESERVED.</p>
        </div>
    </footer>

</body>
</html>