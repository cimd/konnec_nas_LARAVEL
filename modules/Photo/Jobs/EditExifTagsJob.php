<?php

namespace App\Models\Jobs;

use App\Services\ExifTool;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EditExifTagsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $photo;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Photo $photo, Request $request)
    {
        $this->photo = $photo;
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $result = ExifTool::photo($this->photo)->edit($request->all())->save();
    }
}
