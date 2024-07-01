<?php

namespace App\Jobs;

use App\Models\Posts;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class addVisitor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $response = Http::post(env('VISITOR_API') . '/api/visitors', $this->data);

        if ($response->json('status') == 'success' && $this->data['post_id'] != '' && $response->json('performed') == 'create') {
            Posts::where('post_id', $this->data['post_id'])->update(['visit' => DB::raw('visit+1')]);
        }

    }
}
