<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   //al utilizar order by se debe usar el get o el paginate para que saque todos los registros
        $images = Image::orderBy('id', 'desc')->paginate(5);

        return view('home', [
            'images' => $images
        ]);
    }
}
