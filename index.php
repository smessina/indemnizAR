<?php
if(isset($_GET['p']) && $_GET['p'] != "home") {
  $page = $_GET['p'];
} else if(!isset($_GET['p']) || $_GET['p'] == "home") {
  $page = "home";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Der. del Trabajo | Liquidacion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="apple-touch-icon" href="img/apple-touch-icon-iphone.png" /> 
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-ipad.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-iphone4.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-ipad3.png" />
    <style type="text/css">
    body {
      padding: 20px;
    }
    .container {
      /*background: url("img/logo.jpg") no-repeat scroll left top / 86px 85px transparent;*/
      position: relative;
    }
    .nav {
      /*position: absolute;
      right: 0;*/
    }
    .jumbotron {
      text-align: center;
    }
    .muted {
      padding-bottom: 15px;
      /*padding-left: 100px;*/
      text-align: center;
      padding-top: 10px;
    }
    .nav {
      margin-top: 12px;
      float: none;
    }
    .form-signin {
        /*max-width: 350px;*/
        /*padding: 19px 29px 29px;*/
        margin: 0 auto 20px;
        background-color: #fff;
        /*border: 1px solid #e5e5e5;*/
        overflow: hidden;
        padding-bottom: 10px;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 0px 1px rgba(0,0,0,.9);
           -moz-box-shadow: 0 0px 1px rgba(0,0,0,.9);
                box-shadow: 0 0px 1px rgba(0,0,0,.9);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        /*height: auto;*/
        margin-bottom: 15px;
        /*padding: 7px 9px;*/
      }
      select { width: auto; }
      .radio { /*float: left;*/ padding-right: 10px; display: inline-block; }
      .preaviso { text-align: center; }
      .result { text-align: left; }
      .nav a { padding: 8px 7px !important; }
    </style>
  </head>
  <body>

    <div class="container">
      <div class="masthead">
        <div class="row">
          <div class="span3"></div>
          <div class="span6"><!--h2 class="muted">Der. del Trabajo y de la Seg. Social</h2--></div>
          <div class="span3">
            <ul class="nav nav-pills pull-right">
              <li <?php if($page == "home") { ?>class="active" <?php } ?>><a href="home">Inicio</a></li>
              <li <?php if($page == "calcular") { ?>class="active" <?php } ?>><a href="calcular">Calcular</a></li>
              <!--li <?php if($page == "creditos") { ?>class="active" <?php } ?>><a href="creditos">Creditos</a></li-->
              <li <?php if($page == "contactod") { ?>class="active" <?php } ?>><a href="contacto">Contacto</a></li>
            </ul>
          </div>
        </div>
      </div>
     <hr class="line" />
      <div class="jumbotron">
      <?php
        if(file_exists($page.".php")) {
          include($page.".php");
        } else {
          include("error.php");
        }
      ?>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready( function() {
        // Your code here
        $(".nav a, .go").click(function( event ) {
          event.preventDefault();   
          var href = $(this).attr("href");
          $(".nav li").each(function() {
            $(this).removeClass("active");
          });
          $(".nav li a[href$='"+href+"']").parent().addClass("active");
          $.ajax({
            url: href+".php",
            success: function( data ) {
              $(".jumbotron").html(data);
            }
          });
        });
        $(".form-signin").live("submit", function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                success: function(data){
                    $(".jumbotron").html(data);
                }
            });
        });
      });
    </script>
  </body>
</html><?php die(); ?>
