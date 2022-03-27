<?php

session_start();


$incomingData = explode('/', $_GET['getApi']);

//var_dump($incomingData);

//nie wiem dla czego JSON nie działa poprawnie przy podpięciu klasy
//include_once 'Radio.php';

class Radio{
    private $status = 'off';
    private $mode = 'AM';
    private $chanel = '';
    private $favoriteChannels = [];

    public function turn() : string{
        if ($this->status == 'on'){
            $this->status= 'off';
        } else {
            $this->status='on';
        }
        return $this->status;
    }

    public function mode() : string{
        if ($this->mode == 'FM'){
            $this->mode= 'AM';
        } else {
            $this->mode='FM';
        }
        return $this->mode;
    }

    public function randomMode() :int{
        if ($this->mode == 'FM'){
            $rand = rand(88,108);
        } else {
            $rand = rand(100,1600);
        }
        return $rand;
    }

    public function setChanel(string $chanel) : string{
        if($chanel){
            return $this->chanel = $chanel;
        } else {
            return 'Prosze wpisać cęstotliwość';
        }

    }

    public function saveToFavorite(string $chanel) :string {
        $this->favoriteChannels[] = $chanel;
        return 'Częstotliwość zapisana';
    }

    public function getFavoriteChanels(): array
    {
        return $this->favoriteChannels;
    }

}

//nie wiem czy muszę to przekazywać ale na wszelki wypadek dorobiłem
function setResponse($header){
    header($header);
    $_SESSION['radio']['endpoint'] = 'status ' . $_SERVER['SERVER_PROTOCOL'] .' ' . http_response_code();
}

//create radio if it was firs initializations
if(empty($_SESSION['$obj'])){
    $_SESSION['$obj'] = new Radio();
}
$obj = $_SESSION['$obj'];

switch ($incomingData[1]){
    case 'turnRadio':
        $_SESSION['radio']['status'] = $obj->turn();
        setResponse('HTTP/1.0 200 OK');
        break;
    case 'changeMode':
        $_SESSION['radio']['mode'] = $obj->mode();
        setResponse('HTTP/1.0 200 OK');
        break;
    case 'searchChanel':
        $_SESSION['radio']['rand'] = $obj->randomMode();
        setResponse('HTTP/1.0 200 OK');
        break;
    case 'chanelName':
        $_SESSION['radio']['setChanel'] = $obj->setChanel($incomingData[2]);
        setResponse('HTTP/1.0 200 OK');
        break;
    case 'saveToFavorite':
        $_SESSION['radio']['mess'] = $obj->saveToFavorite($incomingData[2]);
        setResponse('HTTP/1.0 200 OK');
        break;
    case 'getFavorite':
        $_SESSION['radio']['favorite'] = $obj->getFavoriteChanels();
        setResponse('HTTP/1.0 200 OK');
        break;
    case 'setFavorite':
        $_SESSION['radio']['setFavorite'] = $obj->setChanel($incomingData[2]);
        setResponse('HTTP/1.0 200 OK');
        break;
    default:
        setResponse('HTTP/1.0 404 Not Found');
        break;
}

echo json_encode($_SESSION['radio'] ?? '');

//change radio status
//if($_POST['status'] ?? ''){
//    $_SESSION['radio']['status'] = $obj->turn();
//}

//change mode status
//if($_POST['mode'] ?? ''){
//    $_SESSION['radio']['mode'] = $obj->mode();
//}

//search chanel
//if($_POST['rand'] ?? ''){
//    $_SESSION['radio']['rand'] = $obj->randomMode();
//}

//set chanel
//if($_POST['chanelName'] ?? ''){
//    $_SESSION['radio']['setChanel'] = $obj->setChanel($_POST['chanelName']);
//}

//save chanel
//if($_GET['save'] ?? ''){
//    $_SESSION['radio']['mess'] = $obj->saveToFavorite($_GET['save']);
//}

//show favorite channels
//if($_GET['save'] ?? ''){
//    $_SESSION['radio']['favorite'] = $obj->getFavoriteChanels();
//}

//set favorite
//if($_GET['setFavorite'] ?? ''){
//    $_SESSION['radio']['setFavorite'] = $obj->setChanel($_GET['setFavorite']);
//}


?>


