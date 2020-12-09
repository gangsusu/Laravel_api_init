<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Queue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $id;
    private $title;

    /**
     * Create a new job instance.
     *
     * @param $id
     * @param $title
     */
    public function __construct($id,$title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo 'id =='. $this->id;

        app('log')->info('id ===>'. $this->id. ' title ====>' . $this->title);
    }
}
