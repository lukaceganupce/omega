<?php

namespace Modules\Rooms;

use App\Db;

class Rooms
{
    protected $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
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