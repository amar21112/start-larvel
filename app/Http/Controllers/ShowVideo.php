<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowVideo extends Controller
{

    //
    public function getVideo()
    {
        $video = Video::first();
        event(new VideoViewer($video));
        return view('video')->with('video', $video);
    }
}
