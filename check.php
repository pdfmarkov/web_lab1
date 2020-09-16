<?php
date_default_timezone_set('Europe/Moscow');

session_start();
$start = microtime(true);

if (!is_numeric($_GET["X"]) || !is_numeric($_GET["Y"]) || !is_numeric($_GET["R"]) || strlen($_GET["R"])>10 || strlen($_GET["Y"])>10 || strlen($_GET["X"])>10) {
    http_response_code(400);
    exit;
}
$x = (double) $_GET["X"];
$y = (double) $_GET["Y"];
$r = (double) $_GET["R"];
$check="";
$currentTime = date("H:i:s");

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    http_response_code(400);
    exit;
}

if ($x<=-3 || $x>=5 || $y>3 || $y<-5 || $r<2 || $r>5) {
    http_response_code(400);
    exit;
}

echo "<div id='container frame'>
        <table id='resultTable'>
            <tr>
                <td>X</td>
                <td>Y</td>
                <td>R</td>
                <td>Результат</td>
                <td>t сейчас</td>
                <td>t выполнения</td>
            </tr>";

if (!(is_numeric($x) && is_numeric($y) && is_numeric($r))) {
    array_push ($_SESSION['arr'],"<tr> <td>ARGUMENTS ARE INCORRECT!</td> </tr>");
} else { if (
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
}
foreach ($_SESSION['arr'] as $item) {
    echo $item;
}
echo "</table> </div>";



