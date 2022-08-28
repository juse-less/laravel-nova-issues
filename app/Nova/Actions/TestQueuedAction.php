<?php

namespace App\Nova\Actions;

use App\Jobs\TestBatchJob;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\PendingBatch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Contracts\BatchableAction;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class TestQueuedAction extends Action implements BatchableAction, ShouldQueue
{
    use Batchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        // TODO: Check output
        $this->logBatchableDetails(__METHOD__);
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        // TODO: Check output
        $this->logBatchableDetails(__METHOD__);

        if ($this->batching()) {
            $this->batch()->add(new TestBatchJob);
        }

        $actionName = __CLASS__;

        return Action::message("The [$actionName] has been run");
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }

    /**
     * Register `then`, `catch` and `finally` event on batchable job.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Bus\PendingBatch  $batch
     * @return void
     */
    public function withBatch(ActionFields $fields, PendingBatch $batch)
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

            // This one does have a value,
            //   as it's Nova's internal actions_events.batch_id.
            'actionBatchId' => $this->actionBatchId,
        ]);
    }
}
