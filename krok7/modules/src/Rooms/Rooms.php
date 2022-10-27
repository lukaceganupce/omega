<?php

namespace Modules\Rooms;

use App\Db;
use App\Dispatcher;
use App\Event;

class Rooms
{
    protected $db;
    protected $dispatcher;

    public function __construct(Db $db, Dispatcher $dispatcher)
    {
        $this->db = $db;
        $this->dispatcher = $dispatcher;
    }

    public function readRooms() {


        $conn = $this->db->getConn();

        $sql = 'SELECT * FROM rooms';

        $result = $conn->query($sql);

        if (!$result) {
            printf ("Error message> %s\n", $conn->error);
        }

        $rooms =[];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $rooms [] = [
                    'room_id' => $row['room_id'],
                    'room_name' => $row ['room_name']
                ];
            }
        }
        $conn->close();

        return $rooms;
    }

    public function readRoom ($id) {
        $conn = $this->db->getConn();

        $sql = 'SELECT * FROM  rooms WHERE room_id = '. $id;

        $result = $conn->query($sql);

        if (!$result) {
            printf ("Error message> %s\n", $conn->error);
        }

        $rooms =[];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $rooms [] = [
                    'room_id' => $row['room_id'],
                    'room_name' => $row ['room_name']
                ];
            }
        }
        $conn->close();

        return $rooms;
    }

}