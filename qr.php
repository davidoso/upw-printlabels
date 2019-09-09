<?php
require('../phpqrcode/qrlib.php');                  // PHP library to create a QR code
$url = $_GET['url'];
QRcode::png($url);
?>