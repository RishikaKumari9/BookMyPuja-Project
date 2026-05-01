@extends('app.layout')
@section('content')

<main></main>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<meta charset="UTF-8">
<script src="https://cdn.tailwindcss.com"></script>

<section class="min-h-screen flex items-center justify-center" style="background-color: #faad28;">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-2xl">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">About Us</h2>

        <div class="space-y-6 text-gray-700">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    <i class="fas fa-info-circle" style="color: #fa7f28;"></i> Who We Are
                </h3>
                <p>BhaktiPath is a trusted platform dedicated to connecting devotees with authentic puja services and spiritual ceremonies for all occasions.</p>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    <i class="fas fa-bullseye" style="color: #fa7f28;"></i> Our Mission
                </h3>
                <p>We aim to make traditional puja services easily accessible and affordable for everyone, while preserving the sanctity and authenticity of religious practices.</p>
            </div>

             <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    <i class="fas fa-star" style="color: #fa7f28;"></i> What We Offer
                </h3>
                <ul class="list-disc list-inside space-y-1">
                    <li><b><i>Puja Services:</i></b> Choose from hundreds of Puja services performed by verified, skilled priests.</li>
                    <li><b><i>Puja Products:</i></b> Explore a wide range of authentic Puja items, from idols and incense to complete Puja kits.</li>
                    <li><b><i>Custom Rituals:</i></b> Tailored Puja experiences based on your personal needs and traditions.</li>
                </ul>
            </div>

              <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    <i class="fas fa-bullseye" style="color: #fa7f28;"></i> Connect With Us
                </h3>
                <p>Reach out for assistance, custom Puja requests, or to explore our services. Your spiritual satisfaction is our top priority.</p>
              </div>

            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    <i class="fas fa-star" style="color: #fa7f28;"></i> Why Choose Us
                </h3>
                <ul class="list-disc list-inside space-y-1">
                    <li>Verified and experienced priests and pandits</li>
                    <li>Transparent pricing and booking process</li>
                    <li>24/7 customer support</li>
                    <li>Secure and reliable platform</li>
                </ul>
            </div>
        </div>




        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="inline-block" style="background-color: #fa7f28; color: #fff; padding: 0.75rem 2rem; border-radius: 0.5rem; text-decoration: none; transition: background 0.2s;"
                onmouseover="this.style.backgroundColor='#fa8f28'" onmouseout="this.style.backgroundColor='#fa7f28'">
                Back to Home
            </a>
        </div>
    </div>
</section>

@endsection
