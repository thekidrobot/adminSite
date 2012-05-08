<?php // content="text/plain; charset=utf-8"
require_once ('../lib/jpgraph/jpgraph.php');
require_once ('../lib/jpgraph/jpgraph_line.php');
 
require_once('../includes/connection.php'); 
require_once('../includes/general_functions.php'); 
 
$resource_id = escape_value($_GET['vid']);
$subscriber_id = escape_value($_GET['uid']);

$ydata = array();
$axis = array();

$sql = "SELECT
          date as date,
          COUNT(resource_id) as rid
        FROM
          views_vodchannels
        WHERE
          resource_id = $resource_id AND
          subscriber_id = $subscriber_id
        GROUP BY date"; 

$rsGet = $DB->execute($sql);

while (!$rsGet->EOF)
{
  array_push($ydata,$rsGet->fields['rid']);
  array_push($axis,$rsGet->fields['date']);
	$rsGet->MoveNext();
}

// Size of the overall graph
$width=600;
$height=500;
 
// Create the graph and set a scale.
// These two calls are always required
$graph = new Graph($width,$height);
$graph->SetScale('intlin');

$graph->title->Set("VOD Views");
$graph->title->SetMargin(10);

$graph->subtitle->Set('(Video Name)');  

$graph->xaxis->title->Set("Date");

$graph->xaxis->SetTickLabels($axis);
$graph->xaxis->SetLabelAngle(90);
$graph->yaxis->HideZeroLabel('false');

$graph->yaxis->title->Set("# Of views");
 
// Create the linear plot
$lineplot=new LinePlot($ydata);
 
// Add the plot to the graph
$graph->Add($lineplot);
 
// Display the graph
$graph->Stroke();
?>