<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrdersBook;
use App\Models\Book;
use App\Models\User;
use Session;

class OrderController extends Controller
{
    public function add(OrderRequest $request): RedirectResponse
    {
        $book = Book::where('id', $request->id)->first();
        $key = $book->id;

        $basket = Session::get('basket');

        if (!$basket) {
            $basket = [];
            Session::push('basket', $basket);
        }


        if (!isset($basket[$key])) {
            $basket[$key] = [
                'id' => $book->id,
                'count' => 0,
                'price' => $book->price,
                'title' => $book->title
            ];
        }

        $newCount = $request->count + $basket[$key]['count'];


        if ($book->count >= $newCount) {
            $basket[$key]['count'] = $newCount;
            Session::put('basket', $basket);
        }

        return redirect()->route('book.index');
    }

    public function remove(Request $request): RedirectResponse
    {
        $book = Book::where('id', $request->id)->first();

        $basket = Session::get('basket');
        $key = $book->id;

        unset($basket[$key]);
        Session::put('basket', $basket);


        return redirect()->route('book.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $basket = Session::get('basket');

        $order = Order::create([
            'author_id' => Auth::user()->id,
            'price' => 0
        ]);

        $sum = 0;
        foreach ($basket as $book) {
            $order_book = OrdersBook::create([
                'book_id' => $book['id'],
                'count' => $book['count'],
                'order_id' => $order->id
            ]);

            $newBook = Book::where('id', $book['id'])->first();
            $newCount = $newBook->count - $book['count'];
            $newBook->update(['count' => $newCount]);

            $sum += $book['price'];


            // dd($order->book_id);
        }

        $order->price = $sum;
        $order->save();

        Session::forget('basket');

        return redirect()->route('book.index');
    }

    public function index()
    {
        // $order = Order::with('author')->first();

        if (Auth::user()->role == User::ROLE_CUSTOMER) {
            $orders = Order::with('books')->with('author')->with('orders_books')->where('author_id', Auth::user()->id)->paginate(6);
            return view('order.index', ['orders' => $orders]); //->with('message', 'Book successfully updated!');
        } else {
            $orders = Order::with('books')->with('author')->with('orders_books')->paginate(6);
            return view('order.index', ['orders' => $orders]); //->with('message', 'Book successfully updated!');
        }

    }

}
