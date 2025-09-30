<x-app-layout>

<style>
    /* Chat bubbles for current user (right-aligned) */
.message.user {
    background-color: #d5e54662;  /* Indigo color */
    color: black;
    margin-left: auto;
    margin-bottom: 10px;
    border-radius: 12px;
    padding: 8px 16px;
    max-width: 80%;
    word-wrap: break-word;
}

/* Chat bubbles for other user (left-aligned) */
.message.other {
    background-color: #f3f4f6;  /* Light gray color */
    color: #1f2937;  /* Dark text */
    margin-right: auto;
    margin-bottom: 10px;
    border-radius: 12px;
    padding: 8px 16px;
    max-width: 80%;
    word-wrap: break-word;
}

/* Add a timestamp */
.message .timestamp {
    font-size: 0.75rem;
    color: #6b7280;  /* Gray color */
    margin-top: 4px;
}

</style>
    @php
        $breadcrumbItems = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'P2P', 'url' => url('/products')],
            ['label' => 'Person to Person Order'],
        ];
        $downloadLink = url('/download/sample-file.pdf'); // Example download URL
    @endphp

    <div class="space-y-4">
        <!-- Order Title and Badge -->
        <h2 class="text-2xl flex items-center">
            Order : #112211-{{ $order->id }}
            @switch($order->status)
                @case('new')
                    <span class="ml-3 text-sm font-semibold bg-yellow-500 text-white px-3 py-1 rounded-full">New</span>
                    @break
                @case('pending')
                    <span class="ml-3 text-sm font-semibold bg-blue-600 text-white px-3 py-1 rounded-full">Pending</span>
                    @break
                @case('completed')
                    <span class="ml-3 text-sm font-semibold bg-green-500 text-white px-3 py-1 rounded-full">Verified</span>
                    @break
                @case('denied')
                    <span class="ml-3 text-sm font-semibold bg-red-500 text-white px-3 py-1 rounded-full">Denied</span>
                    @break
                @default
                    <span class="ml-3 text-sm font-semibold bg-gray-500 text-white px-3 py-1 rounded-full">Unknown</span>
            @endswitch
            @if($user->role == 'admin')
                <span class="ml-3 text-sm font-semibold bg-indigo-500 text-white px-3 py-1 rounded-full"> <i class="fa fa-cog"></i> ADMIN VIEW</span>
            @endif
        </h2>

        <x-slot name="breadcrumb">
            <x-breadcrumb :items="$breadcrumbItems" />
            <div class="border-t border-gray-200 my-4"></div>
        </x-slot>
    </div>

    <section class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10">
            <!-- Left Column: Payment Details -->
            <div>
                <p class="mb-2 text-green-700 font-semibold text-lg">
                    ✅ 100% Safe Payment — Instant Live Chat Support
                </p>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded-md">
                        <p>{{ session('success') }}</p>
                    </div>
                @elseif(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-800 border border-red-300 rounded-md">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @if($user->role == 'user')
                    
                    <!-- Order Status -->
                    @switch($order->status)
                        @case('new')
                            <!-- Show payment form if order is "new" -->
                            <div class="mb-6 p-4 bg-yellow-50 border border-yellow-300 rounded-md text-yellow-800 font-semibold text-lg">
                                Amount to Pay: <span class="text-xl">$ {{ $order->amount_usd }} (or) ₹ {{ $order->amount_inr }}</span>
                            </div>

                            <div id="paymentSection">
                                <form id="paymentForm" method="POST" action="{{ route('p2p.order.update.paid') }}">
                                    @csrf
                                    <input type="hidden" name="amount" value="{{ $order->price_usd }}">
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                                    <div class="space-y-4 mt-4">

                                        @foreach($paymentTypes as $pt)
                                        <label class="block bg-white rounded-lg shadow p-4 cursor-pointer border border-gray-300 hover:border-indigo-500 transition flex items-start space-x-4">
                                                <input type="radio" name="payment_mode" value="{{ $pt->id }}" class="mt-1" required>
                                                {!! $pt->description !!}
                                                <p>
                                                    @if($pt->inr == 0)
                                                    Please pay ${{ number_format($order->amount_usd, 2) }} USDT
                                                    @else 
                                                    Please pay ₹{{ number_format($order->amount_inr, 2) }}
                                                    @endif
                                                </p>
                                        </label>
                                        @endforeach
                                    </div>

                                    <div class="mt-6">
                                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 rounded-md transition">
                                            Mark as Paid
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @break

                        @case('pending')
                            <!-- Show message if order is "pending" -->
                            <div class="mb-4 p-4 bg-yellow-100 text-yellow-800 border border-yellow-300 rounded-md">
                                <p>Admin is verifying the transaction. You can chat with admin in the chatbox...</p>
                            </div>
                            <!-- Show order details table for "pending" or "verified" status -->
                            <div class="mb-6 p-4 bg-blue-50 border border-blue-300 rounded-md">
                                <h3 class="font-semibold text-lg mb-4">Order Payment Details</h3>
                                <table class="min-w-full table-auto bg-white shadow-md rounded-md">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 text-left">Label</th>
                                            <th class="px-4 py-2 text-left">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Status</td>
                                            <td class="px-4 py-2 border-b text-blue-500">Pending Verification</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Amount Paid (USD)</td>
                                            <td class="px-4 py-2 border-b text-gray-500">${{ number_format($order->amount_usd, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Amount Paid (INR)</td>
                                            <td class="px-4 py-2 border-b text-gray-500">₹{{ number_format($order->amount_inr, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Payment Mode</td>
                                            <td class="px-4 py-2 border-b text-gray-500">{{ $order->paymentType->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Date and Time</td>
                                            <td class="px-4 py-2 border-b text-gray-500">{{ $order->created_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            @break

                        @case('completed')
                            <!-- Show success message and download link if order is "verified" -->
                            <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded-md">
                                <p>Order Verified! You can now download your file:</p>
                                <a href="{{ route('downloads.download', $order->id) }}" class="text-blue-600 hover:underline">Download Now</a>
                            </div>
                            <!-- Show order details table for "pending" or "verified" status -->
                           
                                <h3 class="font-semibold text-lg mb-4">Order Payment Details</h3>
                                <table class="min-w-full table-auto bg-white shadow-md rounded-md">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 text-left">Label</th>
                                            <th class="px-4 py-2 text-left">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Status</td>
                                            <td class="px-4 py-2 border-b text-green-500">Verified</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Amount Paid (USD)</td>
                                            <td class="px-4 py-2 border-b text-gray-500">${{ number_format($order->amount_usd, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Amount Paid (INR)</td>
                                            <td class="px-4 py-2 border-b text-gray-500">₹{{ number_format($order->amount_inr, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Payment Mode</td>
                                            <td class="px-4 py-2 border-b text-gray-500">
                                                @if($order->product->free)
                                                    Free Product
                                                @else 
                                                 {{ $order->paymentType->name }}
                                                @endif
                                               

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Date and Time</td>
                                            <td class="px-4 py-2 border-b text-gray-500">{{ $order->created_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            

                            @break

                        @case('denied')
                            <!-- Show message if order is "denied" -->
                            <div class="mb-4 p-4 bg-red-100 text-red-800 border border-red-300 rounded-md">
                                <p>Transaction was denied. Please chat with admin for further assistance.</p>
                            </div>

                            <!-- Show order details table for "pending" or "verified" status -->
                            <h3 class="font-semibold text-lg mb-4">Order Payment Details</h3>
                            <table class="min-w-full table-auto bg-white shadow-md rounded-md">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left">Label</th>
                                        <th class="px-4 py-2 text-left">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4 py-2 border-b">Status</td>
                                        <td class="px-4 py-2 border-b text-red-500">Denied</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 border-b">Amount Paid (USD)</td>
                                        <td class="px-4 py-2 border-b text-gray-500">${{ number_format($order->amount_usd, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 border-b">Amount Paid (INR)</td>
                                        <td class="px-4 py-2 border-b text-gray-500">₹{{ number_format($order->amount_inr, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 border-b">Payment Mode</td>
                                        <td class="px-4 py-2 border-b text-gray-500">{{ $order->paymentType->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 border-b">Date and Time</td>
                                        <td class="px-4 py-2 border-b text-gray-500">{{ $order->created_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            @break

                        @default
                            <!-- Default case (optional, for unexpected statuses) -->
                            <div class="mb-4 p-4 bg-gray-100 text-gray-800 border border-gray-300 rounded-md">
                                <p>Unexpected order status. Please contact support.</p>
                            </div>
                            <!-- Show order details table for "pending" or "verified" status -->
                            <div class="mb-6 p-4 bg-blue-50 border border-blue-300 rounded-md">
                                <h3 class="font-semibold text-lg mb-4">Order Payment Details</h3>
                                <table class="min-w-full table-auto bg-white shadow-md rounded-md">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 text-left">Label</th>
                                            <th class="px-4 py-2 text-left">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Status</td>
                                            <td class="px-4 py-2 border-b text-gray-500">Not Found</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Amount Paid (USD)</td>
                                            <td class="px-4 py-2 border-b text-gray-500">${{ number_format($order->amount_usd, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Amount Paid (INR)</td>
                                            <td class="px-4 py-2 border-b text-gray-500">₹{{ number_format($order->amount_inr, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Payment Mode</td>
                                            <td class="px-4 py-2 border-b text-gray-500">{{ $order->payment_type_id }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-2 border-b">Date and Time</td>
                                            <td class="px-4 py-2 border-b text-gray-500">{{ $order->created_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    @endswitch
                @elseif($user->role == 'admin')
                    @if($order->status === 'pending')
                        <!-- Admin Action Buttons for 'new' Orders -->
                        <div class="mb-6 p-4 bg-yellow-100 border border-yellow-300 rounded-md text-yellow-800">
                            <p class="mb-4 font-semibold text-lg">Admin Action: New Order</p>
                            <form method="POST" action="{{ route('admin.console.mark') }}" class="inline-block mr-2">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition">
                                    ✅ Mark as Verified
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.console.mark') }}" class="inline-block">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="status" value="denied">
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md transition">
                                    ❌ Mark as Cancelled
                                </button>
                            </form>
                        </div>
                    @elseif($order->status === 'new')
                        <div class="mb-6 p-4 bg-blue-100 border border-blue-300 rounded-md text-blue-800">
                            <p class="font-semibold mb-2">Order Status: {{ ucfirst($order->status) }}</p>
                            <p class="text-sm">Waiting for user payment</p>
                        </div>
                    @elseif($order->status === 'completed')
                        <!-- Show success message and download link if order is "verified" -->
                        <table>
                            @if($order->transactions->isNotEmpty())
                                <tr>
                                    <td class="font-semibold">Transaction ID:</td>
                                    <td>{{ $order->transactions->last()->transaction_id }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Payment Mode:</td>
                                    <td>{{ $order->payment_type_id }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Amount Paid (USD):</td>
                                    <td>${{ number_format($order->amount_usd, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Amount Paid (INR):</td>
                                    <td>₹{{ number_format($order->amount_inr, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Date and Time:</td>
                                    <td>{{ $order->created_at->diffForHumans() }}</td>
                                </tr>

                            @endif
                        </table>
                        
                    @else
                        <!-- Show current status and basic order info if not 'new' -->
                        <div class="mb-6 p-4 bg-blue-100 border border-blue-300 rounded-md text-blue-800">
                            <p class="font-semibold mb-2">Order Status: {{ ucfirst($order->status) }}</p>
                            <p class="text-sm">No further action required.</p>
                        </div>
                    @endif
                    
                        <h3 class="font-semibold text-gray-500 text-lg mb-4">Order Payment Details</h3>
                        <table class="min-w-full table-auto bg-white shadow-md rounded-md">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">Label</th>
                                    <th class="px-4 py-2 text-left">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-2 border-b">Status</td>
                                    <td class="px-4 py-2 border-b text-blue-500">Pending Verification</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border-b">Amount Paid (USD)</td>
                                    <td class="px-4 py-2 border-b text-gray-500">${{ number_format($order->amount_usd, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border-b">Amount Paid (INR)</td>
                                    <td class="px-4 py-2 border-b text-gray-500">₹{{ number_format($order->amount_inr, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border-b">Payment Mode</td>
                                    <td class="px-4 py-2 border-b text-gray-500">
                                        {!! $order->paymentType->description ?? '' !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border-b">Date and Time</td>
                                    <td class="px-4 py-2 border-b text-gray-500">{{ $order->created_at->diffForHumans() }}</td>
                                </tr>
                            </tbody>
                        </table>
                            
                @endif
            </div>

        <!-- Right Column: Live Chat -->
           <!-- Chat Section -->
            <div class="flex flex-col bg-white rounded-xl shadow h-[420px]">
               <header class="bg-indigo-600 text-white p-4 rounded-t-xl font-semibold flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                        </span>
                        <span>💬 P2P LIVE Chat</span>
                    </div>

                    <span class="text-sm font-medium bg-white/20 px-3 py-1 rounded-md">
                        <i class="fa fa-user"></i> <span class="text-green-400 font-semibold">
                            @if($user->role == 'admin')
                                {{ $order->user->name }}
                            @else
                                Md Shariq
                            @endif
                        </span>
                    </span>
                </header>

                <div class="flex-1 overflow-y-auto p-4 space-y-4" id="chatMessages" style="scroll-behavior: smooth;">
                    <!-- Chat messages will be dynamically injected here -->
                </div>

                <!-- Chat Input Form -->
                <form id="chatForm" class="p-4 border-t border-gray-200 flex space-x-3">
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <input
                        type="text"
                        name="message"
                        id="chatInput"
                        placeholder="Type your message..."
                        class="flex-grow border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        autocomplete="off"
                        required
                    >
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                        Send
                    </button>
                </form>
            </div>

        </div>

        <div class="mt-8">

        <!-- Divider -->
        <div class="border-t border-gray-300 my-8"></div>

            <!-- FAQ Section -->
            <div class="bg-gray-100 p-6 rounded-md shadow-md">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Frequently Asked Questions (FAQ)</h3>

                <!-- What is P2P -->
                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <h4 class="text-lg font-medium text-gray-700">What is P2P?</h4>
                        <p class="text-gray-500 mt-2">
                            P2P (Person-to-Person) is a manual online purchase between individuals. It allows users to interact directly with each other in a secure environment. 
                            During a P2P transaction, you will receive live support via a chatbox, where a real human (Admin) will guide you through the process and assist with any questions you may have regarding the product.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>


<audio id="newMessageSound" src="/assets/audio/msg-snd.mp3" preload="auto"></audio>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script><script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let audioUnlocked = false;

    $(document).ready(function() {
        let isFirstLoad = true;
        let lastMessageCount = 0;
        let originalTitle = document.title;
        let if_free = '{{ $order->product->free }}';
       
        // Fetch and render chat messages
        function fetchMessages() {
            $.ajax({
                url: '/p2p/chat/{{ $order->id }}',
                method: 'GET',
                success: function(response) {
                    // let chatMessages = $('#chatMessages');
                    // chatMessages.empty(); // Clear existing messages

                    let chatMessages = $('#chatMessages');
                    let previousCount = lastMessageCount;
                    let newCount = response.length;
                    lastMessageCount = newCount;
                    chatMessages.empty();
                    let newIncoming = false;

                    // If it's the first time loading, insert the instruction message
                    if (isFirstLoad && if_free == 0) {
                        let instructionMessage = `<div class="message other">
                            Hey, Please pay ₹{{ number_format($order->amount_inr, 2) }} UPI <br> or ${{ number_format($order->amount_usd, 2) }} USDT Crypto so I can verify the purchase and enable download link.
                            <div class="timestamp">--</div>
                        </div>`;
                        chatMessages.append(instructionMessage); // Add the instruction message
                        isFirstLoad = true; // Set the flag to false after the first load
                    }
                    if( if_free == 1){
                        let instructionMessage = `<div class="message other">
                            Hey, it is free product, you can download.
                            
                        </div>`;
                        chatMessages.append(instructionMessage); // Add the instruction message
                        isFirstLoad = true; // Set the flag to false after the first load
                    }

                    // Loop through and append each existing message
                    response.forEach(function(message, index) {
                        let timestamp = new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        let messageClass = message.user.id === {{ Auth::id() }} ? 'user' : 'other'; // Check if message is from current user

                        // Check if it's a new message from another user
                        if (index >= previousCount && message.user.id !== {{ Auth::id() }}) {
                            newIncoming = true;
                        }

                        let messageDiv = `<div class="message ${messageClass}">
                            ${message.message}
                            <div class="timestamp">${timestamp}</div>
                        </div>`;
                        chatMessages.append(messageDiv);
                    });

                    if (newIncoming && audioUnlocked) {
                        const sound = document.getElementById('newMessageSound');
                        if (sound) {
                            sound.play().catch(err => {
                                console.warn('Play failed:', err);
                            });
                        }
                        // append 1 to title
                        document.title = `(${newCount - previousCount}) New Message - ${originalTitle}`;
                    }

                    // Scroll to the bottom
                    chatMessages.scrollTop(chatMessages[0].scrollHeight);
                },
                error: function() {
                    console.error("Error fetching chat messages.");
                }
            });
        }

        // Start polling for new messages every 3 seconds
        function startPolling() {
            setInterval(fetchMessages, 3000); // Poll every 3 seconds
        }

        // Send new message
        $('#chatForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '/p2p/chat/send',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#chatInput').val(''); // Clear input
                    fetchMessages(); // Fetch new messages after sending
                },
                error: function() {
                    alert('Message failed to send');
                }
            });
        });

        // Initial call to load messages
        fetchMessages();
        startPolling();
    });

   function unlockAudioIfNeeded() {
    const audio = document.getElementById('newMessageSound');
    if (!audio) return;

    audio.play().then(() => {
        audio.pause();
        audio.currentTime = 0;
        audioUnlocked = true;
        console.log('🔓 Audio unlocked by interaction.');
    }).catch(() => {
        audioUnlocked = false;
        console.warn('🔒 Audio still locked.');
    });
}

// Re-try unlocking on every user interaction
['click', 'touchstart', 'keydown'].forEach(evt => {
    document.addEventListener(evt, unlockAudioIfNeeded, { passive: true });
});

</script>


</x-app-layout>
