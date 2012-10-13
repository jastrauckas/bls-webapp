<?php
include "PHP_DOLDataSDK/DOLDataSDK.php";
include "blshelpers.php";
?>

<!DOCTYPE html>
<html>

<head>
	<title>BLS Stats</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="row">
  	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
          		</a>
          		<a class="brand" href="/">Home</a>
			</div>
		</div>
	</div>	
	</div>

	<br>
	<br>
	<br>
	<br>

	<div class="row">
  	<div class="span6 bs-docs-sidebar">
	
	</div>
  	
	<div class="span10">
		<h1>Labor Statistics from the US BLS</h1>
		<h2>Quick Lookup</h2>
		<br>
		<form action='' method='get'> 
			<select class='span3' id='choices' name='choices'>
				<option value='averageHourlyEarnings'>Hourly Wages</option>
				<option value='unemploymentRate'>Unemployment</option>
			</select>
			<input class='btn btn-inverse' type='submit' value='Submit'>
		</form>
		<br>
		<?php
			// things that only show up if option is specified
			// could use JS to update page without reload... 
			if (isset($_GET['choices']))
			{
				$option = $_GET['choices'];
				$results = makeRequest($context, $option); 
				$table = MakeTable($option, $results);
				echo $table;
			}
		?>
	</div>
	</div>

</body>
</html>


