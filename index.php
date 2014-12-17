<?php 

//include database connection details
include('db.php');

//redirect to real link if URL is set
if (!empty($_GET['url'])) {
	$redirect = mysql_fetch_assoc(mysql_query("SELECT url_link FROM short WHERE url_short = '".addslashes($_GET['url'])."'"));
	$redirect = "http://".str_replace("http://","",$redirect[url_link]);
	header('HTTP/1.1 301 Moved Permanently');  
	header("Location: ".$redirect);  
}
//

//insert new url
if ($_POST['url']) {

//get random string for URL and add http:// if not already there
$short = md5(uniqid(rand(), true));

mysql_query("INSERT INTO short (url_link, url_short, url_ip, date) VALUES

	(
	'".addslashes($_POST['url'])."',
	'".$short."',
	'".$_SERVER['REMOTE_ADDR']."',
	'".date("Y-m-d H:i:s")."'
	)

") or die(mysql_error());

//$redirect = "?s=$short";
//header('Location: '.$redirect); die;

}
//

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tiny Me | PHP Url Redirect</title>

    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    
    <style>
	section {
    padding: 70px 0;
    text-align: center;
}
select.frecuency {
    border: none;
    font-style: italic;
    background-color: transparent;
    cursor: pointer;
    -webkit-transform: translateY(0);
    transform: translateY(0);
    -webkit-transition: -webkit-transform .35s ease-in;
    transition: -webkit-transform .35s ease-in;
    border-bottom: none;
}
select.frecuency:focus {
    outline: none;
    border-bottom: 5px solid #39b3d7;
    -webkit-transform: translateY(-5px);
    transform: translateY(-5px);
    -webkit-transition: -webkit-transform .35s ease-in;
    transition: -webkit-transform .35s ease-in;
}
.free {
    text-transform: uppercase;
}
.input-group {
    margin: 10px auto;
    width: 100%;
}
input.btn.btn-lg,
input.btn.btn-lg:focus {
    outline: none;
    width: 60%;
    height: 60px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
button.btn {
    width: 40%;
    height: 60px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
.promise {
    color: #999;
}

	</style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div class="container">
    <div class="jumbotron">
  <h1><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Tiny ME!</h1>
  <p>URL redirect script using PHP, MySQL</p>
  <div class="pull-right"><img src="img/pic.png"></div>
  <?php 
  if(!$_POST['url']) {
  
  echo '<section>
	<div class="row">
		<div class="col-md-12">
    	 <div class="well">
             <form action=" '. $_SERVER['PHP_SELF'].'" method="post">
              <div class="input-group">
                 <input class="btn btn-lg" name="url" id="url" type="text" placeholder="Your biiiig URL!" required>
                 <button id="sub" class="btn btn-info btn-lg" type="submit">Shorten</button>
              </div>
             </form>
    	 </div>
		</div>
	</div>
</section>';
  } else {
  
  echo '<section>
	<div class="row">
		<div class="col-md-12">
    	 <div class="well">
		 	<form action="#">
              <div class="input-group">
                 <input onClick="this.select();" class="btn btn-lg" name="url" id="url" type="text" value="'.'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?url=".$short.'" required>
              </div>
             </form>
             <h3>Done!</h3>
    	 </div>
		</div>
		<a href="'.'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'">Shorten Another URL!</a>
	</div>
</section>';

  }
  ?>

</div>

</div>

<hr>
<footer>
<center>Powered by Techulus!</center>
</footer>
  </body>
</html>