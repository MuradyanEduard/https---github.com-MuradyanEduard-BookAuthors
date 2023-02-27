<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CartRequest;
use App\Models\Book;


class CartController extends Controller
{

    public function add(CartRequest $request): RedirectResponse
    {
        $book = Book::where('id',$request->id)->first();
        $key = '_book'.$book->id;


        if(!(session()->has($key))){
            session($key,0);
        }

        $newCount = $request->count + session($key);

        if($book->count >= $newCount){
            session([$key => $newCount]);
        }


        return redirect()->route('book.index');
    }
    //
}
