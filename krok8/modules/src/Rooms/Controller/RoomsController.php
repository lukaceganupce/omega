<?php


namespace Modules\Rooms\Controller;


use App\Db;
use App\Dispatcher;
use Modules\Rooms\Model\Rooms;
use App\View;

class RoomsController
{
    private $db;
    private $dispatcher;

    public function __construct(Db $db, Dispatcher $dispatcher)
    {
        $this->db =$db;
        $this->dispatcher = $dispatcher;
    }

    public function readRooms () {

        $roomsModel = new Rooms($this->db, $this->dispatcher);
        $rooms = $roomsModel->readRooms();

        $view = new View();
        $view->setScript('./modules/src/Rooms/View/rooms/readRooms.phtml');
        return $view->render(['rooms'=>$rooms]);

    }

    public function readRoom () {

    }

}