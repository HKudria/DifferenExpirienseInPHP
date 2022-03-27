<?php

session_start();

?>


<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Radio</title>
</head>
<body>
<form method="POST" >
    <input class="statusButton" type="button" value="Włączenie/wyłączenie radia">
    <label id="statusLabel">Radio wyłączone</label>
</form>
<table class="showRadioControl">
    <tr>
        <td>
            <form method="post">
                <input class="modeButton" type="button" value="Przełączanie miedzy FM i AM">
                <label id="modeLabel">FM</label>
                <label id="chanelLabel">93.00</label>
            </form>
        </td>
        <td>
            <form method="post">
                <input class="randomChanelButton" type="button" value="Przeszukiwanie częstotliwości">
            </form>
        </td>
    </tr>
    <tr>
        <td>
            <form method="post">
                <input type="number" id="chanelName" name="chanelName">
                <input class="setChanelButton" type="button" value="Ustawienie częstotliwości">
            </form>
        </td>
        <td>
            <form method="post">
                <input class="saveChanelButton" type="button" value="Zapisanie częstotliwości do ulubionych">
            </form>
        </td>
        <td>
            <form method="post">
                <input class="readChanelButton" type="button" value="Wczytanie ulubionych">
            </form>
        </td>
    </tr>
    <tr>
        <td>
            <form method="post" class="favoriteChanel">
                <select id="fChanel"></select>
                <input class="selectChanelButton" onclick="getValue()" type="button" value="Wybranie ulubionego kanału">
            </form>
        </td>
    </tr>
</table>

<h3 class="messageClass" id="showMessage"></h3>

<h4 class="showResponse" id="showResponse"></h4>
<script src="script.js"></script>
</body>


</html>
