<?php

@session_start();

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    http_response_code(400);
    exit;
}

$start = microtime(true);
if (!isset($_SESSION['arr'])) $_SESSION['arr'] = array();
date_default_timezone_set('Europe/Moscow');

if (!is_numeric(str_replace(",",".", $_GET["X"])) ||
    !is_numeric(str_replace(",",".", $_GET["Y"])) ||
    !is_numeric(str_replace(",",".", $_GET["R"])) ||
    (((substr($_GET["R"],0,1)==="1") || (substr($_GET["R"],0,1)==="5")) &&
    strlen($_GET["R"])>10) ||
    (((substr($_GET["Y"],0,1)==="3") || (substr($_GET["Y"],0,2)==="-6")) &&
    strlen($_GET["Y"])>10) ||
    (((substr($_GET["X"],0,2)==="-4") || (substr($_GET["X"],0,1)==="5")) &&
    strlen($_GET["X"])>10))
{
    http_response_code(400);
    exit;
}

$x = (double) str_replace(",",".", $_GET["X"]);
$y = (double) str_replace(",",".", $_GET["Y"]);
$r = (double) str_replace(",",".", $_GET["R"]);
$check="";
$currentTime = date("H:i:s");

if ($x<-3 || $x>5 || $y>=3 || $y<=-5 || $r<=2 || $r>=5) {
    http_response_code(400);
    exit;
}

echo "<table id='resultTable'>
            <tr>
                <td>X</td>
                <td>Y</td>
                <td>R</td>
                <td>Результат</td>
                <td>t сейчас</td>
                <td>t выполнения</td>
            </tr>";


    if (
    ($x >= 0 && $y >= 0 && $y <= ($r / 2) && $x <= $r) ||
    ($x <= 0 && $y >= 0 && ($x * $x + $y * $y) <= ($r / 2) * ($r / 2)) ||
    ($x >= 0 && $y <= 0 && $y >= $x - $r)
    )
    $check = "TRUE";
    else
    $check = "FALSE";
    $time = microtime(true) - $start;
    array_push ($_SESSION['arr'], "<tr> <td>$x</td> <td>$y</td> <td>$r</td>
                    <td><b>$check</b></td> <td>$currentTime</td> <td>$time</td> </tr>");

foreach ($_SESSION['arr'] as $item) echo $item;

echo "</table>";



