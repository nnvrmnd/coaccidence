<?php
date_default_timezone_set('Asia/Manila');

try {
    $db = new PDO('mysql: host=localhost; dbname=coaccidence_db; charset=utf8', 'administrator', 'neilfrancisbayna');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('Cannot establish database connection...');
}
