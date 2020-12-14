<?php namespace Athov\Ratchet\Classes\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ExampleRatchetEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $channels = [];

    private $data = [];

    /**
     * Create a new event instance.
     *
     * @param string|array $channels
     * @param array $data
     */
    public function __construct($channels, $data = [])
    {
        if( is_string($channels)) {
            $channels = [$channels];
        }

        $this->channels = $channels;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        $channels = [];
        foreach ($this->channels as $channel) {
            $channels[] = new Channel($channel);
        }
        return $channels;
    }

    public function broadcastAs()
    {
        return 'example.ratchet.event';
    }

    public function broadcastWith()
    {
        return $this->data;
    }
}