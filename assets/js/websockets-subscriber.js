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