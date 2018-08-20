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
        $client = new Client();

        $this->order->attendees->each(function($attendee) {

            Log::info(sprintf('Attempting to subscribe %s %s <%s> to mailing list...', $attendee->first_name, $attendee->last_name, $attendee->email));

            $res = Sendy::subscribe([
                'name' => $attendee->first_name,
                'email' => $attendee->email,
                'referrer' => config('app.url'),
                'gdpr' => 'true',
            ]);

            Log::info(sprintf('%s: %s', $res['status'] ? 'Success' : 'Error', $res['message']));
        });
    }
}
