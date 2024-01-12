<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1517345-final';
const USER = 'LAA1517345';
const PASS = 'PASS0316';
$connect = 'mysql:host='.SERVER.';dbname='.DBNAME.';charset=utf8';
$pdo = new PDO($connect, USER, PASS);
?>
