# Ratchet plugin
Websocket broadcasting for OctoberCMS.

## Requirements
* PHP >= 7.1
* ZMQ extension for PHP
    * https://pecl.php.net/package/zmq
    * https://www.php.net/manual/en/zmq.setup.php

## Configuration
* Go to "config/broadcasting.php"
    * Change driver to zmq
        ```
        'default' => 'zmq'
        ```
    * Add new driver to connections
        ```
        'connections' => [
            ...

            'zmq' => [
                'driver' => 'zmq',
            ],
        ],
        ```
## How to start
```
php artisan ratchet:serve --driver=WsServer -z
```
## Examples
* Broadcasting : plugins/athov/ratchet/controllers/TestEvents.php
    ```
    broadcast(new ExampleRatchetEvent('test', [
        'title' => 'Test',
        'message' => 'Test',
        'type' => 'info'
    ]));
    ```
* Event : plugins/athov/ratchet/classes/events/ExampleRatchetEvent.php
    ```
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
    ```
* JavaScript Subscriber : plugins/athov/ratchet/assets/js/websockets-subscriber.js
    ```
     if(!("WebSocket" in window)){
        console.log('WebSocket not supported.')
    }else{
        //The browser supports WebSockets

        function connect(host)
        {
            let socket;
            try{
                socket = new WebSocket(host);

                socket.onmessage = function(msg) {

                    const json = JSON.parse(msg.data);

                    if(json.event === 'example.ratchet.event') {

                        if(json.channel === 'test')
                        {
                            console.log(json);
                        }

                    }

                }

            } catch(exception) {
                console.error(exception);
            }

            window.addEventListener('beforeunload', function (e) {
                socket.close();
            });

        }//End connect

    }//End else
    ```
## Additional Information
https://github.com/Askedio/laravel-ratchet