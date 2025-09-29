<x-app-layout>

@php
    $breadcrumbItems = [
        ['label' => 'Home', 'url' => url('/')],
        ['label' => $product->category->name, 'url' => url('products/' . $product->category->slug)],
        ['label' => $product->name],
    ];
@endphp

<x-slot name="breadcrumb">
    <x-breadcrumb :items="$breadcrumbItems" />
</x-slot>

<section class="bg-gradient-to-br rounded-xl from-white to-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-6 grid md:grid-cols-5 gap-12 items-start">

        {{-- Left: Product Image + Info (3/5 width) --}}
        <div class="md:col-span-3 space-y-8">

            <div class="grid grid-cols-3 gap-6">

                {{-- YouTube Video --}}
                <div class="col-span-2 aspect-w-16 aspect-h-9 rounded-xl overflow-hidden shadow-lg">
                    <iframe
                        src="{{ $product->youtube_url }}"
                        title="YouTube video player"
    frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
    allowfullscreen
    class="w-full h-full"
    loading="lazy"
                    ></iframe>
                </div>

               
                {{-- Photo Thumbnails --}}
<div x-data="gallery()" class="col-span-1 space-y-4">
    <div class="grid grid-cols-2 gap-2">
        @php
            $screenshots = json_decode($product->screenshots, true) ?? [];
        @endphp
        @foreach($screenshots as $screenshot)
            <button @click="open('{{ $screenshot }}')" class="block rounded-lg overflow-hidden border hover:ring-2 hover:ring-indigo-500 transition">
                <img 
                    src="{{ $screenshot }}" 
                    alt="Thumbnail" 
                    class="w-full h-28 object-cover"
                    loading="lazy"
                >
            </button>
        @endforeach
    </div>

    {{-- Modal Popup --}}
    <div
        x-show="isOpen"
        style="display: none;"
        class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
        @click.self="close()"
    >
        <div class="relative max-w-3xl max-h-[80vh]">
            <button @click="close()" class="absolute top-2 right-2 text-white text-3xl font-bold hover:text-gray-300">&times;</button>
            <img :src="currentImage" alt="Expanded photo" class="rounded-lg max-w-full max-h-[80vh] object-contain shadow-lg">
        </div>
    </div>
</div>


            </div>

            {{-- Product Info --}}
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>

                <div class="flex items-center justify-between mb-4">
                    <span class="text-2xl font-semibold text-green-600">${{ number_format($product->price_usd, 2) }}</span>
                    <div class="flex items-center space-x-1 text-yellow-500">
                        {{-- Dynamic star ratings --}}
                        @for ($i = 0; $i < 5; $i++)
                            <x-heroicon-s-star class="w-5 h-5 {{ $i < $product->rating ? 'text-yellow-500' : 'text-gray-300' }}" />
                        @endfor
<span class="ml-2 text-sm text-gray-500">
    ({{ $product->reviews && $product->reviews->isNotEmpty() ? $product->reviews->count() : 'No' }} Reviews)
