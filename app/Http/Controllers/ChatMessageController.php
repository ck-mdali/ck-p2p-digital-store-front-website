<?php
namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
{
    // Store a new message
    public function send(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'message' => 'required|string|max:255',
        ]);

        $order = Order::findOrFail($request->order_id);

        if ($order->user_id != Auth::id() && Auth::user()->role != 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Save the message
        $message = new ChatMessage();
        $message->order_id = $order->id;
        $message->user_id = Auth::id();
        $message->message = $request->message;
        $message->save();

        return response()->json(['success' => 'Message sent']);
    }

    // Get messages for a specific order
    public function fetchMessages($order_id)
    {
        $messages = ChatMessage::where('order_id', $order_id)
            ->with('user') // Assuming you want to load the user who sent the message
            ->orderBy('created_at', 'asc')
            ->limit(20)
            ->get();

        return response()->json($messages);
    }
}
