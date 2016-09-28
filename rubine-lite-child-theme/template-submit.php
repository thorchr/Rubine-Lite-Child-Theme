<?php
/**
 * Template Name: Submission Page
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
    <div class="container">

            <div class="row">
         
        </div>

 
          <div class="row">
            <div class="col-lg-12">
               <form class="well" action="http://frigg.hiof.no/interaktiv_v168/eksamen/filoversikt/" method="post" enctype="multipart/form-data" name="front_end_upload">
                  <div class="form-group">
                  <p>Kundeinfo: <input type="text" name="cust_info"></br></p>
                    <label for="file">Velg filer for å laste opp</label>
                    <input type="file" name="files[]" multiple="">
                    <p class="help-block">Filene må ikke være større enn 5 MB.</p>
                  </div>
                  <input type="submit" class="btn btn-lg btn-primary" value="Upload">
                </form>
            </div>
          </div>
    </div> <!-- /container -->






</body>
</html>
	
<?php get_footer(); ?>