</span>

                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center space-x-4">
                    <a
                        href="{{ route('p2p.view', ['id' => $product->id]) }}"
                        class="px-6 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition"
                    >
                        Get Now
                    </a>

                    <a
                        href="{{ $product->demo_url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="px-6 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-700 transition"
                    >
                        Live Demo
                    </a>

                    <a href="#" class="text-sm text-red-600 hover:underline">Report</a>
                </div>

                {{-- Divider --}}
                <hr class="my-8 border-gray-300" />

                {{-- Product Details Cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">

                    {{-- Tech Support Card --}}
                    <div class="bg-white border rounded-lg p-4 flex items-center space-x-4 shadow-sm">
                        <x-heroicon-o-cpu-chip class="w-8 h-8 text-indigo-600" />
                        <div>
                            <h3 class="font-semibold text-gray-700">Tech Support Available</h3>
                            <p class="text-green-600 font-medium">{{ $product->tech_support }}</p>
                        </div>
                    </div>

                    {{-- Custom Modifications Card --}}
                    <div class="bg-white border rounded-lg p-4 flex items-center space-x-4 shadow-sm">
                        <x-heroicon-o-wrench-screwdriver class="w-8 h-8 text-indigo-600" />
                        <div>
                            <h3 class="font-semibold text-gray-700">Custom Modifications</h3>
                            <p class="text-gray-700">{{ $product->custom_mods }}</p>
                        </div>
                    </div>

                    {{-- License Details Card --}}
                    <div class="bg-white border rounded-lg p-4 shadow-sm">
                        <h3 class="font-semibold text-gray-700 mb-2 flex items-center space-x-2">
                            <x-heroicon-o-document-text class="w-6 h-6 text-indigo-600" />
                            <span>License Details</span>
                        </h3>
                        {!! $product->license !!}
                    </div>

                </div>

                {{-- Additional Product Descriptions --}}
                <div class="prose max-w-none text-gray-700">
                    <h2 class="text-2xl font-semibold mb-4">Product Description</h2>
                    <p>{!! $product->description_lt !!}</p>
                    
                </div>

            </div>

        </div>

        {{-- Right: Comments Sidebar (2/5 width) --}}
        <aside x-data="commentReply()" class="md:col-span-2 bg-white shadow rounded-xl p-4 h-[980px] overflow-hidden sticky flex flex-col">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">💬 Comments</h3>

            {{-- Add Comment Box --}}
            <form action="{{ route('comments.store', $product) }}" method="POST" class="mb-4">
                @csrf
                <textarea
                    rows="2"
                    name="content"
                    placeholder="Write a comment..."
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500 resize-none"
                ></textarea>
                <div class="text-right mt-2">
                    <button type="submit" class="px-4 py-1 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                        Post
                    </button>
                </div>
            </form>

            {{-- Scrollable Comment List --}}
            <div class="overflow-y-auto pr-1 space-y-2 flex-1">
                @if($comments )
                @foreach($comments as $review)
                    <div class="bg-gray-50 p-3 rounded-md border">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-gray-400"> {{ $review->user->name }}</span>
                            <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">{{ $review->content }}</p>

                        {{-- Replies --}}
                        @foreach($review->replies as $reply)
                        
                            <div class="ml-4 space-y-2 border-l pl-4">
                                <div class="bg-white p-2 rounded-md border text-sm">
                                    <div class="flex justify-between">
                                        <span class="font-medium text-gray-400">{{ $reply->user->name }}</span>
                                        <span class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-600 mt-1">{{ $reply->content }}</p>
                                </div>
                            </div>
                        @endforeach
                        @if(auth()->check() && (auth()->id() === $review->user_id || auth()->user()->role === 'admin'))
                           <button
                                @click.prevent="toggleReplyForm({{ $review->id }})"
                                class="text-indigo-600 text-sm hover:underline"
                            >
                                Reply
                            </button>

                            <!-- Inline reply form -->
                            <div x-show="openReplyFormId === {{ $review->id }}" x-transition class="mt-2">
                                <form action="{{ route('comments.store', $product) }}" method="POST" @submit.prevent="submitReply($event.target)">
                                    @csrf
                                    <textarea
                                        name="content"
                                        x-model="replyContent"
                                        rows="3"
                                        required
                                        class="w-full border border-gray-300 rounded-md p-2 resize-none"
                                        placeholder="Write your reply..."
                                    ></textarea>
                                    <input type="hidden" name="parent_id" value="{{ $review->id }}">
                                    <div class="mt-2 flex justify-end space-x-2">
                                        <button type="button" @click="closeReplyForm()" class="px-3 py-1 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                                        <button type="submit" class="px-3 py-1 rounded bg-indigo-600 text-white hover:bg-indigo-700">Post Reply</button>
                                    </div>
                                </form>
                            </div>

                        @endif
                    </div>
                    
                @endforeach
                @endif
            </div>
            <!-- comments paginate -->
                    <div class="mt-6 flex justify-center">
                        {{ $comments->onEachSide(1)->links('components.pagination.custom') }}
                    </div>
        </aside>

    </div>
</section>

<script>
    function gallery() {
        return {
            isOpen: false,
            currentImage: '',
            open(src) {
                this.currentImage = src;
                this.isOpen = true;
            },
            close() {
                this.isOpen = false;
                this.currentImage = '';
            }
        }
    }
</script>
<script>
    function commentReply() {
        return {
            openReplyFormId: null,
            replyContent: '',

            toggleReplyForm(commentId) {
                if (this.openReplyFormId === commentId) {
                    this.openReplyFormId = null;
                    this.replyContent = '';
                } else {
                    this.openReplyFormId = commentId;
                    this.replyContent = '';
                }
            },
            closeReplyForm() {
                this.openReplyFormId = null;
                this.replyContent = '';
            },
            submitReply(form) {
                form.submit();
            }
        }
    }
</script>

</x-app-layout>
