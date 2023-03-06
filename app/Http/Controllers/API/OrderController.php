<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\OrderRequest;
use App\Models\Order;
use App\Models\OrdersBook;
use App\Models\Book;
use App\Models\User;
use Inertia\Inertia;
use Session;

class OrderController extends Controller
{
    public function __construct()
    {
        // $this->middleware('check.api.order', ['except' => ['index']]); //only
    }
    // public function add(OrderRequest $request)
    // {
    //     $book = Book::where('id', $request->id)->first();
    //     $key = $book->id;

    //     $basket = Session::get('basket');

    //     if (!$basket) {
    //         $basket = [];
    //         Session::push('basket', $basket);
    //     }


    //     if (!isset($basket[$key])) {
    //         $basket[$key] = [
    //             'id' => $book->id,
    //             'count' => 0,
    //             'price' => $book->price,
    //             'title' => $book->title
    //         ];
    //     }

    //     $newCount = $request->count + $basket[$key]['count'];


    //     if ($book->count >= $newCount) {
    //         $basket[$key]['count'] = $newCount;
    //         Session::put('basket', $basket);
    //     }

    //     return response()->json(['user' => Auth::user(), 'messages' => ['Book add to basket!'], 'basket' => $basket["3"]], 201);
    // }

    // public function remove(Book $book)
    // {

    //     $basket = Session::get('basket');
    //     $key = $book->id;

    //     unset($basket[$key]);
    //     Session::put('basket', $basket);

    //     return response()->json(['user' => Auth::user(), 'messages' => ['Book removed from basket!']], 201);
    // }

    // public function getBasket()
    // {
    //     $basket = Session::get('basket');
    //     return response()->json(['user' => Auth::user(), 'basket' => $basket], 201);

    // }
    // public function store(Request $request)
    // {
    //     $basket = Session::get('basket');

    //     if (!$basket)
    //         return redirect()->route('order.index');

    //     $order = Order::create([
    //         'author_id' => Auth::user()->id,
    //         'price' => 0
    //     ]);

    //     $sum = 0;
    //     foreach ($basket as $book) {
    //         $order_book = OrdersBook::create([
    //             'book_id' => $book['id'],
    //             'count' => $book['count'],
    //             'order_id' => $order->id
    //         ]);

    //         $newBook = Book::where('id', $book['id'])->first();
    //         $newCount = $newBook->count - $book['count'];
    //         $newBook->update(['count' => $newCount]);

    //         $sum += $book['price'];
    //     }

    //     $order->price = $sum;
    //     $order->save();

    //     Session::forget('basket');

    //     return response()->json(['user' => Auth::user(), 'messages' => ['Order succsessfuly created!']], 201);
    // }

    public function index()
    {
        $orders = null;

        if (Auth::user()->role == User::ROLE_CUSTOMER) {
            $orders = Order::with('books')->with('author')->with('orders_books')->where('author_id', Auth::user()->id)->paginate(6);
        } else {
            $orders = Order::with('books')->with('author')->with('orders_books')->paginate(6);
        }

        return response()->json(['orders' => $orders, 'user' => Auth::user()], 201);
    }
}