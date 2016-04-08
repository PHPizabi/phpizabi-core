<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PHPizabi Installer</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">

    <script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>

    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                    
                </ul>
                <a class="brand"><span class="first">PHPizabi</span> <span class="second">Madison</span></a> 
        </div>
    </div>
    


    
    <div class="sidebar-nav">
        <a href="#" class="nav-header"><i class="icon-check"></i>Welcome</a>
        <a href="#" class="nav-header"><i class="icon-check"></i>License</a>
        <a href="#" class="nav-header"><i class="icon-circle-arrow-right"></i>Check Requirements</a>
        <a href="#" class="nav-header"><i class=""></i>Setup Database</a>
        <a href="#" class="nav-header"><i class=""></i>Create Admin Account</a>
        <a href="#" class="nav-header"><i class=""></i>Connect to Enhance</a>
        <a href="#" class="nav-header"><i class=""></i>Install Complete</a>
    </div>
    

    
    <div class="content">
        
        <div class="header">
            
            <h1 class="page-title">Requirements</h1>
        </div>
        
          

        <div class="container-fluid">
            <div class="row-fluid">
                    
<h2>Server Requirements</h2>
<p>
</p>
<p>
<ol>
<li><i class="icon-check"></i> PHP Version 5.3 or greater</li>
<li><i class="icon-check"></i> MySQL</li>
<li><i class="icon-check"></i> GD</li>
</ol>
</p><br/><br/>
<form method="get" action="index.php">
	<input type="hidden" name="step" value="4">
	<input name="Continue" type="submit" id="Continue" value="Continue" class="btn btn-primary">
	</form>
<p>** Currently this page is not actually checking or complete, make sure you have the needed items **</p>

                    
                    <footer>
                        <hr>

                   
                        <p class="pull-right">Another application by <a href="http://www.andyjames.org" target="_blank">AndyJames.org</a></p>

                        <p>&copy; 2013 <a href="http://www.phpizabi.org" target="_blank">PHPizabi</a></p>
                    </footer>
                    
            </div>
        </div>
    </div>
    


    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>


