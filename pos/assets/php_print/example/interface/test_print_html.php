<?php

require __DIR__ . '/../../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

$connector = new WindowsPrintConnector("80mm");
// $connector = new FilePrintConnector("80mm Series Printer"); // Add connector for your printer here.

$printer = new Printer($connector);
// var_dump($printer);die();
/*
 * Due to its complxity, escpos-php does not support HTML input. To print HTML,
 * either convert it to calls on the Printer() object, or rasterise the page with
 * wkhtmltopdf, an external package which is designed to handle HTML efficiently.
 *
 * This example is provided to get you started: On Debian, first run-
 * 
 * sudo apt-get install wkhtmltopdf xvfb
 *
 * Note: Depending on the height of your pages, it is suggested that you chop it
 * into smaller sections, as printers simply don't have the buffer capacity for
 * very large images.
 *
 * As always, you can trade off quality for capacity by halving the width
 * (550 -> 225 below) and printing w/ Escpos::IMG_DOUBLE_WIDTH | Escpos::IMG_DOUBLE_HEIGHT
 */
  // $source = __DIR__ . "/../resources/document_test.php";
  //  echo $source;die();
try {
    /* Set up command */
    $source = __DIR__ . "/output/rec.jpg";
    /* Load up the image */
    try{
        $img = EscposImage::load($source);
    }catch (Exception $e){
        // unlink($dest);
        throw $e;
    }
    // unlink($dest);

    /* Print it */
    $printer->bitImage($img); // bitImage() seems to allow larger images than graphics() on the TM-T20. bitImageColumnFormat() is another option.
    $printer->cut();
    
	$printer->close();

}catch(Exception $e){
    echo $e->getMessage();
}




