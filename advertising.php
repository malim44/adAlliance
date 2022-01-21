<?php

include 'connection.php';

header('Content-Type: text/plain');

$hour = (int)$_GET['hour'];
$position = (int)$_GET['pos'];

$sql1 = 'SELECT advert_id, views, image, link, width, height 
        FROM table1
        WHERE hour = ' . $hour . ' 
        AND position = ' . $position . ' 
        ORDER BY priority, views';

$sql2 = 'SELECT advert_id, views, image, link, width, height 
        FROM table2 
        WHERE hour = ' . $hour . ' 
        AND position = ' . $position . ' 
        ORDER BY priority, views';

$query = $pdo->prepare($sql1);
$query->execute();
$result1 = $query->fetchAll();

$query = $pdo->prepare($sql2);
$query->execute();
$result2 = $query->fetchAll();

$result = null;
$sql = null;

if(count($result1) !== 0 && count($result2) !== 0) {
    if((int)$result1[0]['views'] <= (int)$result2[0]['views']) {
        $advert_id = (int)$result1[0]['advert_id'];
        $views = (int)$result1[0]['views'] + 1;
        $sql = 'UPDATE table1 SET views = ' . $views . ' WHERE advert_id = ' . $advert_id;
        $result = $result1[0];
    } else {
        $advert_id = (int)$result2[0]['advert_id'];
        $views = (int)$result2[0]['views'] + 1;
        $sql = 'UPDATE table2 SET views = ' . $views . ' WHERE advert_id = ' . $advert_id;
        $result = $result2[0];
    }
} else if(count($result1) !== 0) {
    $advert_id = (int)$result1[0]['advert_id'];
    $views = (int)$result1[0]['views'] + 1;
    $sql = 'UPDATE table1 SET views = ' . $views . ' WHERE advert_id = ' . $advert_id;
    $result = $result1[0];
} else if(count($result2) !== 0) {
    $advert_id = (int)$result2[0]['advert_id'];
    $views = (int)$result2[0]['views'] + 1;
    $sql = 'UPDATE table1 SET views = ' . $views . ' WHERE advert_id = ' . $advert_id;
    $result = $result2[0];
}

if($sql) {
    $query = $pdo->prepare($sql);
    $query->execute();
}

if(!empty($result)) {
    echo json_encode((object)$result);
} else {
    echo null;
}

