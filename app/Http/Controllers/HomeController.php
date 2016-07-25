<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepository;
use App\Repositories\ShelfRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $shelves;
    protected $users;
    protected $books;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ShelfRepository $shelves, UserRepository $users, BookRepository $books)
    {
        $this->middleware('auth', ['except' => [
            'index'
        ]]);
        // get the Mixpanel class instance, replace with your project token
        $this->mp = \Mixpanel::getInstance(env("MIXPANEL_TOKEN"));
        $this->shelves = $shelves;
        $this->users = $users;
        $this->books = $books;

    }

    public function index()
    {

        // track an event
        $this->mp->track("Visited Home Page");
        $shelves = $this->shelves->ourPicks();
        $users = $this->users->ourPicks();
        $books = $this->books->getMostSaved();
        return view('home', [
            'shelves' => $shelves->toArray(),
            'users' => $users->toArray(),
            'mostSavedBooks' => $books,
        ]);
    }

    public function welcome(Request $request)
    {
        return view('welcome', ['user' => $request->user()]);
    }

    public function landing()
    {
        return view('landing');
    }

}
