<?php
const SERVER = 'mysql219.phy.lolipop.lan';
const DBNAME = 'LAA1517364-teama';
const USER = 'LAA1517364';
const PASS = 'teama';
$connect = 'mysql:host='.SERVER.';dbname='.DBNAME.';charset=utf8';
$pdo = new PDO($connect, USER, PASS);
?>
