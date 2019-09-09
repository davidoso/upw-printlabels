<?php
require('../phpqrcode/qrlib.php');                  // PHP library to create a QR code
$url = $_GET['url'];
QRcode::png($url, false, QR_ECLEVEL_L, 2);

// References:
// http://phpqrcode.sourceforge.net/docs/html/class_q_rcode.html
// http://phpqrcode.sourceforge.net/examples/index.php?example=007
?>