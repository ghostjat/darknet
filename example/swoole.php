<?php

require '../vendor/autoload.php';

if (!extension_loaded('swoole')) {
    dl('swoole.so');
}

use darknet\core;

$dn = new core(core::YOLOFASTEST);

$server = new Swoole\WebSocket\Server("0.0.0.0", 8080);

$server->on("start", function (Swoole\WebSocket\Server $server) {
    echo "Swoole WebSocket Server is started at ws://0.0.0.0:8080\n";
});

$server->on('open', function(Swoole\WebSocket\Server $server, Swoole\Http\Request $request) {
    echo "connection open: {$request->fd}\n";
});

$server->on('message', function(Swoole\WebSocket\Server $server, Swoole\WebSocket\Frame $frame) use($dn) {
    echo "received: " . strlen($frame->data) . " bytes\n";
    foreach ($server->getClientList(0) as $client) {
        if ($frame->fd !== $client) {
            if ($dn->base64ImgDecode($frame->data) !== null) {
                $dn->remotePR($client, $frame, $server);
            }
        }
    }
});

$server->on('close', function(Swoole\WebSocket\Server $server, int $fd) {
    echo "connection close: {$fd}\n";
});

$server->start();
