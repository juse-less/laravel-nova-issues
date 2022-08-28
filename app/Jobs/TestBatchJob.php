<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TestBatchJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        // TODO: Check output
        $this->logBatchableDetails(__METHOD__);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // TODO: Check output
        $this->logBatchableDetails(__METHOD__);
    }

    protected function logBatchableDetails(string $methodFqn): void
    {
        // TODO: Check output
        Log::info("Checking Batchable in [{$methodFqn}]", [
            'batchId' => $this->batchId,
            'batching' => $this->batching(),
            'batch' => $this->batch(),
        ]);
    }
}
