<?php namespace Athov\Ratchet\Classes;

use Ratchet\ConnectionInterface;
use Askedio\LaravelRatchet\RatchetWsServer;

class SimplePusher extends RatchetWsServer
{

    // Data from ZeroMQ / Broadcasting
    public function onEntry($entry)
    {
        $data = json_decode($entry[1], true);
        $this->sendAll(json_encode([
            'channel' => $entry[0],
            'event' => $data['event'],
            'data' => $data['payload']
        ]));
    }

}