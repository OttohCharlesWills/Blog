<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About - BlogSite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

        <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0b0f19;
            color: #fff;
        }


        .hero {
            height: 520px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            background:
                linear-gradient(135deg, rgba(37,99,235,0.65), rgba(147,51,234,0.65)),
                url('https://images.unsplash.com/photo-1492724441997-5dc865305da7') center/cover no-repeat;
        }

        .hero h1 {
            font-size: 60px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 20px;
            max-width: 700px;
            margin: auto;
        }

        .section-title {
            font-size: 40px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: #111827;
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-8px);
        }

        .stat-number {
            font-size: 40px;
            font-weight: 800;
        }

        .author-card {
            background-color: #111827;
            border-radius: 16px;
            overflow: hidden;
            transition: 0.3s;
        }

        .author-card:hover {
            transform: translateY(-10px);
        }

        .author-card img {
            width: 100%;
            height: 260px;
            object-fit: cover;
        }

        .testimonial-card {
            background-color: #111827;
            padding: 30px;
            border-radius: 16px;
            height: 100%;
        }

        .cta {
            background: linear-gradient(135deg, #2563eb, #9333ea);
            padding: 100px 20px;
            text-align: center;
        }

        .btn-custom {
            background-color: #fff;
            color: #000;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 12px;
        }

        footer {
            background-color: #0b0f19;
            padding: 40px 0;
            text-align: center;
            color: #aaa;
        }

        .lead{
            letter-spacing: 1.3px;
        }
        .text {
            max-width: 100%;
            margin: auto;

            letter-spacing: 1.5px;
        }

        .text-readers{
            color: #155dfc;
        }

        .text-color{
            color: #9810fa;
        }

        .text-writers{
            color: #e60076;
        }

        .border-row{
            border: 1px solid rgba(128, 128, 128, 0.226);
        }
    </style>
    <style>

        .twinkle {
            position: relative;
        }

        @keyframes blink {
            0%,100% { opacity: 0.2; transform: scale(0.8); }
            50% { opacity: 1; transform: scale(1.2); }
        }

        .icon-div{
            padding: .6rem .8rem;
            margin-right: .7rem;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #2564eb38, #9233ea41);
            border-radius: 15px;
        }

        .text-center{
            display: flex;
            justify-content: center
        }

        .fa-heart{
            background: white;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            font-size: 25px;
        }

        
        .icon-div2{
            padding: .6rem .8rem;
            margin-right: .7rem;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #9810fa4b, #e6007756);
            border-radius: 15px;
        }
        
        .fa-users{
            background: #9810fa;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            font-size: 20px;
        }

        
        
        .icon-div3{
            padding: .6rem .8rem;
            margin-right: .7rem;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #e6007749, #e6007749);
            border-radius: 15px;
        }
        
        .fa-star{
            background: #e60076;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            filter: drop-shadow(0 0 6px rgba(147, 51, 234, 0.6));
            font-size: 22px;
        }

        .quote-icon {
            font-size: 40px;
            color: #3b82f6; /* blue */
            margin-bottom: 20px;
        }

        .test-faint{
            color: rgba(255, 255, 255, 0.349);
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<header class="navbar">
        <div class="logo"><a href="{{ route('welcome') }}">LOGO</a></div>

        <nav class="nav-links">
            <a href="#">Blog</a>
            <a href="#">Topics</a>
            <a href="{{ route('about') }}">About</a>
        </nav>

        @if (Route::has('login'))
            <div class="auth-links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="subscribe-btn">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </header>

{{-- HERO --}}
<section class="hero">
    <div>
        <h1>Our Story Begins Here</h1>
        <p>We built this platform to give writers a voice and readers meaningful content without barriers.</p>
    </div>
</section>

{{-- OUR STORY --}}
<section class="py-5">
    <div class="container">
        <h2 class="section-title text-center"><div class="icon-div"><i class="fa-regular fa-heart gradient-icon"></i></div> Our Story</h2>
        <p class="lead">
            Founded in 2020, BlogSite started with a simple mission: to create a space where meaningful stories
            could be shared, discovered, and celebrated.What began as a small passion project has grown into a thriving community of writers, creators, and readers from around the world.
        </p>
        <p class="text">
            We believe in the power of words to inspire, educate, and connect people. Every day, our team works tirelessly to curate and create content that matters—stories that spark curiosity, challenge perspectives, and celebrate the diverse experiences that make us human.
        </p><br>
        <p class="text">
            Today, BlogSite serves over 500,000 monthly readers and features contributions from talented writers across multiple continents. But our core values remain unchanged: authenticity, quality, and community.
        </p>

        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div class="stat-card border-row">
                    <div class="stat-number text-readers">500K+</div>
                    <p>Monthly Readers</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card border-row">
                    <div class="stat-number text-color">1,200+</div>
                    <p>Published Articles</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card border-row">
                    <div class="stat-number text-writers">50+</div>
                    <p>Contributing Writers</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- AUTHORS --}}
<section class="py-5">
    <div class="container">
       <h2 class="section-title text-center"><div class="icon-div2"><i class="fa-solid fa-users gradient-icon"></i></div> Meet Our Authors</h2></h2>
 
        <div class="row">
            @for($i = 1; $i <= 6; $i++)
            <div class="col-md-4 mb-4 ">
                <div class="author-card border-row">
                    <img src="https://picsum.photos/400/400?random={{ $i }}" alt="Author">
                    <div class="p-4">
                        <h5 class="fw-bold">Author Name</h5>
                        <p class="text-info fw-bold">Creative Writer</p>
                        <small>Passionate about storytelling and sharing knowledge with the world.</small>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
<section class="py-5">
    <div class="container">

       <h2 class="section-title text-center"><div class="icon-div3"><i class="fa-regular fa-star gradient-icon twinkle"></i></div> What Readers Say</h2></h2>
 
        <div class="row">
            @for($i = 1; $i <= 3; $i++)
            <div class="col-md-4 mb-4">
                <div class="testimonial-card border-row">
                    <h4><i class="fa-solid fa-quote-left quote-icon"></i></h4>
                    <i>
                        <p class="test-faint">
                            "BlogSite has become my daily source of inspiration.
                            The quality of writing keeps me coming back every day."
                        </p>    
                    </i><br>
                    <h6 class="mt-3 fw-bold">Jessica Thompson</h6>
                    <small class="test-faint">Marketing Director</small>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta">
    <div class="container">
        <h2 class="fw-bold mb-3">Join Our Community</h2>
        <p class="mb-4">
            Subscribe to get the latest stories, exclusive content, and updates delivered weekly.
        </p>
        <a href="#" class="btn btn-custom">Subscribe Now</a>
    </div>
</section>

<footer>
    <p>© {{ date('Y') }} BlogSite. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>