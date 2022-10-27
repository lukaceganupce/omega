<?php

switch ($_SERVER['REQUEST_URI']){
    case '/page1': include ('../app/src/page1.php'); break;
    case '/page2': include ('../app/src/page2.php'); break;
    default: 'Cestu neznám';
}
