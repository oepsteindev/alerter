<?php

//including the database connection file
include_once("config.php");
include_once("discord_notify.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated




$price = isset($_POST['price']) ? $_POST['price'] : '';
$ticker = isset($_POST['ticker']) ? $_POST['ticker'] : '';
$low_thresh = .50;
$hi_thresh = .50;



$market_open = new DateTime('09:00am');
$market_close = new DateTime('5:00pm');
$now = new DateTime();

//debug date
// print_r($market_open->format('H:i'));
// print_r($market_close->format('H:i'));
// print_r($now->format('H:i'));


if ($now >= $market_open && $now <= $market_close  && (date('D') != 'Sat' || date('D') != 'Sun')) {
    
    
    echo 'market is open';
    


if ($ticker != '') {
    $result = mysqli_query($mysqli, "SELECT * FROM alerts  WHERE ticker = '{$ticker}' ORDER BY id DESC"); 
}


if ($result) {
    while($res = mysqli_fetch_array($result)) {

        if (strtolower($res['bullbear']) == 'bull') {
            
            if ($res['t1_hit'] == 0) {
             
                if ($price >= $res['t1'] && $res['t1'] >= ($res['t1'] - $low_thresh) && $res['t1'] != 0) {
                    $msg = "ALERT: {$ticker} is at or above BULL Target {$res['t1']}";
                    notify($res['t1'], $msg);
                    mysqli_query($mysqli, "UPDATE alerts SET t1_hit = 1 WHERE id = {$res['id']}");
                    break;

                }
            }

            if ($res['t2_hit'] == 0) {
                if ($price >= $res['t2'] && $res['t2'] >= ($res['t2'] - $low_thresh) && $res['t2'] != 0) {
                    $msg = "ALERT: {$ticker} is at or above BULL Target {$res['t2']}";
                    notify($res['t2'], $msg);
                    mysqli_query($mysqli, "UPDATE alerts SET t2_hit = 1 WHERE id = {$res['id']}");
                    break;
                }
            }

            if ($res['t3_hit'] == 0) {
                if ($price >= $res['t3'] && $res['t3'] >= ($res['t3'] - $low_thresh) && $res['t3'] != 0) {
                    $msg = "ALERT: {$ticker} is at or above BULL Target {$res['t3']}";
                    notify($res['t3'], $msg);
                    mysqli_query($mysqli, "UPDATE alerts SET t3_hit = 1 WHERE id = {$res['id']}");
                    break;
                }
            }

            if ($res['t4_hit'] == 0) {
                if ( $price >= $res['t4'] && $res['t4'] >= ($res['t4'] - $low_thresh)  && $res['t4'] != 0) {
                    $msg = "ALERT: {$ticker} is at or above BULL Target {$res['t4']}";
                    notify($res['t4'], $msg);
                    mysqli_query($mysqli, "UPDATE alerts SET t4_hit = 1 WHERE id = {$res['id']}");
                    break;
                }
            }

            if ($res['t5_hit'] == 0) {
                if ($price >= $res['t5'] && $res['t5'] >= ($res['t5'] - $low_thresh) && $res['t5'] != 0) {
                    $msg = "ALERT: {$ticker} is at or above BULL Target {$res['t5']}";
                    notify($res['t5'], $msg);
                    mysqli_query($mysqli, "UPDATE alerts SET t5_hit = 1 WHERE id = {$res['id']}");
                    break;
                }
            }
        } else { //is bear

            if ($res['t1_hit'] == 0) {
                if ($price <= $res['t1'] && $res['t1'] <= ($res['t1'] + $hi_thresh) && $res['t2'] != 0) {
                    $msg = "ALERT: {$ticker} is at or below BEAR Target {$res['t1']}";
                    notify($res['t1'], $msg);
                    mysqli_query($mysqli, "UPDATE alerts SET t1_hit = 1 WHERE id = {$res['id']}");
                    break;
                }
            }

            if ($res['t2_hit'] == 0) {
                if ($price <= $res['t2'] && $res['t2'] <= ($res['t2'] + $hi_thresh) && $res['t2'] != 0) {
                    $msg = "ALERT: {$ticker} is at or below BEAR Target {$res['t2']}";
                    notify($res['t2'], $msg);
                    mysqli_query($mysqli, "UPDATE alerts SET t2_hit = 1 WHERE id = {$res['id']}");
                    break;
                }
            }

            if ($res['t3_hit'] == 0) {
                if ($price <= $res['t3'] && $res['t3'] <= ($res['t3'] + $hi_thresh) && $res['t3'] != 0) {
                    $msg = "ALERT: {$ticker} is at or below BEAR Target {$res['t3']}";
                    notify($res['t3'], $msg);
                    mysqli_query($mysqli, "UPDATE alerts SET t3_hit = 1 WHERE id = {$res['id']}");
                    break;
                }
            }

            if ($res['t4_hit'] == 0) {
                if ($price <= $res['t4'] && $res['t4'] >= ($res['t4'] + $hi_thresh) && $res['t4'] != 0) {
                    $msg = "ALERT: {$ticker} is at or below BEAR Target {$res['t4']}";
                    notify($res['t4'], $msg);
                    mysqli_query($mysqli, "UPDATE alerts SET t4_hit = 1 WHERE id = {$res['id']}");
                    break;
                }
            }

            if ($res['t5_hit'] == 0) {
                if ($price <= $res['t5'] && $res['t5'] >= ($res['t5'] + $hi_thresh)  && $res['t5'] != 0) {
                    $msg = "ALERT: {$ticker} is at or below BEAR Target {$res['t5']}";
                    notify($res['t5'], $msg);
                    mysqli_query($mysqli, "UPDATE alerts SET t5_hit = 1 WHERE id = {$res['id']}");
                    break;
                }
            }

        }
        

    }
}

} else {
    
    echo 'market is closed';
    
}

?>

