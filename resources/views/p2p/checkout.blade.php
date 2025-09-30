<x-app-layout>

@php
    $breadcrumbItems = [
        ['label' => 'Home', 'url' => url('/')],
        ['label' => $product->name, 'url' => url('/products/' . $product->category->slug . '/' . $product->slug)],
        ['label' => 'Checkout'],
    ];
@endphp

<x-slot name="breadcrumb">
    <x-breadcrumb :items="$breadcrumbItems" />
</x-slot>

<section class="bg-gradient-to-br from-white to-gray-100 min-h-screen py-6">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-start">

        <!-- Left: Product Summary -->
        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-gray-800">🔖 Order Summary</h2>
            <div class="bg-white p-6 rounded-xl shadow space-y-4">
                @php 
                    $screenshotsArray = json_decode($product->screenshots, true);
                    $image = !empty($screenshotsArray) ? $screenshotsArray[0] : 'https://via.placeholder.com/400x250.png?text=No+Image+Available';
                @endphp
                <img src="{{ $image }}" alt="Product Image" class="rounded-lg w-full h-40 object-cover">

                <div>
                    <h3 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h3>
                    <p class="text-gray-600 mt-2">{{ $product->category->name }}</p>
                </div>

                <!-- Tax & Fees Table -->
                <div class="border-t pt-4 text-sm text-gray-700">
                    <table class="w-full text-left">
                        <tbody>
                            <tr>
                                <td class="py-1 font-medium">Tax</td>
                                <td class="py-1 text-right">0.00</td>
                            </tr>
                            <tr>
                                <td class="py-1 font-medium">Fees</td>
                                <td class="py-1 text-right">0.00</td>
                            </tr>
                            <tr class="border-t font-bold text-green-600">
                                <td class="py-2">Total</td>
                                <td class="py-2 text-right">${{ $product->price_usd }} <span class="text-indigo-300">(or)</span> ₹{{ $product->price_inr }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right: P2P Checkout Info -->
        <div>
            
            <div class="bg-white p-6 rounded-xl shadow space-y-5">
                <h4 class="text-2xl font-bold text-gray-800 mb-6">💳 Proceed to P2P Payment</h4>
                @auth
                    <!-- Show logged-in user info -->
                    <div class="bg-gray-50 border border-gray-200 p-4 rounded-md">
                        <p class="text-sm text-gray-700">
                            👤 <strong>Name:</strong> {{ Auth::user()->name }}
                        </p>
                        <p class="text-sm text-gray-700 mt-1">
                            📧 <strong>Email:</strong> {{ Auth::user()->email }}
                        </p>
                    </div>
                @else
                    <!-- Ask to log in or register -->
                    <div class="bg-red-50 border border-red-200 p-4 rounded-md text-sm text-red-700">
                        ⚠️ You need to <a href="{{ route('login') }}" class="underline font-medium">Login</a> or 
                        <a href="{{ route('register') }}" class="underline font-medium">Register</a> to continue with the order.
                    </div>
                @endauth

                @if($product->free == 0)
                <!-- P2P Payment Experience -->
                <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-md text-sm text-yellow-800">
                    ✨ You're about to experience a fast and personalized payment method called <strong>P2P (Peer-to-Peer)</strong>.
                    After confirming your order, you’ll get direct instructions to pay via:
                    <ul class="list-disc list-inside mt-2 space-y-1">
                        <li>📲 UPI / Bank Transfer (India)</li>
                        <li>💸 Binance Pay, TRC20, other crypto</li>
                        <li>✅ Instantly confirm payment or refund</li>
                    </ul>
                    This approach is secure, flexible, and puts you in direct contact with the seller.
                </div>
                @endif

                @if($product->free == 0)
                <!-- Live Chat & Instant Support -->
                <div class="bg-indigo-50 border border-indigo-200 p-4 rounded-md text-sm text-indigo-800">
                    💬 <strong>Author is Online Now!</strong> — As soon as you place the order, a chat window will open where you can:
                    <ul class="list-disc list-inside mt-2 space-y-1">
                        <li>🔍 Ask questions before or after payment</li>
                        <li>🚀 Get instant help and confirmation</li>
                        <li>🤝 Enjoy a human, real-time checkout experience</li>
                    </ul>
                    No waiting. No bots. Just real-time human help!
                </div>
                @endif

                <!-- Terms and Confirm -->
                @auth
                    <form action="{{ route('p2p.order.new', $product->id) }}" method="POST">
                        @csrf

                        <div class="flex items-start">
                            <input type="checkbox" id="agree" name="agree" required
                                class="mt-1.5 h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <label for="agree" class="ml-3 text-sm text-gray-600">
                                I agree to the <a href="#" class="underline text-indigo-600">Terms & Conditions</a> and 
                                <a href="#" class="underline text-indigo-600">Refund Policy</a>.
                            </label>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                            class="w-full inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 rounded-md text-center transition">
                            @if($product->free)
                                Proceed to Download
                            @else
                                Proceed to P2P Payment
                            @endif
                            
                            </button>
                        </div>
                    </form>
                @endauth
            </div>
        </div>

    </div>
</section>

</x-app-layout>
