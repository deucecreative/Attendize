<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Models\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;
use Sendy;

class SubscribeAttendeesToMailingList extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->order->attendees->each(function($attendee) {

            Log::info(sprintf('Attempting to subscribe %s %s <%s> to mailing list...', $attendee->first_name, $attendee->last_name, $attendee->email));

            $data = Sendy::subscribe([
                'email' => $attendee->email,
                'name' => $attendee->first_name,
                'referrer' => config('app.url'),
                'gdpr' => 'true',
            ]);

            $response = Sendy::subscribe($data);

            Log::info(sprintf('%s: %s', $response['status'] ? 'Success' : 'Error', $response['message']), $data);
        });
    }
}
