@extends('app.layout')
@section('content')

<main></main>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<meta charset="UTF-8">
<script src="https://cdn.tailwindcss.com"></script>

<section class="min-h-screen flex items-center justify-center" style="background-color: #faad28;">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-2xl">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Contact Us</h2>

        <div class="space-y-6 text-gray-700">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    <i class="fas fa-phone" style="color: #fa7f28;"></i> Phone
                </h3>
                <p>+91 9854879065</p>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    <i class="fas fa-envelope" style="color: #fa7f28;"></i> Email
                </h3>
                <p><a href="mailto:support@bhaktiPath.com" class="text-blue-600 hover:underline">support@bhaktiPath.com</a></p>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    <i class="fas fa-map-marker-alt" style="color: #fa7f28;"></i> Address
                </h3>
                <p>BhaktiPath Headquarters<br>Circular Road, Ranchi-834001.<br>Jharkhand, India.</p>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    <i class="fas fa-clock" style="color: #fa7f28;"></i> Business Hours
                </h3>
                <ul class="list-disc list-inside space-y-1">
                    <li>Monday - Friday: 9:00 AM - 6:00 PM IST</li>
                    <li>Saturday: 10:00 AM - 4:00 PM IST</li>
                    <li>Sunday: 10:00 AM - 2:00 PM IST</li>
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    <i class="fas fa-share-alt" style="color: #fa7f28;"></i> Follow Us
                </h3>
                <div class="flex gap-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-facebook text-2xl"></i></a>
                    <a href="#" class="text-blue-400 hover:text-blue-600"><i class="fab fa-twitter text-2xl"></i></a>
                    <a href="#" class="text-pink-600 hover:text-pink-800"><i class="fab fa-instagram text-2xl"></i></a>
                    <a href="#" class="text-red-600 hover:text-red-800"><i class="fab fa-youtube text-2xl"></i></a>
                </div>
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
