<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    function  mostrar_videos()
    {
        return view('admin.videos');
    }
}
