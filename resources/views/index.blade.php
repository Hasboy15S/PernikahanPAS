@extends('layouts.main')

@section('title', 'Fhatayy & Chelsya Wedding')

@section('content')

{{-- SECTION 1 — WELCOME (HERO) --}}
<section class="hero">
        <div class="hero-content">
            <img src="{{ asset('images/nama.png') }}" alt="Nama mempelai">
            <div class="date-badge">
                <span>RSVP</span>
            </div>
        </div>
        <div class="scroll-indicator">
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>
    
    <main>
        <section class="ivt">
            <div class="container">
                <div class="couple-image">
                    <!-- fotonya posisi dikiri -->
                    <div class="image-placeholder"></div>
                </div>
                <div class="ivt-content">
                    <!-- posisi ditengah -->
                    <h2>How We Meet</h2>
                    <p>It all started back in 2008, at school. From the very first moment I saw her, something moved inside me, something I had never felt before. I didn’t know what to call it, but I knew she was special. I just didn’t have the courage to say anything.
                        But somehow, the feeling didn’t stay secret for long. The news spread like wildfire. Everyone knew…. and eventually, so did she. Her first reaction was just a simple curious question “Who is he?”
                        Then one day, by pure accident, we crossed paths. It was awkward at first two kids pretending not to care but then we started talking. Slowly, naturally, we talked more and more. Without even realizing it, we were falling for each other.
                        No matter how long the school day was, no matter how boring the classes got, we always managed to make it feel brighter just by being together.
                        And when we finally graduated, I gathered every bit of</p>
                </div>
                <div class="couple-image">
                    <!-- fotonya posisi dikanan -->
                    <div class="image-placeholder-2"></div>
                </div>
            </div>
        </section>

        <section class="about">
            <div class="container">
                <h1>Schedule</h1>
                <p>The timeline of our beginning. Join us in every step of the way.</p>
                <div class="img-sch">
                    <div class="img-item-1">
                        <img src="/asset/c7b8b723-734e-4faf-afb7-80f146fc2ddd 2.png" alt="siraman">
                        <h2>08.00</h2>
                        <p>mandrus</p>
                    </div>
                    <div class="img-item-1">
                        <img src="/asset/c7b8b723-734e-4faf-afb7-80f146fc2ddd 2.png" alt="">
                        <h2>08.45</h2>
                        <p>ijab kobul</p>
                    </div>
                    <div class="img-item-1">
                        <img src="/asset/c7b8b723-734e-4faf-afb7-80f146fc2ddd 2.png" alt="">
                        <h2>09.00</h2>
                        <p>panggih manten</p>
                    </div>
                </div>
                <div class="img-sch">
                    <div class="img-item-2">
                        <img src="/asset/c7b8b723-734e-4faf-afb7-80f146fc2ddd 2.png" alt="">
                        <h2>09.30</h2>
                        <p>party</p>
                    </div>
                    <div class="img-item-2">
                        <img src="/asset/w" alt="">
                        <h2>09.45</h2>
                        <p>kuman</p>
                    </div>
                    <div class="img-item-2">
                        <img src="" alt="">
                        <h2>10.00</h2>
                        <p>end</p>
                    </div>
                </div>
            </div>
        </section>

<section class="product">
    <div class="container">
        <h2>Our Product</h2>
        <p>
            We are delighted to share with you a selection of our favorite products
            that hold special meaning in our journey together.
        </p>

        {{-- ================== AKSESORIS ================== --}}
        <h3 style="margin-top: 40px; margin-bottom: 10px; font-size: 24px; color: #8B4513;">
            Aksesoris
        </h3>

        <div class="product-gallery">

            @forelse ($produk->where('kategori', 'aksesoris') as $item)
                <div class="product-item">

                    {{-- FOTO --}}
                    <img 
                        src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('images/default-product.jpg') }}"
                        alt="{{ $item->nama }}"
                        style="object-fit: cover; width: 100%; height: 200px; border-radius: 10px;"
                    >

                    {{-- NAMA --}}
                    <h3>{{ $item->nama }}</h3>

                    {{-- STOK --}}
                    <p>Stok: {{ $item->stok }}</p>

                    {{-- KATEGORI --}}
                    <p class="category" style="font-weight: bold; color: #8B4513;">
                        {{ strtoupper($item->kategori) }}
                    </p>

                    {{-- DESKRIPSI --}}
                    <p>{{ $item->deskripsi }}</p>

                </div>
            @empty
                <p style="text-align:center; color:gray; width:100%;">
                    Belum ada produk aksesoris.
                </p>
            @endforelse

        </div>


        {{-- ================== FOOD & BEVERAGE ================== --}}
        <h3 style="margin-top: 50px; margin-bottom: 10px; font-size: 24px; color: #8B4513;">
            Food & Beverage
        </h3>

        <div class="product-gallery">

            @forelse ($produk->where('kategori', 'fnb') as $item)
                <div class="product-item">

                    {{-- FOTO --}}
                    <img 
                        src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('images/default-product.jpg') }}"
                        alt="{{ $item->nama }}"
                        style="object-fit: cover; width: 100%; height: 200px; border-radius: 10px;"
                    >

                    {{-- NAMA --}}
                    <h3>{{ $item->nama }}</h3>

                    {{-- STOK --}}
                    <p>Stok: {{ $item->stok }}</p>

                    {{-- KATEGORI --}}
                    <p class="category" style="font-weight: bold; color: #8B4513;">
                        {{ strtoupper($item->kategori) }}
                    </p>

                    {{-- DESKRIPSI --}}
                    <p>{{ $item->deskripsi }}</p>

                </div>
            @empty
                <p style="text-align:center; color:gray; width:100%;">
                    Belum ada produk FNB.
                </p>
            @endforelse

        </div>

    </div>
