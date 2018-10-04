<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelLocalization;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
	
	public function checkuser()
	{
		return 'check user function';
	}

    public function switch_lang($locale, $url)
    {
        $default_url = str_replace('_', '/', $url);
        $current_locale = substr($default_url, 0, 4);
        $url = str_replace($current_locale, "/" . $locale . "/", $default_url);
        // dd([ $default_url, $current_locale, $url ]);
        LaravelLocalization::setLocale($locale);
        return redirect($url)->with('switch_lang', $url);
    }
}
