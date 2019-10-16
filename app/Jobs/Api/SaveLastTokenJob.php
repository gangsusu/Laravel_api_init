<?php

namespace App\Jobs\Api;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveLastTokenJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $model;
    protected $token;

    /**
     * Create a new job instance.
     *
     * @param mixed $model
     * @param mixed $token
     */
    public function __construct($model, $token)
    {
        $this->model = $model;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $this->model->last_token = $this->token;
        $this->model->save();
    }
}
