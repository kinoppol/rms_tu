<?php
// Including all required classes
//require('BCGFont.php');
//require('BCGColor.php');
require('BCGDrawing.php'); 

// Including the barcode technology
include('BCGcode128.barcode.php'); 

// The arguments are R, G, B for color.
$color_black = new BCGColor(0, 0, 0);
$color_white = new BCGColor(255, 255, 255); 

$code = new BCGcode128();
$code->setScale(5); // Resolution
$code->setThickness(30); // Thickness
$code->setForegroundColor($color_black); // Color of bars
$code->setBackgroundColor($color_white); // Color of spaces
$code->setFont(0); // Font (or 0)
//$code->parse('|123456789012300'.chr(13).'4431050003'.chr(13).'1234567890123'.chr(13).'50000'); // Text
$pieces = explode("_", $_REQUEST[data]);
$code->parse($pieces[0]); // Text
/* Here is the list of the arguments
1 - Filename (empty : display on screen)
2 - Background color */
$drawing = new BCGDrawing('', $color_white);
$drawing->setBarcode($code);
$drawing->draw();

// Header that says it is an image (remove it if you save the barcode to a file)
header('Content-Type: image/png');

// Draw (or save) the image into PNG format.
$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
?>