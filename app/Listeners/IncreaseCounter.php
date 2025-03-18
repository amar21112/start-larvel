<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use App\Models\Viewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        $video = $event->getVideo();
        $this->updateViewer($video);
    }

    public function updateViewer($video){
        $user_id = Auth::id();
        $video_id = $video->id;

        $isView = Viewer::where('user_id', $user_id)->where('video_id', $video_id)->first();
        if(!$isView){
            $video->viewer =$video->viewer + 1;
            Viewer::create(['user_id'=>$user_id,'video_id'=>$video_id]);
        }

        $video->save();
    }
}
