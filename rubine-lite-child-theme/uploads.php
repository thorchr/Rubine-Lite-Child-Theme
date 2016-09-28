<?php

/**
 * Template Name: Filopplasting
 */

  get_header(); 




  ?>



<!doctype html>
<html lang="no">
  <head>
    <!-- Metainfo -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Title and SEO/OG-meta -->
    <title>Funksjonseksempel</title>
    
    <!-- CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/cerulean/bootstrap.min.css" rel="stylesheet" />
    <link href="https://code.jquery.com/ui/1.11.4/themes/redmond/jquery-ui.css" rel="stylesheet" />
    
    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-2.2.1.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/scripts.js?v=<?php echo time(); ?>"></script>
  </head>
<body> 

  <?php





$link= mysqli_connect("frigg.hiof.no","interaktiv_v168","interaktiv_v168MyDB","interaktiv_v168");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }



if(isset($_FILES['files'])){
    $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
        if($file_size > 5097152){
			$errors[]='File size must be less than 5 MB';
        }	
            $cust_info =  $_POST['cust_info'];


       $sql = "INSERT INTO dd_files (cust_info,file_name,file_type,file_size) VALUES ('$cust_info',
      '$file_name','$file_type', '$file_size')";
        $desired_dir="uploads";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"uploads/".$file_name);
            }else{									//rename the file if another one exist
                $new_dir="uploads/".$file_name.time();
                 rename($file_tmp,$new_dir) ;				
            }
            mysqli_query($link,$sql);			
        }else{
                print_r($errors);
        }
    }
	if(empty($error)){
	

             
              echo "<h1>Filene dine ble lastet opp til serveren.</h1>";
        
            

           }
   
	}





?>
<h1>Kundevisning</h1>
<div class="container">
  <div class="row">
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
      <b>Kunde: </b>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
       <b>Filnavn: </b>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <b>Filtype: </b>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
       <b>Filstørrelse: </b>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
      <b></b>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
      <b></b>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
      <b></b>
    </div>
  </div>
  <?php
    //Hente ut ordre
    $get_customers = mysqli_query($link, "SELECT * FROM dd_files ORDER BY cust_info DESC");
   while($customer = mysqli_fetch_array($get_customers)) {
      ?>
      <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
          <?php echo $customer['cust_info']; ?>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
           <?php echo $customer['file_name']; ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                 <?php echo $customer['file_type'];?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
          <?php echo $customer['file_size']; ?> <b>KB</b>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
          
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
       
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
          
        </div>
      </div>

  </body>
</html>     
      <?php
    }


    // close connection
mysqli_close($link);
  ?>
