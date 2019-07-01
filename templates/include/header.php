<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo htmlspecialchars( $results['pageTitle'] )?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  </head>
  <body>
  	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">WebSiteName</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li><a href=".">Home</a></li>
	      <li><a href="?action=theme">Тематика</a></li>
	      <li><a href="?action=listResources">Инт. ресурсы</a></li>
	      <li><a href="?action=listAdUnit">Рекламные блоки</a></li>
	    </ul>
	  </div>
	</nav>
    <div id="container"></div>

     

