<?php
require('../../upwork-xls-to-mysql/XLSXReader.php');  // PHP library to fetch data from a spreadsheet
$xlsx = new XLSXReader('Sample Data.xlsx');           // NOTE: Modify parameter: Excel file
$data = $xlsx->getSheetData('Sheet1');                // NOTE: Modify parameter: Sheet name
?>

<!DOCTYPE html>
<html>
<head>
<title>Labels</title>
<style>
  body {
    margin: 0;
  }
  table {
    /* background-color: gray; */
    width: 40mm;
  }
  tr {
    height: 30mm;
    padding: 1mm 1.5mm 1mm 1.5mm;
  }
  tr td {
    padding: 2.5mm;
    vertical-align: text-top;
    background-color: white;
  }
  td div {
    text-align: center;
  }
  .text {
    margin-top: 0.5mm;
    font: 2.2mm arial, sans-serif;
  }
  .barcode {
    margin-top: 2mm;
  }
</style>
</head>
<body>

<table>
<?php
  for($i = 1; $i < count($data); $i++) { // First row on sheet contains column names
    $labelsNeeded = trim($data[$i][4]);
    $limit = $labelsNeeded > 1 ? $labelsNeeded : 1;
    // Barcode References:
    // https://github.com/davidscotttufts/php-barcode
    // http://davidscotttufts.com/2009/03/31/how-to-create-barcodes-in-php
    // https://www.ruggedtabletpc.com/barcode-generator
    // http://www.barcodegenerator.online
    $codetype = 'code39';
    $size = '40';
    $print_id = 'false';
    for($j = 0; $j < $limit; $j++) {
      // Max characters per value: id = 6; price = 9; item category and title = 30
      $id = substr(trim($data[$i][2]), 0, 6);
      $price = substr(trim($data[$i][3]), 0, 9);
      echo '<tr>';
        echo '<td>';
          echo '<div class="text">' . substr(trim($data[$i][0]), 0, 30) . '</div>' .
          '<div class="text">' . substr(trim($data[$i][1]), 0, 30) . '</div>' .
          '<div class="barcode"><img src="../../phpbarcode/barcode.php?codetype=' . $codetype . '&size=' . $size . '&text=' . $id .'&print=' . $print_id .'" alt="BARCODE NOT FOUND"></div>' .
          '<div class="text">' . $id . ' &nbsp;|&nbsp; Rs  ' . $price . '</div>';
        echo '</td>';
      echo '</tr>';
    }
  }
?>
</table>

</body>
</html>