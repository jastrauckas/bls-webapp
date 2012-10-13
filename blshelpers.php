<?php

//Instantiate  DOL Data context object
//This  object stores the API information required to make requests
$context = new DOLDataContext("http://api.dol.gov", "09cdae0d-ee41-4ea8-8dfe-5d219a741310", "zLMlLGYzjBN3D");

function makeRequest($context, $tablename) {
	$results = Array();
	$request = new DOLDataRequest($context);
	if ($tablename == "averageHourlyEarnings") {
		//Specify table
		$method = "statistics/BLS_Numbers/averageHourlyEarnings";
		//Build Array arguments
		$arguments = Array('top' => '20', 
						   'select' => 'year,value',
						   'filter' => "(type eq 'F') and (period eq 12)",
                           );
		//Make API call
		$results = $request->callAPI($method, $arguments);
	}
	elseif ($tablename == "unemploymentRate") {
		//Specify table
		$method = "statistics/BLS_Numbers/unemploymentRate";
		//Build Array arguments
		$arguments = Array('top' => '20', 
						   'select' => 'year,value',
						   'filter' => "(year ge 1992)",
                           );
		//Make API call
		$results = $request->callAPI($method, $arguments);
	}
	else {
		echo "option not recognized!";
	}
	return $results;
}


function MakeTable($choice, $results) {
	if ($choice == 'averageHourlyEarnings') {return WageTable($results);}
	elseif ($choice == 'unemploymentRate') {return UnemploymentTable($results);}
	else {return 'oops, option ' . $choice . 'not reconginzed!';}
}

// make a table out of hourly wage data
function WageTable($results) {
  	if (is_string($results)) {
		return 'error: ' . $results;
	}
	$string = '';
	$string .= "<table class='table table-condensed'><tr><th>Year</th><th>Average Hourly Salary</th></tr>\n";
	foreach ($results as $object) {
		$string .= "<tr><td>{$object->year}</td><td>\${$object->value}</td></tr>\n";
	}
	return $string . "</table>\n";
}

function UnemploymentTable($results) {
	if (is_string($results)) {
        return 'error: ' . $results;
    }
    $string = '';
    $string .= "<table class='table table-condensed'><tr><th>Year</th><th>Unemployment Rates</th></tr>\n";
    foreach ($results as $object) {
        $string .= "<tr><td>{$object->year}</td><td>{$object->value}</td></tr>\n";
    }
    return $string . "</table>\n";


}
?>

