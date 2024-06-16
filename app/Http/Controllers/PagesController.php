<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;


class PagesController extends Controller
{
    public function index () {
        $title = 'Welcome To Laravel!';
        return view('pages.index')->with('title', $title);
    }

    public function about () {
        $title = 'About';
        return view('pages.about')->with('title', $title);
    }

    public function services () {
        $data = array(
            'title' => 'Services',
            'services' => ['Web Desgin', 'Programming', 'SEO']
        );
        return view('pages.services')->with($data);
    }
}
