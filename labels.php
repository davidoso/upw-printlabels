<?php
require('../upwork-xls-to-mysql/XLSXReader.php');   // PHP library to fetch data from a spreadsheet
$xlsx = new XLSXReader('Sample Data.xlsx');         // NOTE: Modify this: Excel file
$data = $xlsx->getSheetData('Sheet1');              // NOTE: Modify this: Sheet name
?>

<!DOCTYPE html>
<html>
<head>
<title>Plant Labels</title>
<style>
  .t1 {
    font: 15px arial, sans-serif;
  }
  .t2 {
    font: 12px arial, sans-serif;
  }
  td {
    height: 10mm;
  }
  table tr td:nth-child(1) {
    width: 35mm;
    text-align: center;
  }
  table tr td:nth-child(2) {
    width: 50mm;
    padding: 0 0 4mm 2mm;
  }
  table tr td:nth-child(3) {
    width: 30mm;
    text-align: center;
  }
</style>
</head>
<body>

<table>
<?php
  for($i = 1; $i < count($data); $i++) { // Row 0 on sheet contains column names
    $labelsNeeded = trim($data[$i][2]);
    $limit = $labelsNeeded > 1 ? $labelsNeeded : 1;
    for($j = 0; $j < $limit; $j++) {
      echo '<tr>';
      echo '<td><img src="sku_barcode.png" alt="SKU BARCODE NOT FOUND"></td>';
      echo '<td><div class="t1">' . trim($data[$i][1]) . '</div><div class="t2">' . trim($data[$i][0]) . '</div></td>';
      echo '<td><img src="qr.png" alt="QR BARCODE NOT FOUND"></td>';
    }
  }
?>
</table>

</body>
</html>