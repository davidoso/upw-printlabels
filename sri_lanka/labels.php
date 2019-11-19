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
    border-spacing: 0;
    border-collapse: collapse;
  }
  tr {
    height: 23mm;
    /* padding: 0.5mm; */
  }
  tr td {
    width: 45mm;
    padding: 1mm 2mm;
    vertical-align: text-top;
    background-color: white;
    /* border: 1px solid black; */
  }
  td div {
    text-align: center;
  }
  .row-page {
    height: 18mm;
  }
  .text {
    margin-top: 0.5mm;
    font: 2mm arial, sans-serif;
  }
  .barcode {
    margin-top: 1mm;
  }
</style>
</head>
<body>

<table>
<?php
    $colCounter = 0;
    $rowCounter = 0;
    $colsPerPage = 4;
    $rowsPerPage = 12;
  for($i = 1; $i < count($data); $i++) { // First row on sheet contains column names
    // Extract values from sheet. Max characters per value: id = 8; price = 9; item category and title = 30
    $labelsNeeded = trim($data[$i][4]);
    $limit = $labelsNeeded > 1 ? $labelsNeeded : 1;
    $id = substr(trim($data[$i][2]), 0, 8);
    $price = substr(trim($data[$i][3]), 0, 9);
    // Barcode References:
    // https://github.com/davidscotttufts/php-barcode
    // http://davidscotttufts.com/2009/03/31/how-to-create-barcodes-in-php
    // https://www.ruggedtabletpc.com/barcode-generator
    // http://www.barcodegenerator.online
    $codetype = 'code39';
    $size = '40';
    $print_id = 'false';
    for($j = 0; $j < $limit; $j++) {
      if($colCounter == 0) {
        echo '<tr>';
      }
      echo '<td>';
        echo '<div class="text">' . substr(trim($data[$i][0]), 0, 30) . '</div>' .
        '<div class="text">' . substr(trim($data[$i][1]), 0, 30) . '</div>' .
        '<div class="barcode"><img src="../../phpbarcode/barcode.php?codetype=' . $codetype . '&size=' . $size . '&text=' . $id .'&print=' . $print_id .'" alt="BARCODE NOT FOUND"></div>' .
        '<div class="text">' . $id . ' &nbsp;|&nbsp; Rs  ' . $price . '</div>';
      echo '</td>';
      $colCounter++;
      if($colCounter % $colsPerPage == 0) {
        echo '</tr>';
        $colCounter = 0;
        $rowCounter++;
      }
      if($rowCounter == $rowsPerPage) {
        echo '<tr class="row-page"></tr>';
        $rowCounter = 0;
      }
    }
  }
?>
</table>

</body>
</html>