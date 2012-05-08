<?php // content="text/plain; charset=utf-8"
require_once ('../lib/jpgraph/jpgraph.php');
require_once ('../lib/jpgraph/jpgraph_bar.php');
 
require_once('../includes/connection.php'); 
require_once('../includes/general_functions.php'); 
 
$resource_id = escape_value($_GET['vid']);

$ydata = array();
$axis = array();

$sql = "SELECT
          date as date,
          COUNT(resource_id) as rid
        FROM
          views_vodchannels
        WHERE
          resource_id = $resource_id
				GROUP BY date"; 

$rsGet = $DB->execute($sql);

while (!$rsGet->EOF)
{
  array_push($ydata,$rsGet->fields['rid']);
  array_push($axis,$rsGet->fields['date']);
	$rsGet->MoveNext();
}

// Size of the overall graph
$width=750;
$height=500;
 
// Create the graph and set a scale.
// These two calls are always required
$graph = new Graph($width,$height);
$graph->SetScale('textint');

$graph->SetMargin(50,10,10,70);

// Create a bar pot
$bplot = new BarPlot($ydata);

$graph->title->Set("VOD - Historic of views");

$graph->xaxis->title->Set("Viewed on");
$graph->xaxis->SetTickLabels($axis);
$graph->xaxis->SetLabelAngle(45);

$graph->yaxis->title->Set("Number of views");
$graph->yaxis->SetTitleMargin(35);
$graph->yaxis->scale->SetGrace(10);

//Add the bar plot 
$graph->Add($bplot);

// Display the graph
$graph->Stroke();
?>