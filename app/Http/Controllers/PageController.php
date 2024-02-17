<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    function index() {
    //    $contacts =  Message::select('phone', DB::raw('MAX(body) as body'), DB::raw('MAX(name) as name'), DB::raw('MAX(created_at) as created_at'))->groupBy('phone')->get();
        return view('chat');    
    }
}
