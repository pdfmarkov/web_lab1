<?php
date_default_timezone_set('Europe/Moscow');

session_start();
$start = microtime(true);
$x = (double) $_GET["X"];
$y = (double) $_GET["Y"];
$r = (double) $_GET["R"];
$check="";
$answer="";
$currentTime = date("H:i:s");

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    http_response_code(400);
    exit;
}

if (!(is_numeric($x) && is_numeric($y) && is_numeric($r))) {
    $answer= "<tr> <td><b>VALIDATION IS BROKEN!</b></td> </tr>";
} else { if (
    ($x >= 0 && $y >= 0 && $y <= ($r / 2) && $x <= $r) ||
    ($x <= 0 && $y >= 0 && ($x * $x + $y * $y) <= ($r / 2) * ($r / 2)) ||
    ($x >= 0 && $y <= 0 && $y >= $x - $r)
    )
    $check = "TRUE";
    else
    $check = "FALSE";
    $time = microtime(true) - $start;
    $answer= "<tr> <td>$x</td> <td>$y</td> <td>$r</td>
                    <td><b>$check</b></td> <td>$currentTime</td> <td>$time</td> </tr>";
}
echo $answer;



