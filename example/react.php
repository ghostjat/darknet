<?php
require __DIR__.'/../vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use darknet\core;

/**
 * Description of react
 *
 * @author ghost
 */
class reactApp implements MessageComponentInterface {
    protected $client, $objDetc;
    
    public function __construct() {
        $this->client = new \SplObjectStorage();
        $this->yolo();
    }

    public function onClose(ConnectionInterface $conn) {
        $this->client->detach($conn);
        echo "Connection closed for CID:-> {$conn->resourceId}\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An Error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->client as $client) {
            if($from !== $client) {
                if(!is_null($msg)){
                    $this->objDetc->remotePR($client,$msg);
                }
                else {
                    $data = ['id' => $from->resourceId, 'msg' => $msg];
                    $client->send(json_encode($data));
                }
            }
        }
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->client->attach($conn);
        echo "New connection for CID:-> ({$conn->resourceId})\n";
    }
    
    protected function yolo() {
        return $this->objDetc = new core(core::MOBILE_NET_V2_VOC,core::DATA_VOC);
    }

}

$server = IoServer::factory(
	new HttpServer(
		new WsServer(
			new reactApp()
		)
	),8080,'0.0.0.0');
$server->run();
