<?php

namespace App\Jobs\Videos;

//use FFMpeg\FFMpeg; //
use FFMpeg\Format\Video\X264;
use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Filesystem\Filesystem;
//use ProtoneMedia\LaravelFFMpeg;//
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use ProtoneMedia\LaravelFFMpeg\Support\ServiceProvider;



class ConvertFormatStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $low = (new X264('aac'))->setKiloBitrate(100);  //360p
        $mid = (new X264('aac'))->setKiloBitrate(250);  //360p
        $high = (new X264('aac'))->setKiloBitrate(500);  //360p


/*        $ffmpeg = FFMpeg::create(
            array(
                'ffmpeg.binaries'  => 'C:/FFmpeg/bin/ffmpeg.exe',
                'ffprobe.binaries' => 'C:/FFmpeg/bin/ffprobe.exe',
                'timeout'          => 3600, // The timeout for the underlying process
                'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
            )
        );
        $opened = $ffmpeg->
        open(storage_path(str_replace('/','\\',$this->video->path)))
        ->exportForHLS()
        ->addFormat($low)
        ->addFormat($mid)
        ->addFormat($high)
        ->save("public/videos/{$this->video->id}/{$this->video->id}.m3u8");*/

        FFMpeg::fromDisk('local')
            ->open($this->video->path)
            ->exportForHLS()
            ->onProgress(function ($percentage) {
                $this->video->update([
                    'percentage' => $percentage
                ]);
            })
            ->addFormat($low)
            ->addFormat($mid)
            ->addFormat($high)
            ->save("public/videos/{$this->video->id}/{$this->video->id}.m3u8");
    }
}
