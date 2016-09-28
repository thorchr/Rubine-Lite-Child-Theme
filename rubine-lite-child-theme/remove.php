<?php
/**
 * Template Name: Filadministrasjon
**/

  get_header(); 




  ?>



<?php

// get correct file path
$fileName = $_GET['name'];
$filePath = 'uploads/'.$fileName;

// remove file if it exists
if ( file_exists($filePath) ) {
	unlink($filePath);
	header('Location:http://frigg.hiof.no/interaktiv_v168/eksamen/filoversikt/');
	}

?>