</section>

  {{-- RSVP SECTION --}}
        <section class="rsvp">
            <div class="container">
                <h2>RSVP</h2>
                <p>Please confirm your attendance by 01.12.2025</p>
                <div class="tdy">
                    <div class="rsvp-form">
                        <form id="wedding-rsvp" method="POST" action="{{ route('invite.front') }}" >
                            @csrf
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="guests">Number of Guests</label>
                                <select id="guests" name="jml_hadir" required>
                                    <option value="" disabled selected>Select number of guests</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5+</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message">Message for the couple</label>
                                <textarea id="message" name="message" rows="4"></textarea>
                            </div>
                            <button type="submit" class="submit-btn">Submit RSVP</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="closing">
            <div class="container">
                <h2>Counting the Days to Our Wedding</h2>
                <!-- count down -->
                <div class="countdown">
                        <div class="countdown-item">
                            <span id="days">00</span>
                            <p>Days</p>
                        </div>
                        <div class="countdown-item">
                            <span id="hours">00</span>
                            <p>Hours</p>
                        </div>
                        <div class="countdown-item">
                            <span id="minutes">00</span>
                            <p>Minutes</p>
                        </div>
                        <div class="countdown-item">
                            <span id="seconds">00</span>
                            <p>Seconds</p>
                        </div>
                    </div>
            </div>
        </section>
    </main>
    @if(session('showQR'))
<div id="qrModal" 
    style="position: fixed; top:0; left:0; width:100%; height:100%; 
           background: rgba(0,0,0,0.6); display:flex; justify-content:center; 
           align-items:center; z-index:9999;">
    
    <div style="background:white; padding:20px; border-radius:10px; text-align:center;">
        <h2>QR Code Anda</h2>
        <img src="{{ session('qrImage') }}" style="width:250px; margin:20px auto;">
        <p>Kode: <b>{{ session('qrCode') }}</b></p>

        <button onclick="document.getElementById('qrModal').style.display='none'" 
                style="margin-top:15px; padding:10px 20px; background:black; color:white; border:none;">
            Tutup
        </button>
    </div>

</div>
@endif

    <script>
        // Animasi Navbar Scroll dengan Height Mengecil
window.addEventListener('scroll', function() {
    const header = document.querySelector('header');
    const scrollPosition = window.scrollY;
    
    if (scrollPosition > 50) { // Threshold lebih rendah untuk respons lebih cepat
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header');
    const scrollPosition = window.scrollY;
    
    if (scrollPosition > 50) {
        header.classList.add('scrolled');
    }
    
    // Smooth scroll untuk anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});


        // Target date: 2 December 2025, 07:30 AM (WIB)
const targetDate = new Date("December 2, 2025 07:30:00").getTime();

const countdownFunc = setInterval(() => {
    const now = new Date().getTime();
    const distance = targetDate - now;

    // Time calculations
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Update HTML
    document.getElementById("days").innerHTML = days < 10 ? "0" + days : days;
    document.getElementById("hours").innerHTML = hours < 10 ? "0" + hours : hours;
    document.getElementById("minutes").innerHTML = minutes < 10 ? "0" + minutes : minutes;
    document.getElementById("seconds").innerHTML = seconds < 10 ? "0" + seconds : seconds;

    // If event date has passed
    if (distance < 0) {
        clearInterval(countdownFunc);
        document.querySelector(".countdown").innerHTML = `
            <div class="text-center text-xl font-semibold text-green-700">
                The Wedding Has Started ❤️
            </div>
        `;
    }
}, 1000);

        </script>
    <script src="{{ asset('script.js') }}"></script>
    <script src="https://kit.fontawesome.com/5ea0eadb61.js" crossorigin="anonymous"></script>

@endsection
