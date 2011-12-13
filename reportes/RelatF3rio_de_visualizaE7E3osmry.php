<?php
session_start();
ob_start();
?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php include "phprptinc/ewrcfg3.php"; ?>
<?php include "phprptinc/ewmysql.php"; ?>
<?php include "phprptinc/ewrfn3.php"; ?>
<?php

// Get page start time
$starttime = ewrpt_microtime();

// Open connection to the database
$conn = ewrpt_Connect();

// Table level constants
define("EW_REPORT_TABLE_VAR", "RelatF3rio_de_visualizaE7E3o", TRUE);
define("EW_REPORT_TABLE_SESSION_GROUP_PER_PAGE", "RelatF3rio_de_visualizaE7E3o_grpperpage", TRUE);
define("EW_REPORT_TABLE_SESSION_START_GROUP", "RelatF3rio_de_visualizaE7E3o_start", TRUE);
define("EW_REPORT_TABLE_SESSION_SEARCH", "RelatF3rio_de_visualizaE7E3o_search", TRUE);
define("EW_REPORT_TABLE_SESSION_CHILD_USER_ID", "RelatF3rio_de_visualizaE7E3o_childuserid", TRUE);
define("EW_REPORT_TABLE_SESSION_ORDER_BY", "RelatF3rio_de_visualizaE7E3o_orderby", TRUE);

// Table level SQL
$EW_REPORT_TABLE_SQL_FROM = "archivos Inner Join log_descargas On archivos.id_archivo = log_descargas.id_archivo Inner Join usuarios On log_descargas.id_usuario = usuarios.IdUsuario Inner Join grupos On grupos.idGrupos = log_descargas.id_grupo";
$EW_REPORT_TABLE_SQL_SELECT = "SELECT log_descargas.fecha_descarga, archivos.titulo, usuarios.NombreCompleto As User, substr(grupos.grupos, 1, 50) As grupo, log_descargas.fecha_descarga As fecha FROM " . $EW_REPORT_TABLE_SQL_FROM;
$EW_REPORT_TABLE_SQL_WHERE = "";
$EW_REPORT_TABLE_SQL_GROUPBY = "";
$EW_REPORT_TABLE_SQL_HAVING = "";
$EW_REPORT_TABLE_SQL_ORDERBY = "";
$EW_REPORT_TABLE_SQL_USERID_FILTER = "";
$EW_REPORT_TABLE_SQL_CHART_BASE = "";

// Table Level Group SQL
define("EW_REPORT_TABLE_FIRST_GROUP_FIELD", "", TRUE);
$EW_REPORT_TABLE_SQL_SELECT_GROUP = "SELECT DISTINCT " . EW_REPORT_TABLE_FIRST_GROUP_FIELD . " FROM " . $EW_REPORT_TABLE_SQL_FROM;

// Table Level Aggregate SQL
$EW_REPORT_TABLE_SQL_SELECT_AGG = "SELECT * FROM " . $EW_REPORT_TABLE_SQL_FROM;
$EW_REPORT_TABLE_SQL_AGG_PFX = "";
$EW_REPORT_TABLE_SQL_AGG_SFX = "";
$EW_REPORT_TABLE_SQL_SELECT_COUNT = "SELECT COUNT(*) FROM " . $EW_REPORT_TABLE_SQL_FROM;
$af_fecha_descarga = NULL; // Popup filter for fecha_descarga
$af_titulo = NULL; // Popup filter for titulo
$af_User = NULL; // Popup filter for User
$af_grupo = NULL; // Popup filter for grupo
?>
<?php
$sExport = @$_GET["export"]; // Load export request
if ($sExport == "excel") {
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=' . EW_REPORT_TABLE_VAR .'.xls');
}
?>
<?php

// Initialize common variables
// Paging variables

$nRecCount = 0; // Record count
$nStartGrp = 0; // Start group
$nStopGrp = 0; // Stop group
$nTotalGrps = 0; // Total groups
$nGrpCount = 0; // Group count
$nDisplayGrps = 3; // Groups per page
$nGrpRange = 10;

// Clear field for ext filter
$sClearExtFilter = "";

// Non-Text Extended Filters
// Text Extended Filters
// Field fecha_descarga

$sv1_fecha_descarga = ""; $sv1d_fecha_descarga = "";
$sv2_fecha_descarga = ""; $sv2d_fecha_descarga = "";
$so1_fecha_descarga = ""; $so1d_fecha_descarga = "";
$so2_fecha_descarga = ""; $so2d_fecha_descarga = "";
$sc_fecha_descarga = ""; $scd_fecha_descarga = "";

// Custom filters
$ewrpt_CustomFilters = array();
?>
<?php
$EW_REPORT_FIELD_TITULO_SQL_SELECT = "SELECT DISTINCT archivos.titulo FROM " . $EW_REPORT_TABLE_SQL_FROM;
$EW_REPORT_FIELD_TITULO_SQL_ORDERBY = "archivos.titulo";
$EW_REPORT_FIELD_USER_SQL_SELECT = "SELECT DISTINCT usuarios.NombreCompleto FROM " . $EW_REPORT_TABLE_SQL_FROM;
$EW_REPORT_FIELD_USER_SQL_ORDERBY = "usuarios.NombreCompleto";
$EW_REPORT_FIELD_GRUPO_SQL_SELECT = "SELECT DISTINCT `grupo` FROM " . $EW_REPORT_TABLE_SQL_FROM;
$EW_REPORT_FIELD_GRUPO_SQL_ORDERBY = "`grupo`";
?>
<?php

// Field variables
$x_fecha_descarga = NULL;
$x_titulo = NULL;
$x_User = NULL;
$x_fecha = NULL;
$x_grupo = NULL;

// Detail variables
$o_fecha_descarga = NULL; $t_fecha_descarga = NULL; $ft_fecha_descarga = 135; $rf_fecha_descarga = NULL; $rt_fecha_descarga = NULL;
$o_titulo = NULL; $t_titulo = NULL; $ft_titulo = 200; $rf_titulo = NULL; $rt_titulo = NULL;
$o_User = NULL; $t_User = NULL; $ft_User = 200; $rf_User = NULL; $rt_User = NULL;
$o_grupo = NULL; $t_grupo = NULL; $ft_grupo = 200; $rf_grupo = NULL; $rt_grupo = NULL;
?>
<?php

// Filter
$sFilter = "";

// Aggregate variables
// 1st dimension = no of groups (level 0 used for grand total)
// 2nd dimension = no of fields

$nDtls = 5;
$nGrps = 1;
$val = ewrpt_InitArray($nDtls, 0);
$cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
$smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
$mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
$mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
$grandsmry = ewrpt_InitArray($nDtls, 0);
$grandmn = ewrpt_InitArray($nDtls, NULL);
$grandmx = ewrpt_InitArray($nDtls, NULL);

// Set up if accumulation required
$col = array(FALSE, FALSE, FALSE, FALSE, FALSE);

// Set up groups per page dynamically
SetUpDisplayGrps();
$sel_titulo = "";
$seld_titulo = "";
$val_titulo = "";
$sel_User = "";
$seld_User = "";
$val_User = "";
$sel_grupo = "";
$seld_grupo = "";
$val_grupo = "";

// Load default filter values
LoadDefaultFilters();

// Set up popup filter
SetupPopup();

// Extended filter
$sExtendedFilter = "";

// Get dropdown values
GetExtendedFilterValues();

// Set up custom filters
SetupCustomFilters();

// Build extended filter
$sExtendedFilter = GetExtendedFilter();
if ($sExtendedFilter <> "") {
	if ($sFilter <> "")
  		$sFilter = "($sFilter) AND ($sExtendedFilter)";
	else
		$sFilter = $sExtendedFilter;
}

// Build popup filter
$sPopupFilter = GetPopupFilter();

//echo "popup filter: " . $sPopupFilter . "<br>";
if ($sPopupFilter <> "") {
	if ($sFilter <> "")
		$sFilter = "($sFilter) AND ($sPopupFilter)";
	else
		$sFilter = $sPopupFilter;
}

// Check if filter applied
$bFilterApplied = CheckFilter();

// Get sort
$sSort = getSort();

// Get total count
$sSql = ewrpt_BuildReportSql($EW_REPORT_TABLE_SQL_SELECT, $EW_REPORT_TABLE_SQL_WHERE, $EW_REPORT_TABLE_SQL_GROUPBY, $EW_REPORT_TABLE_SQL_HAVING, $EW_REPORT_TABLE_SQL_ORDERBY, $sFilter, @$sSort);
$nTotalGrps = GetCnt($sSql);
if ($nDisplayGrps <= 0) // Display all groups
	$nDisplayGrps = $nTotalGrps;
$nStartGrp = 1;

// Show header
$bShowFirstHeader = ($nTotalGrps > 0);

//$bShowFirstHeader = TRUE; // Uncomment to always show header
// Set up start position if not export all

if (EW_REPORT_EXPORT_ALL && @$sExport <> "")
    $nDisplayGrps = $nTotalGrps;
else
    SetUpStartGroup(); 

// Get current page records
$rs = GetRs($sSql, $nStartGrp, $nDisplayGrps);
?>
<?php include "phprptinc/header.php"; ?>
<?php if (@$sExport == "") { ?>
<script type="text/javascript">
var EW_REPORT_DATE_SEPARATOR = "/";
if (EW_REPORT_DATE_SEPARATOR == "") EW_REPORT_DATE_SEPARATOR = "/"; // Default date separator
</script>
<script type="text/javascript" src="phprptjs/ewrpt.js"></script>
<script type="text/javascript">

function ewrpt_ValidateExtFilter(form_obj) {
var elm = form_obj.sv1_fecha_descarga;
if (elm && !ewrpt_CheckDate(elm.value)) {
	if (!ewrpt_OnError(elm, "Incorrect date, format = yyyy/mm/dd - Fecha Descarga"))
		return false;
}
var elm = form_obj.sv2_fecha_descarga;
if (elm && !ewrpt_CheckDate(elm.value)) {
	if (!ewrpt_OnError(elm, "Incorrect date, format = yyyy/mm/dd - Fecha Descarga"))
		return false;
}
	return true;
}
</script>
<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-1.css" title="win2k-1" />
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<script type="text/javascript" src="jscalendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
<?php } ?>
<?php if (@$sExport == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<script type="text/javascript">
var EW_REPORT_POPUP_ALL = "(All)";
var EW_REPORT_POPUP_OK = "  OK  ";
var EW_REPORT_POPUP_CANCEL = "Cancel";
var EW_REPORT_POPUP_FROM = "From";
var EW_REPORT_POPUP_TO = "To";
var EW_REPORT_POPUP_PLEASE_SELECT = "Please Select";
var EW_REPORT_POPUP_NO_VALUE = "No value selected!";

// popup fields
<?php $jsdata = ewrpt_GetJsData($val_titulo, $sel_titulo, $ft_titulo) ?>
ewrpt_CreatePopup("RelatF3rio_de_visualizaE7E3o_titulo", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($val_User, $sel_User, $ft_User) ?>
ewrpt_CreatePopup("RelatF3rio_de_visualizaE7E3o_User", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($val_grupo, $sel_grupo, $ft_grupo) ?>
ewrpt_CreatePopup("RelatF3rio_de_visualizaE7E3o_grupo", [<?php echo $jsdata ?>]);
</script>
<div id="RelatF3rio_de_visualizaE7E3o_titulo_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="RelatF3rio_de_visualizaE7E3o_User_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="RelatF3rio_de_visualizaE7E3o_grupo_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if (@$sExport == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?=_("Visualizations report")?>
<?php if (@$sExport == "") { ?>
&nbsp;&nbsp;<a href="RelatF3rio_de_visualizaE7E3osmry.php?export=excel"><?=_("Export to Excel")?></a>
<?php if ($bFilterApplied) { ?>
&nbsp;&nbsp;<a href="RelatF3rio_de_visualizaE7E3osmry.php?cmd=reset"><?=_("Reset All Filters")?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if (@$sExport == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td valign="top"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td valign="top" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if (@$sExport == "") { ?>
<?php
if (EW_REPORT_FILTER_PANEL_OPTION == 2 || (EW_REPORT_FILTER_PANEL_OPTION == 3 && $bFilterApplied) || $sFilter == "0=101") {
	$sButtonImage = "phprptimages/collapse.gif";
	$sDivDisplay = "";
} else {
	$sButtonImage = "phprptimages/expand.gif";
	$sDivDisplay = " style=\"display: none;\"";
}
?>
<a href="javascript:ewrpt_ToggleFilterPanel();" style="text-decoration: none;"><img id="ewrptToggleFilterImg" src="<?php echo $sButtonImage ?>" alt="" width="9" height="9" border="0"></a><span class="phpreportmaker">&nbsp;Filters</span><br /><br />
<div id="ewrptExtFilterPanel"<?php echo $sDivDisplay ?>>
<!-- Search form (begin) -->
<form name="fRelatF3rio_de_visualizaE7E3osummaryfilter" id="fRelatF3rio_de_visualizaE7E3osummaryfilter" action="RelatF3rio_de_visualizaE7E3osmry.php" class="ewForm" onSubmit="return ewrpt_ValidateExtFilter(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?=_("Download date")?></span></td>
		<td><span class="ewRptSearchOpr"><?=_("between")?><input type="hidden" name="so1_fecha_descarga" id="so1_fecha_descarga" value="BETWEEN"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_fecha_descarga" id="sv1_fecha_descarga" value="<?php echo ewrpt_HtmlEncode($sv1_fecha_descarga) ?>"<?php echo ($sClearExtFilter == 'RelatF3rio_de_visualizaE7E3o_fecha_descarga') ? " class=\"ewInputCleared\"" : "" ?>>
<img src="phprptimages/calendar.png" id="csv1_fecha_descarga" alt="" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "sv1_fecha_descarga", // ID of the input field
	showsTime: true, // show time
	ifFormat : "%Y/%m/%d %H:%M:%S", // the date format
	button : "csv1_fecha_descarga" // ID of the button
})
</script>
</span></td>
				<td><span class="ewRptSearchOpr" id="btw1_fecha_descarga" name="btw1_fecha_descarga">&nbsp;and&nbsp;</span></td>
				<td><span class="phpreportmaker" id="btw1_fecha_descarga" name="btw1_fecha_descarga">
<input type="text" name="sv2_fecha_descarga" id="sv2_fecha_descarga" value="<?php echo ewrpt_HtmlEncode($sv2_fecha_descarga) ?>"<?php echo ($sClearExtFilter == 'RelatF3rio_de_visualizaE7E3o_fecha_descarga') ? " class=\"ewInputCleared\"" : "" ?>>
<img src="phprptimages/calendar.png" id="csv2_fecha_descarga" alt="" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "sv2_fecha_descarga", // ID of the input field
	showsTime: true, // show time
	ifFormat : "%Y/%m/%d %H:%M:%S", // the date format
	button : "csv2_fecha_descarga" // ID of the button
})
</script>
</span></td>
			</tr></table>			
		</td>
	</tr>
</table>
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker">
			<input type="Submit" name="Submit" id="Submit" value="Search">&nbsp;
			<input type="Reset" name="Reset" id="Reset" value="Reset">&nbsp;
		</span></td>
	</tr>
</table>
</form>
<!-- Search form (end) -->
</div>
<br />
<?php } ?>
<?php if (defined("EW_REPORT_SHOW_CURRENT_FILTER")) { ?>
<div id="ewrptFilterList">
<?php ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<!-- Report Grid (Begin) -->
<div class="ewGridMiddlePanel">
<table class="ewTable ewTableSeparate" cellspacing="0">
<?php

// Set the last group to display if not export all
if (EW_REPORT_EXPORT_ALL && @$sExport <> "") {
	$nStopGrp = $nTotalGrps;
} else {
	$nStopGrp = $nStartGrp + $nDisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($nStopGrp) > intval($nTotalGrps))
	$nStopGrp = $nTotalGrps;
$nRecCount = 0;

// Get first row
if ($nTotalGrps > 0) {
	GetRow(1);
	$nGrpCount = 1;
}
while (($rs && !$rs->EOF) || $bShowFirstHeader) {

	// Show header
	if ($bShowFirstHeader) {
?>
	<thead>
	<tr>
<?php if (@$sExport <> "") { ?>
		<td valign="bottom" class="ewTableHeader">
		Fecha Descarga
		</td>
<?php } else { ?>
		<td class="ewTableHeader">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr>
			<td>Fecha Descarga</td>
			</tr></table>
		</td>
<?php } ?>
<?php if (@$sExport <> "") { ?>
		<td valign="bottom" class="ewTableHeader">
		Titulo
		</td>
<?php } else { ?>
		<td class="ewTableHeader">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr>
			<td>Titulo</td>
			<td style="width: 20px;" align="right"><a href="#" onClick="ewrpt_ShowPopup(this.name, 'RelatF3rio_de_visualizaE7E3o_titulo', false, '<?php echo $rf_titulo; ?>', '<?php echo $rt_titulo; ?>');return false;" name="x_titulo<?php echo $cnt[0][0]; ?>" id="x_titulo<?php echo $cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt=""></a></td>
			</tr></table>
		</td>
<?php } ?>
<?php if (@$sExport <> "") { ?>
		<td valign="bottom" class="ewTableHeader">
		User
		</td>
<?php } else { ?>
		<td class="ewTableHeader">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr>
			<td>User</td>
			<td style="width: 20px;" align="right"><a href="#" onClick="ewrpt_ShowPopup(this.name, 'RelatF3rio_de_visualizaE7E3o_User', false, '<?php echo $rf_User; ?>', '<?php echo $rt_User; ?>');return false;" name="x_User<?php echo $cnt[0][0]; ?>" id="x_User<?php echo $cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt=""></a></td>
			</tr></table>
		</td>
<?php } ?>
<?php if (@$sExport <> "") { ?>
		<td valign="bottom" class="ewTableHeader">
		Grupo
		</td>
<?php } else { ?>
		<td class="ewTableHeader">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr>
			<td>Grupo</td>
			<td style="width: 20px;" align="right"><a href="#" onClick="ewrpt_ShowPopup(this.name, 'RelatF3rio_de_visualizaE7E3o_grupo', false, '<?php echo $rf_grupo; ?>', '<?php echo $rt_grupo; ?>');return false;" name="x_grupo<?php echo $cnt[0][0]; ?>" id="x_grupo<?php echo $cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt=""></a></td>
			</tr></table>
		</td>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
		$bShowFirstHeader = FALSE;
	}
	$nRecCount++;

		// Set row color
		$sItemRowClass = " class=\"ewTableRow\"";

		// Display alternate color for rows
		if ($nRecCount % 2 <> 1)
			$sItemRowClass = " class=\"ewTableAltRow\"";
?>
	<tr>
		<td<?php echo $sItemRowClass; ?>>
<?php echo ewrpt_ViewValue($x_fecha_descarga) ?>
</td>
		<td<?php echo $sItemRowClass; ?>>
<?php echo ewrpt_ViewValue($x_titulo) ?>
</td>
		<td<?php echo $sItemRowClass; ?>>
<?php echo ewrpt_ViewValue($x_User) ?>
</td>
		<td<?php echo $sItemRowClass; ?>>
<?php echo ewrpt_ViewValue($x_grupo) ?>
</td>
	</tr>
<?php

		// Accumulate page summary
		AccumulateSummary();

		// Get next record
		GetRow(2);
	$nGrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php

	// Get total count from sql directly
	$sSql = ewrpt_BuildReportSql($EW_REPORT_TABLE_SQL_SELECT_COUNT, $EW_REPORT_TABLE_SQL_WHERE, $EW_REPORT_TABLE_SQL_GROUPBY, $EW_REPORT_TABLE_SQL_HAVING, $EW_REPORT_TABLE_SQL_ORDERBY, $sFilter, @$sSort);
	$rstot = $conn->Execute($sSql);
	if ($rstot)
		$rstotcnt = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
	else
		$rstotcnt = 0;

	// Get total from sql directly
	$sSql = ewrpt_BuildReportSql($EW_REPORT_TABLE_SQL_SELECT_AGG, $EW_REPORT_TABLE_SQL_WHERE, $EW_REPORT_TABLE_SQL_GROUPBY, $EW_REPORT_TABLE_SQL_HAVING, $EW_REPORT_TABLE_SQL_ORDERBY, $sFilter, @$sSort);
	$sSql = $EW_REPORT_TABLE_SQL_AGG_PFX . $sSql . $EW_REPORT_TABLE_SQL_AGG_SFX;

	//echo "sql: " . $sSql . "<br>";
	$rsagg = $conn->Execute($sSql);
	if ($rsagg) {
	}
	else {

		// Accumulate grand summary from detail records
		$sSql = ewrpt_BuildReportSql($EW_REPORT_TABLE_SQL_SELECT, $EW_REPORT_TABLE_SQL_WHERE, $EW_REPORT_TABLE_SQL_GROUPBY, $EW_REPORT_TABLE_SQL_HAVING, $EW_REPORT_TABLE_SQL_ORDERBY, "", "");
		$rs = $conn->Execute($sSql);
		if ($rs) {
			GetRow(1);
			while (!$rs->EOF) {
				AccumulateGrandSummary();
				GetRow(2);
			}
		}
	}
?>
<?php if ($nTotalGrps > 0) { ?>
	<!-- tr><td colspan="4"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr class="ewRptGrandSummary"><td colspan="4">Grand Total (<?php echo ewrpt_FormatNumber($rstotcnt,0,-2,-2,-2); ?> Detail Records)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if (@$sExport == "") { ?>
<div class="ewGridLowerPanel">
<form action="RelatF3rio_de_visualizaE7E3osmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td nowrap>
<?php if (!isset($Pager)) $Pager = new cPrevNextPager($nStartGrp, $nDisplayGrps, $nTotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="RelatF3rio_de_visualizaE7E3osmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="RelatF3rio_de_visualizaE7E3osmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="RelatF3rio_de_visualizaE7E3osmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="RelatF3rio_de_visualizaE7E3osmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpreportmaker">&nbsp;<?=_("of") ?> <?php echo $Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpreportmaker"> <?php echo $Pager->FromIndex ?> to <?php echo $Pager->ToIndex ?> of <?php echo $Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($sFilter == "0=101") { ?>
	<span class="phpreportmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpreportmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($nTotalGrps > 0) { ?>
		<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" valign="top" nowrap><span class="phpreportmaker">Groups Per Page&nbsp;
<select name="<?php echo EW_REPORT_TABLE_GROUP_PER_PAGE; ?>" onChange="this.form.submit();" class="phpreportmaker">
<option value="1"<?php if ($nDisplayGrps == 1) echo " selected" ?>>1</option>
<option value="2"<?php if ($nDisplayGrps == 2) echo " selected" ?>>2</option>
<option value="3"<?php if ($nDisplayGrps == 3) echo " selected" ?>>3</option>
<option value="4"<?php if ($nDisplayGrps == 4) echo " selected" ?>>4</option>
<option value="5"<?php if ($nDisplayGrps == 5) echo " selected" ?>>5</option>
<option value="10"<?php if ($nDisplayGrps == 10) echo " selected" ?>>10</option>
<option value="20"<?php if ($nDisplayGrps == 20) echo " selected" ?>>20</option>
<option value="50"<?php if ($nDisplayGrps == 50) echo " selected" ?>>50</option>
<option value="ALL"<?php if (@$_SESSION[EW_REPORT_TABLE_SESSION_GROUP_PER_PAGE] == -1) echo " selected" ?>>All</option>
</select>
		</span></td>
<?php } ?>
	</tr>
</table>
</form>
</div>
<?php } ?>
</td></tr></table>
</div>
<!-- Summary Report Ends -->
<?php if (@$sExport == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td valign="top"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php
$conn->Close();

// display elapsed time
if (defined("EW_REPORT_DEBUG_ENABLED"))
	echo ewrpt_calcElapsedTime($starttime);
?>
<?php include "phprptinc/footer.php"; ?>
<?php

// Accummulate summary
function AccumulateSummary() {
	global $smry, $cnt, $col, $val, $mn, $mx;
	$cntx = count($smry);
	for ($ix = 0; $ix < $cntx; $ix++) {
		$cnty = count($smry[$ix]);
		for ($iy = 1; $iy < $cnty; $iy++) {
			$cnt[$ix][$iy]++;
			if ($col[$iy]) {
				$valwrk = $val[$iy];
				if (is_null($valwrk) || !is_numeric($valwrk)) {

					// skip
				} else {
					$smry[$ix][$iy] += $valwrk;
					if (is_null($mn[$ix][$iy])) {
						$mn[$ix][$iy] = $valwrk;
						$mx[$ix][$iy] = $valwrk;
					} else {
						if ($mn[$ix][$iy] > $valwrk) $mn[$ix][$iy] = $valwrk;
						if ($mx[$ix][$iy] < $valwrk) $mx[$ix][$iy] = $valwrk;
					}
				}
			}
		}
	}
	$cntx = count($smry);
	for ($ix = 1; $ix < $cntx; $ix++) {
		$cnt[$ix][0]++;
	}
}

// Reset level summary
function ResetLevelSummary($lvl) {
	global $smry, $cnt, $col, $mn, $mx, $nRecCount;

	// Clear summary values
	$cntx = count($smry);
	for ($ix = $lvl; $ix < $cntx; $ix++) {
		$cnty = count($smry[$ix]);
		for ($iy = 1; $iy < $cnty; $iy++) {
			$cnt[$ix][$iy] = 0;
			if ($col[$iy]) {
				$smry[$ix][$iy] = 0;
				$mn[$ix][$iy] = NULL;
				$mx[$ix][$iy] = NULL;
			}
		}
	}
	$cntx = count($smry);
	for ($ix = $lvl; $ix < $cntx; $ix++) {
		$cnt[$ix][0] = 0;
	}

	// Clear old values
	// Reset record count

	$nRecCount = 0;
}

// Accummulate grand summary
function AccumulateGrandSummary() {
	global $cnt, $col, $val, $grandsmry, $grandmn, $grandmx;
	@$cnt[0][0]++;
	for ($iy = 1; $iy < count($grandsmry); $iy++) {
		if ($col[$iy]) {
			$valwrk = $val[$iy];
			if (is_null($valwrk) || !is_numeric($valwrk)) {

				// skip
			} else {
				$grandsmry[$iy] += $valwrk;
				if (is_null($grandmn[$iy])) {
					$grandmn[$iy] = $valwrk;
					$grandmx[$iy] = $valwrk;
				} else {
					if ($grandmn[$iy] > $valwrk) $grandmn[$iy] = $valwrk;
					if ($grandmx[$iy] < $valwrk) $grandmx[$iy] = $valwrk;
				}
			}
		}
	}
}

// Get count
function GetCnt($sql) {
	global $conn;

	//echo "sql (GetCnt): " . $sql . "<br>";
	$rscnt = $conn->Execute($sql);
	$cnt = ($rscnt) ? $rscnt->RecordCount() : 0;
	return $cnt;
}

// Get rs
function GetRs($sql, $start, $grps) {
	global $conn;
	$wrksql = $sql . " LIMIT " . ($start-1) . ", " . ($grps);

	//echo "wrksql: (rsgrp)" . $sSql . "<br>";
	$rswrk = $conn->Execute($wrksql);
	return $rswrk;
}

// Get row values
function GetRow($opt) {
	global $rs, $val;
	if (!$rs)
		return;
	if ($opt == 1) { // Get first row
		$rs->MoveFirst();
	} else { // Get next row
		$rs->MoveNext();
	}
	if (!$rs->EOF) {
		$GLOBALS['x_fecha_descarga'] = $rs->fields('fecha_descarga');
		$GLOBALS['x_titulo'] = $rs->fields('titulo');
		$GLOBALS['x_User'] = $rs->fields('User');
		$GLOBALS['x_fecha'] = $rs->fields('fecha');
		$GLOBALS['x_grupo'] = $rs->fields('grupo');
		$val[1] = $GLOBALS['x_fecha_descarga'];
		$val[2] = $GLOBALS['x_titulo'];
		$val[3] = $GLOBALS['x_User'];
		$val[4] = $GLOBALS['x_grupo'];
	} else {
		$GLOBALS['x_fecha_descarga'] = "";
		$GLOBALS['x_titulo'] = "";
		$GLOBALS['x_User'] = "";
		$GLOBALS['x_fecha'] = "";
		$GLOBALS['x_grupo'] = "";
	}
}

//  Set up starting group
function SetUpStartGroup() {
	global $nStartGrp, $nTotalGrps, $nDisplayGrps;

	// Exit if no groups
	if ($nDisplayGrps == 0)
		return;

	// Check for a 'start' parameter
	if (@$_GET[EW_REPORT_TABLE_START_GROUP] != "") {
		$nStartGrp = $_GET[EW_REPORT_TABLE_START_GROUP];
		$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = $nStartGrp;
	} elseif (@$_GET["pageno"] != "") {
		$nPageNo = $_GET["pageno"];
		if (is_numeric($nPageNo)) {
			$nStartGrp = ($nPageNo-1)*$nDisplayGrps+1;
			if ($nStartGrp <= 0) {
				$nStartGrp = 1;
			} elseif ($nStartGrp >= intval(($nTotalGrps-1)/$nDisplayGrps)*$nDisplayGrps+1) {
				$nStartGrp = intval(($nTotalGrps-1)/$nDisplayGrps)*$nDisplayGrps+1;
			}
			$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = $nStartGrp;
		} else {
			$nStartGrp = @$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP];
		}
	} else {
		$nStartGrp = @$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP];	
	}

	// Check if correct start group counter
	if (!is_numeric($nStartGrp) || $nStartGrp == "") { // Avoid invalid start group counter
		$nStartGrp = 1; // Reset start group counter
		$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = $nStartGrp;
	} elseif (intval($nStartGrp) > intval($nTotalGrps)) { // Avoid starting group > total groups
		$nStartGrp = intval(($nTotalGrps-1)/$nDisplayGrps) * $nDisplayGrps + 1; // Point to last page first group
		$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = $nStartGrp;
	} elseif (($nStartGrp-1) % $nDisplayGrps <> 0) {
		$nStartGrp = intval(($nStartGrp-1)/$nDisplayGrps) * $nDisplayGrps + 1; // Point to page boundary
		$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = $nStartGrp;
	}
}

// Set up popup
function SetupPopup() {
	global $conn, $sFilter;

	// Initialize popup
	// Build distinct values for titulo

	$bNullValue = FALSE;
	$bEmptyValue = FALSE;
	$sSql = ewrpt_BuildReportSql($GLOBALS["EW_REPORT_FIELD_TITULO_SQL_SELECT"], $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], $GLOBALS["EW_REPORT_TABLE_SQL_GROUPBY"], $GLOBALS["EW_REPORT_TABLE_SQL_HAVING"], $GLOBALS["EW_REPORT_FIELD_TITULO_SQL_ORDERBY"], $sFilter, "");
	$rswrk = $conn->Execute($sSql);
	while ($rswrk && !$rswrk->EOF) {
		$x_titulo = $rswrk->fields[0];
		if (is_null($x_titulo)) {
			$bNullValue = TRUE;
		} elseif ($x_titulo == "") {
			$bEmptyValue = TRUE;
		} else {
			$t_titulo = $x_titulo;
			ewrpt_SetupDistinctValues($GLOBALS["val_titulo"], $x_titulo, $t_titulo, FALSE);
		}
		$rswrk->MoveNext();
	}
	if ($rswrk)
		$rswrk->Close();
	if ($bEmptyValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_titulo"], EW_REPORT_EMPTY_VALUE, EW_REPORT_EMPTY_LABEL, FALSE);
	if ($bNullValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_titulo"], EW_REPORT_NULL_VALUE, EW_REPORT_NULL_LABEL, FALSE);

	// Build distinct values for User
	$bNullValue = FALSE;
	$bEmptyValue = FALSE;
	$sSql = ewrpt_BuildReportSql($GLOBALS["EW_REPORT_FIELD_USER_SQL_SELECT"], $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], $GLOBALS["EW_REPORT_TABLE_SQL_GROUPBY"], $GLOBALS["EW_REPORT_TABLE_SQL_HAVING"], $GLOBALS["EW_REPORT_FIELD_USER_SQL_ORDERBY"], $sFilter, "");
	$rswrk = $conn->Execute($sSql);
	while ($rswrk && !$rswrk->EOF) {
		$x_User = $rswrk->fields[0];
		if (is_null($x_User)) {
			$bNullValue = TRUE;
		} elseif ($x_User == "") {
			$bEmptyValue = TRUE;
		} else {
			$t_User = $x_User;
			ewrpt_SetupDistinctValues($GLOBALS["val_User"], $x_User, $t_User, FALSE);
		}
		$rswrk->MoveNext();
	}
	if ($rswrk)
		$rswrk->Close();
	if ($bEmptyValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_User"], EW_REPORT_EMPTY_VALUE, EW_REPORT_EMPTY_LABEL, FALSE);
	if ($bNullValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_User"], EW_REPORT_NULL_VALUE, EW_REPORT_NULL_LABEL, FALSE);

	// Build distinct values for grupo
	$bNullValue = FALSE;
	$bEmptyValue = FALSE;
	$sSql = ewrpt_BuildReportSql($GLOBALS["EW_REPORT_FIELD_GRUPO_SQL_SELECT"], $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], $GLOBALS["EW_REPORT_TABLE_SQL_GROUPBY"], $GLOBALS["EW_REPORT_TABLE_SQL_HAVING"], $GLOBALS["EW_REPORT_FIELD_GRUPO_SQL_ORDERBY"], $sFilter, "");
	$rswrk = $conn->Execute($sSql);
	while ($rswrk && !$rswrk->EOF) {
		$x_grupo = $rswrk->fields[0];
		if (is_null($x_grupo)) {
			$bNullValue = TRUE;
		} elseif ($x_grupo == "") {
			$bEmptyValue = TRUE;
		} else {
			$t_grupo = $x_grupo;
			ewrpt_SetupDistinctValues($GLOBALS["val_grupo"], $x_grupo, $t_grupo, FALSE);
		}
		$rswrk->MoveNext();
	}
	if ($rswrk)
		$rswrk->Close();
	if ($bEmptyValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_grupo"], EW_REPORT_EMPTY_VALUE, EW_REPORT_EMPTY_LABEL, FALSE);
	if ($bNullValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_grupo"], EW_REPORT_NULL_VALUE, EW_REPORT_NULL_LABEL, FALSE);

	// Process post back form
	if (count($_POST) > 0) {
		$sName = @$_POST["popup"]; // Get popup form name
		if ($sName <> "") {
		$cntValues = (is_array(@$_POST["sel_$sName"])) ? count($_POST["sel_$sName"]) : 0;
			if ($cntValues > 0) {
				$arValues = ewrpt_StripSlashes($_POST["sel_$sName"]);
				if (trim($arValues[0]) == "") // Select all
					$arValues = EW_REPORT_INIT_VALUE;
				if (!ewrpt_MatchedArray($arValues, $_SESSION["sel_$sName"])) {
					if (HasSessionFilterValues($sName))
						$GLOBALS["sClearExtFilter"] = $sName; // Clear extended filter for this field
				}
				$_SESSION["sel_$sName"] = $arValues;
				$_SESSION["rf_$sName"] = ewrpt_StripSlashes(@$_POST["rf_$sName"]);
				$_SESSION["rt_$sName"] = ewrpt_StripSlashes(@$_POST["rt_$sName"]);
				ResetPager();
			}
		}

	// Get 'reset' command
	} elseif (@$_GET["cmd"] <> "") {
		$sCmd = $_GET["cmd"];
		if (strtolower($sCmd) == "reset") {
			ClearSessionSelection('titulo');
			ClearSessionSelection('User');
			ClearSessionSelection('grupo');
			ResetPager();
		}
	}

	// Load selection criteria to array
	// Get Titulo selected values

	if (is_array(@$_SESSION["sel_RelatF3rio_de_visualizaE7E3o_titulo"])) {
		LoadSelectionFromSession('titulo');
	} elseif (@$_SESSION["sel_RelatF3rio_de_visualizaE7E3o_titulo"] == EW_REPORT_INIT_VALUE) { // Select all
		$GLOBALS["sel_titulo"] = "";
	}

	// Get User selected values
	if (is_array(@$_SESSION["sel_RelatF3rio_de_visualizaE7E3o_User"])) {
		LoadSelectionFromSession('User');
	} elseif (@$_SESSION["sel_RelatF3rio_de_visualizaE7E3o_User"] == EW_REPORT_INIT_VALUE) { // Select all
		$GLOBALS["sel_User"] = "";
	}

	// Get Grupo selected values
	if (is_array(@$_SESSION["sel_RelatF3rio_de_visualizaE7E3o_grupo"])) {
		LoadSelectionFromSession('grupo');
	} elseif (@$_SESSION["sel_RelatF3rio_de_visualizaE7E3o_grupo"] == EW_REPORT_INIT_VALUE) { // Select all
		$GLOBALS["sel_grupo"] = "";
	}
}

// Reset pager
function ResetPager() {

	// Reset start position (reset command)
	global $nStartGrp, $nTotalGrps;
	$nStartGrp = 1;
	$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = $nStartGrp;
}
?>
<?php

// Set up number of groups displayed per page
function SetUpDisplayGrps() {
	global $nDisplayGrps, $nStartGrp;
	$sWrk = @$_GET[EW_REPORT_TABLE_GROUP_PER_PAGE];
	if ($sWrk <> "") {
		if (is_numeric($sWrk)) {
			$nDisplayGrps = intval($sWrk);
		} else {
			if (strtoupper($sWrk) == "ALL") { // display all groups
				$nDisplayGrps = -1;
			} else {
				$nDisplayGrps = 3; // Non-numeric, load default
			}
		}
		$_SESSION[EW_REPORT_TABLE_SESSION_GROUP_PER_PAGE] = $nDisplayGrps; // Save to session

		// Reset start position (reset command)
		$nStartGrp = 1;
		$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = $nStartGrp;
	} else {
		if (@$_SESSION[EW_REPORT_TABLE_SESSION_GROUP_PER_PAGE] <> "") {
			$nDisplayGrps = $_SESSION[EW_REPORT_TABLE_SESSION_GROUP_PER_PAGE]; // Restore from session
		} else {
			$nDisplayGrps = 3; // Load default
		}
	}
}
?>
<?php

// Get extended filter values
function GetExtendedFilterValues() {
}

// Return extended filter
function GetExtendedFilter() {
	$sFilter = "";
	$bPostBack = (count($_POST) > 0);
	$bRestoreSession = TRUE;
	$bSetupFilter = FALSE;

	// Reset extended filter if filter changed
	if ($bPostBack) {

	// Reset search command
	} elseif (@$_GET["cmd"] == "reset") {

		// Load default values
		// Field fecha_descarga

		SetSessionFilterValues($GLOBALS["sv1_fecha_descarga"], $GLOBALS["so1_fecha_descarga"], $GLOBALS["sc_fecha_descarga"], $GLOBALS["sv2_fecha_descarga"], $GLOBALS["so2_fecha_descarga"], 'fecha_descarga');
		$bSetupFilter = TRUE;
	} else {

		// Field fecha_descarga
		if (GetFilterValues($GLOBALS["sv1_fecha_descarga"], $GLOBALS["so1_fecha_descarga"], $GLOBALS["sc_fecha_descarga"], $GLOBALS["sv2_fecha_descarga"], $GLOBALS["so2_fecha_descarga"], 'fecha_descarga')) {
			$bSetupFilter = TRUE;
			$bRestoreSession = FALSE;
		}
	}

	// Restore session
	if ($bRestoreSession) {

		// Field fecha_descarga
		GetSessionFilterValues($GLOBALS["sv1_fecha_descarga"], $GLOBALS["so1_fecha_descarga"], $GLOBALS["sc_fecha_descarga"], $GLOBALS["sv2_fecha_descarga"], $GLOBALS["so2_fecha_descarga"], 'fecha_descarga');
	}

	// Build SQL
	// Field fecha_descarga

	BuildExtendedFilter($sFilter, 'fecha_descarga', 'log_descargas.fecha_descarga', EW_REPORT_DATATYPE_DATE, 9, $GLOBALS["sv1_fecha_descarga"], $GLOBALS["so1_fecha_descarga"], $GLOBALS["sc_fecha_descarga"], $GLOBALS["sv2_fecha_descarga"], $GLOBALS["so2_fecha_descarga"]);

	// Save parms to session
	// Field fecha_descarga

	SetSessionFilterValues($GLOBALS["sv1_fecha_descarga"], $GLOBALS["so1_fecha_descarga"], $GLOBALS["sc_fecha_descarga"], $GLOBALS["sv2_fecha_descarga"], $GLOBALS["so2_fecha_descarga"], 'fecha_descarga');

	// Setup filter
	if ($bSetupFilter) {
	}
	return $sFilter;
}

// Get drop down value from querystring
function GetDropDownValue(&$sv, $parm) {
	if (count($_POST) > 0)
		return FALSE; // Skip post back
	if (isset($_GET["sv_$parm"])) {
		$sv = ewrpt_StripSlashes($_GET["sv_$parm"]);
		return TRUE;
	}
	return FALSE;
}

// Get filter values from querystring
function GetFilterValues(&$sv1, &$so1, &$sc, &$sv2, &$so2, $parm) {
	if (count($_POST) > 0)
		return; // Skip post back
	$got = FALSE;
	if (isset($_GET["sv1_$parm"])) {
		$sv1 = ewrpt_StripSlashes($_GET["sv1_$parm"]);
		$got = TRUE;
	}
	if (isset($_GET["so1_$parm"])) {
		$so1 = ewrpt_StripSlashes($_GET["so1_$parm"]);
		$got = TRUE;
	}
	if (isset($_GET["sc_$parm"])) {
		$sc = ewrpt_StripSlashes($_GET["sc_$parm"]);
		$got = TRUE;
	}
	if (isset($_GET["sv2_$parm"])) {
		$sv2 = ewrpt_StripSlashes($_GET["sv2_$parm"]);
		$got = TRUE;
	}
	if (isset($_GET["so2_$parm"])) {
		$so2 = ewrpt_StripSlashes($_GET["so2_$parm"]);
		$got = TRUE;
	}
	return $got;
}

// Set default ext filter
function SetDefaultExtFilter($parm, $so1, $sv1, $sc, $so2, $sv2) {
	$GLOBALS["sv1d_$parm"] = $sv1; // Default ext filter value 1
	$GLOBALS["sv2d_$parm"] = $sv2; // Default ext filter value 2 (if operator 2 is enabled)
	$GLOBALS["so1d_$parm"] = $so1; // Default search operator 1
	$GLOBALS["so2d_$parm"] = $so2; // Default search operator 2 (if operator 2 is enabled)
	$GLOBALS["scd_$parm"] = $sc; // Default search condition (if operator 2 is enabled)
}

// Apply default ext filter
function ApplyDefaultExtFilter($parm) {
	$GLOBALS["sv1_$parm"] = $GLOBALS["sv1d_$parm"];
	$GLOBALS["sv2_$parm"] = $GLOBALS["sv2d_$parm"];
	$GLOBALS["so1_$parm"] = $GLOBALS["so1d_$parm"];
	$GLOBALS["so2_$parm"] = $GLOBALS["so2d_$parm"];
	$GLOBALS["sc_$parm"] = $GLOBALS["scd_$parm"];
}

// Check if Text Filter applied
function TextFilterApplied($parm) {
	return (strval($GLOBALS["sv1_$parm"]) <> strval($GLOBALS["sv1d_$parm"]) ||
		strval($GLOBALS["sv2_$parm"]) <> strval($GLOBALS["sv2d_$parm"]) ||
		(strval($GLOBALS["sv1_$parm"]) <> "" &&
			strval($GLOBALS["so1_$parm"]) <> strval($GLOBALS["so1d_$parm"])) ||
		(strval($GLOBALS["sv2_$parm"]) <> "" &&
			strval($GLOBALS["so2_$parm"]) <> strval($GLOBALS["so2d_$parm"])) ||
		strval($GLOBALS["sc_$parm"]) <> strval($GLOBALS["scd_$parm"]));
}

// Check if Non-Text Filter applied
function NonTextFilterApplied($parm) {
	if (is_array($GLOBALS["svd_$parm"]) && is_array($GLOBALS["sv_$parm"])) {
		if (count($GLOBALS["svd_$parm"]) <> count($GLOBALS["sv_$parm"]))
			return TRUE;
		else
			return (count(array_diff($GLOBALS["svd_$parm"], $GLOBALS["sv_$parm"])) <> 0);
	}
	else {
		$v1 = strval($GLOBALS["svd_$parm"]);
		if ($v1 == EW_REPORT_INIT_VALUE)
			$v1 = "";
		$v2 = strval($GLOBALS["sv_$parm"]);
		if ($v2 == EW_REPORT_INIT_VALUE || $v2 == EW_REPORT_ALL_VALUE)
			$v2 = "";
		return ($v1 <> $v2);
	}
}

// Load selection from a filter clause
function LoadSelectionFromFilter($parm, $filter, &$sel) {
	$sel = "";
	if ($filter <> "") {

//		$sSql = ewrpt_BuildReportSql($GLOBALS["EW_REPORT_FIELD_" . strtoupper($parm) . "_SQL_SELECT"], $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], $GLOBALS["EW_REPORT_TABLE_SQL_GROUPBY"], $GLOBALS["EW_REPORT_TABLE_SQL_HAVING"], $GLOBALS["EW_REPORT_FIELD_" . strtoupper($parm) . "_SQL_ORDERBY"], $filter, "");
		$sSql = ewrpt_BuildReportSql($GLOBALS["EW_REPORT_FIELD_" . strtoupper($parm) . "_SQL_SELECT"], "", "", "", $GLOBALS["EW_REPORT_FIELD_" . strtoupper($parm) . "_SQL_ORDERBY"], $filter, "");
		ewrpt_LoadArrayFromSql($sSql, $sel);
	}
}

// Get dropdown value from session
function GetSessionDropDownValue(&$sv, $parm) {
	GetSessionValue($sv, 'sv_RelatF3rio_de_visualizaE7E3o_' . $parm);
}

// Get filter values from session
function GetSessionFilterValues(&$sv1, &$so1, &$sc, &$sv2, &$so2, $parm) {
	GetSessionValue($sv1, 'sv1_RelatF3rio_de_visualizaE7E3o_' . $parm);
	GetSessionValue($so1, 'so1_RelatF3rio_de_visualizaE7E3o_' . $parm);
	GetSessionValue($sc, 'sc_RelatF3rio_de_visualizaE7E3o_' . $parm);
	GetSessionValue($sv2, 'sv2_RelatF3rio_de_visualizaE7E3o_' . $parm);
	GetSessionValue($so2, 'so2_RelatF3rio_de_visualizaE7E3o_' . $parm);
}

// Get value from session
function GetSessionValue(&$sv, $sn) {
	if (isset($_SESSION[$sn]))
		$sv = $_SESSION[$sn];
}

// Set dropdown value to session
function SetSessionDropDownValue($sv, $parm) {
	$_SESSION['sv_RelatF3rio_de_visualizaE7E3o_' . $parm] = $sv;
}

// Set filter values to session
function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
	$_SESSION['sv1_RelatF3rio_de_visualizaE7E3o_' . $parm] = $sv1;
	$_SESSION['so1_RelatF3rio_de_visualizaE7E3o_' . $parm] = $so1;
	$_SESSION['sc_RelatF3rio_de_visualizaE7E3o_' . $parm] = $sc;
	$_SESSION['sv2_RelatF3rio_de_visualizaE7E3o_' . $parm] = $sv2;
	$_SESSION['so2_RelatF3rio_de_visualizaE7E3o_' . $parm] = $so2;
}

// Check if has Session filter values
function HasSessionFilterValues($parm) {
	return ((@$_SESSION['sv_' . $parm] <> "" && @$_SESSION['sv_' . $parm] <> EW_REPORT_INIT_VALUE) ||
		(@$_SESSION['sv1_' . $parm] <> "" && @$_SESSION['sv1_' . $parm] <> EW_REPORT_INIT_VALUE) ||
		(@$_SESSION['sv2_' . $parm] <> "" && @$_SESSION['sv2_' . $parm] <> EW_REPORT_INIT_VALUE));
}

// Dropdown filter exist
function DropDownFilterExist($FldName, $FldExpression, $FldDataType, $FldDateTimeFormat, $FldVal, $FldOpr) {
	$sWrk = "";
	BuildDropDownFilter($sWrk, $FldName, $FldExpression, $FldDataType, $FldDateTimeFormat, $FldVal, $FldOpr);
	return ($sWrk <> "");
}

// Build dropdown filter
function BuildDropDownFilter(&$FilterClause, $FldName, $FldExpression, $FldDataType, $FldDateTimeFormat, $FldVal, $FldOpr) {
	$sSql = "";
	if (is_array($FldVal)) {
		foreach ($FldVal as $val) {
			$sWrk = getDropDownfilter($FldName, $FldExpression, $FldDataType, $FldDateTimeFormat, $val, $FldOpr);
			if ($sWrk <> "") {
				if ($sSql <> "")
					$sSql .= " OR " . $sWrk;
				else
					$sSql = $sWrk;
			}
		}
	} else {
		$sSql = getDropDownfilter($FldName, $FldExpression, $FldDataType, $FldDateTimeFormat, $FldVal, $FldOpr);
	}
	if ($sSql <> "") {
		if ($FilterClause <> "") $FilterClause = "(" . $FilterClause . ") AND ";
		$FilterClause .= "(" . $sSql . ")";
	}
}

function getDropDownfilter($FldName, $FldExpression, $FldDataType, $FldDateTimeFormat, $FldVal, $FldOpr) {
	$sWrk = "";
	if ($FldVal == EW_REPORT_NULL_VALUE) {
		$sWrk = $FldExpression . " IS NULL";
	} elseif ($FldVal == EW_REPORT_EMPTY_VALUE) {
		$sWrk = $FldExpression . " = ''";
	} else {
		if (substr($FldVal, 0, 2) == "@@") {
			$sWrk = CustomFilter($FldName, $FldExpression, $FldVal);
		} else {
			if ($FldVal <> "" && $FldVal <> EW_REPORT_INIT_VALUE && $FldVal <> EW_REPORT_ALL_VALUE) {
				if ($FldDataType == EW_REPORT_DATATYPE_DATE && $FldOpr <> "") {
					$sWrk = DateFilterString($FldOpr, $FldVal, $FldDataType);
				} else {
					$sWrk = FilterString("=", $FldVal, $FldDataType);
				}
			}
			if ($sWrk <> "") $sWrk = $FldExpression . $sWrk;
		}
	}
	return $sWrk;
}

// Register custom filter
function RegisterCustomFilter($FldName, $FilterName, $DisplayName, $FldExpression, $FunctionName) {
	global $ewrpt_CustomFilters;
	if (!is_array($ewrpt_CustomFilters))
		$ewrpt_CustomFilters = array();
	$ewrpt_CustomFilters[] = array($FldName, $FilterName, $DisplayName, $FldExpression, $FunctionName);
}

// Custom filter
function CustomFilter($FldName, $FldExpression, $FldVal) {
	global $ewrpt_CustomFilters;
	$sWrk = "";
	$sParm = substr($FldVal, 2);
	if (is_array($ewrpt_CustomFilters)) {
		$cntf = count($ewrpt_CustomFilters);
		for ($i = 0; $i < $cntf; $i++) {
			if ($ewrpt_CustomFilters[$i][0] == $FldName && $ewrpt_CustomFilters[$i][1] == $sParm) {
				$sFld = $ewrpt_CustomFilters[$i][3];
				$sFn = $ewrpt_CustomFilters[$i][4];
				$sWrk = $sFn($sFld);
				break;
			}
		}
	}
	return $sWrk;
}

// Extended filter exist
function ExtendedFilterExist($FldName, $FldExpression, $FldDataType, $FldDateTimeFormat, $FldVal1, $FldOpr1, $FldCond, $FldVal2, $FldOpr2) {
	$sExtWrk = "";
	BuildExtendedFilter($sExtWrk, $FldName, $FldExpression, $FldDataType, $FldDateTimeFormat, $FldVal1, $FldOpr1, $FldCond, $FldVal2, $FldOpr2);
	return ($sExtWrk <> "");
}

// Build extended filter
function BuildExtendedFilter(&$FilterClause, $FldName, $FldExpression, $FldDataType, $FldDateTimeFormat, $FldVal1, $FldOpr1, $FldCond, $FldVal2, $FldOpr2) {
	$sWrk = "";
	$FldOpr1 = strtoupper(trim($FldOpr1));
	if ($FldOpr1 == "") $FldOpr1 = "=";
	$FldOpr2 = strtoupper(trim($FldOpr2));
	if ($FldOpr2 == "") $FldOpr2 = "=";
	$wrkFldVal1 = $FldVal1;
	$wrkFldVal2 = $FldVal2;
	if ($FldDataType == EW_REPORT_DATATYPE_BOOLEAN) {
		if ($wrkFldVal1 <> "") $wrkFldVal1 = ($wrkFldVal1 == "1") ? EW_REPORT_TRUE_STRING : EW_REPORT_FALSE_STRING;
		if ($wrkFldVal2 <> "") $wrkFldVal2 = ($wrkFldVal2 == "1") ? EW_REPORT_TRUE_STRING : EW_REPORT_FALSE_STRING;
	} elseif ($FldDataType == EW_REPORT_DATATYPE_DATE) {
		if ($wrkFldVal1 <> "") $wrkFldVal1 = ewrpt_UnFormatDateTime($wrkFldVal1, $FldDateTimeFormat);
		if ($wrkFldVal2 <> "") $wrkFldVal2 = ewrpt_UnFormatDateTime($wrkFldVal2, $FldDateTimeFormat);
	}
	if ($FldOpr1 == "BETWEEN") {
		$IsValidValue = ($FldDataType <> EW_REPORT_DATATYPE_NUMBER ||
			($FldDataType == EW_REPORT_DATATYPE_NUMBER && is_numeric($wrkFldVal1) && is_numeric($wrkFldVal2)));
		if ($wrkFldVal1 <> "" && $wrkFldVal2 <> "" && $IsValidValue)
			$sWrk = $FldExpression . " BETWEEN " . ewrpt_QuotedValue($wrkFldVal1, $FldDataType) .
				" AND " . ewrpt_QuotedValue($wrkFldVal2, $FldDataType);
	} elseif ($FldOpr1 == "IS NULL" || $FldOpr1 == "IS NOT NULL") {
		$sWrk = $FldExpression . " " . $wrkFldVal1;
	} else {
		$IsValidValue = ($FldDataType <> EW_REPORT_DATATYPE_NUMBER ||
			($FldDataType == EW_REPORT_DATATYPE_NUMBER && is_numeric($wrkFldVal1)));
		if ($wrkFldVal1 <> "" && $IsValidValue && ewrpt_IsValidOpr($FldOpr1, $FldDataType))
			$sWrk = $FldExpression . FilterString($FldOpr1, $wrkFldVal1, $FldDataType);
		$IsValidValue = ($FldDataType <> EW_REPORT_DATATYPE_NUMBER ||
			($FldDataType == EW_REPORT_DATATYPE_NUMBER && is_numeric($wrkFldVal2)));
		if ($wrkFldVal2 <> "" && $IsValidValue && ewrpt_IsValidOpr($FldOpr2, $FldDataType)) {
			if ($sWrk <> "")
				$sWrk .= " " . (($FldCond == "OR") ? "OR" : "AND") . " ";
			$sWrk .= $FldExpression . FilterString($FldOpr2, $wrkFldVal2, $FldDataType);
		}
	}
	if ($sWrk <> "") {
		if ($FilterClause <> "") $FilterClause .= " AND ";
		$FilterClause .= "(" . $sWrk . ")";
	}
}

// Return filter string
function FilterString($FldOpr, $FldVal, $FldType) {
	if ($FldOpr == "LIKE" || $FldOpr == "NOT LIKE") {
		return " " . $FldOpr . " " . ewrpt_QuotedValue("%$FldVal%", $FldType);
	} elseif ($FldOpr == "STARTS WITH") {
		return " LIKE " . ewrpt_QuotedValue("$FldVal%", $FldType);
	} else {
		return " $FldOpr " . ewrpt_QuotedValue($FldVal, $FldType);
	}
}

// Return date search string
function DateFilterString($FldOpr, $FldVal, $FldType) {
	$wrkVal1 = DateVal($FldOpr, $FldVal, 1);
	$wrkVal2 = DateVal($FldOpr, $FldVal, 2);
	if ($wrkVal1 <> "" && $wrkVal2 <> "") {
		return " BETWEEN " . ewrpt_QuotedValue($wrkVal1, $FldType) . " AND " . ewrpt_QuotedValue($wrkVal2, $FldType);
	} else {
		return "";
	}
}

// Return date value
function DateVal($FldOpr, $FldVal, $ValType) {

	// Compose date string
	switch (strtolower($FldOpr)) {
	case "year":
		if ($ValType == 1) {
			$wrkVal = "$FldVal-01-01";
		} elseif ($ValType == 2) {
			$wrkVal = "$FldVal-12-31";
		}
		break;
	case "quarter":
		list($y, $q) = explode("|", $FldVal);
		if (intval($y) == 0 || intval($q) == 0) {
			$wrkVal = "0000-00-00";
		} else {
			if ($ValType == 1) {
				$m = ($q - 1) * 3 + 1;
				$m = str_pad($m, 2, "0", STR_PAD_LEFT);
				$wrkVal = "$y-$m-01";
			} elseif ($ValType == 2) {
				$m = ($q - 1) * 3 + 3;
				$m = str_pad($m, 2, "0", STR_PAD_LEFT);
				$wrkVal = "$y-$m-" . ewrpt_DaysInMonth($y, $m);
			}
		}
		break;
	case "month":
		list($y, $m) = explode("|", $FldVal);
		if (intval($y) == 0 || intval($m) == 0) {
			$wrkVal = "0000-00-00";
		} else {
			if ($ValType == 1) {
				$m = str_pad($m, 2, "0", STR_PAD_LEFT);
				$wrkVal = "$y-$m-01";
			} elseif ($ValType == 2) {
				$m = str_pad($m, 2, "0", STR_PAD_LEFT);
				$wrkVal = "$y-$m-" . ewrpt_DaysInMonth($y, $m);
			}
		}
		break;
	case "day":
		$wrkVal = str_replace("|", "-", $FldVal);
	}

	// Add time if necessary
	if (preg_match('/(\d{4}|\d{2})-(\d{1,2})-(\d{1,2})/', $wrkVal)) { // date without time
		if ($ValType == 1) {
			$wrkVal .= " 00:00:00";
		} elseif ($ValType == 2) {
			$wrkVal .= " 23:59:59";
		}
	}

	// Check if datetime
	if (preg_match('/(\d{4}|\d{2})-(\d{1,2})-(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})/', $wrkVal)) { // datetime
		$DateVal = $wrkVal;
	} else {
		$DateVal = "";
	}
	return $DateVal;
}
?>
<?php

// Clear selection stored in session
function ClearSessionSelection($parm) {
	$_SESSION["sel_RelatF3rio_de_visualizaE7E3o_$parm"] = "";
	$_SESSION["rf_RelatF3rio_de_visualizaE7E3o_$parm"] = "";
	$_SESSION["rt_RelatF3rio_de_visualizaE7E3o_$parm"] = "";
}

// Load selection from session
function LoadSelectionFromSession($parm) {
	$GLOBALS["sel_$parm"] = @$_SESSION["sel_RelatF3rio_de_visualizaE7E3o_$parm"];
	$GLOBALS["rf_$parm"] = @$_SESSION["rf_RelatF3rio_de_visualizaE7E3o_$parm"];
	$GLOBALS["rt_$parm"] = @$_SESSION["rt_RelatF3rio_de_visualizaE7E3o_$parm"];
}

// Load default value for filters
function LoadDefaultFilters() {

	/**
	* Set up default values for non Text filters
	*/

	/**
	* Set up default values for extended filters
	* function SetDefaultExtFilter($parm, $so1, $sv1, $sc, $so2, $sv2)
	* Parameters:
	* $parm - Field name
	* $so1 - Default search operator 1
	* $sv1 - Default ext filter value 1
	* $sc - Default search condition (if operator 2 is enabled)
	* $so2 - Default search operator 2 (if operator 2 is enabled)
	* $sv2 - Default ext filter value 2 (if operator 2 is enabled)
	*/

	// Field fecha_descarga
	SetDefaultExtFilter('fecha_descarga', 'BETWEEN', NULL, 'AND', '=', NULL);
	ApplyDefaultExtFilter('fecha_descarga');

	/**
	* Set up default values for popup filters
	* NOTE: if extended filter is enabled, use default values in extended filter instead
	*/

	// Field titulo
	// Setup your default values for the popup filter below, e.g.
	// $seld_titulo = array("val1", "val2");

	$GLOBALS["seld_titulo"] = "";
	$GLOBALS["sel_titulo"] =  $GLOBALS["seld_titulo"];

	// Field User
	// Setup your default values for the popup filter below, e.g.
	// $seld_User = array("val1", "val2");

	$GLOBALS["seld_User"] = "";
	$GLOBALS["sel_User"] =  $GLOBALS["seld_User"];

	// Field grupo
	// Setup your default values for the popup filter below, e.g.
	// $seld_grupo = array("val1", "val2");

	$GLOBALS["seld_grupo"] = "";
	$GLOBALS["sel_grupo"] =  $GLOBALS["seld_grupo"];
}

// Check if filter applied
function CheckFilter() {

	// Check fecha_descarga text filter
	if (TextFilterApplied("fecha_descarga"))
		return TRUE;

	// Check titulo popup filter
	if (!ewrpt_MatchedArray($GLOBALS["seld_titulo"], $GLOBALS["sel_titulo"]))
		return TRUE;

	// Check User popup filter
	if (!ewrpt_MatchedArray($GLOBALS["seld_User"], $GLOBALS["sel_User"]))
		return TRUE;

	// Check grupo popup filter
	if (!ewrpt_MatchedArray($GLOBALS["seld_grupo"], $GLOBALS["sel_grupo"]))
		return TRUE;
	return FALSE;
}

// Show list of filters
function ShowFilterList() {

	// Initialize
	$sFilterList = "";

	// Field fecha_descarga
	$sExtWrk = "";
	$sWrk = "";
	BuildExtendedFilter($sExtWrk, 'fecha_descarga', 'log_descargas.fecha_descarga', EW_REPORT_DATATYPE_DATE, 9, $GLOBALS["sv1_fecha_descarga"], $GLOBALS["so1_fecha_descarga"], $GLOBALS["sc_fecha_descarga"], $GLOBALS["sv2_fecha_descarga"], $GLOBALS["so2_fecha_descarga"]);
	if ($sExtWrk <> "" || $sWrk <> "")
		$sFilterList .= "Fecha Descarga<br />";
	if ($sExtWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
	if ($sWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

	// Field titulo
	$sExtWrk = "";
	$sWrk = "";
	if (is_array($GLOBALS["sel_titulo"]))
		$sWrk = ewrpt_JoinArray($GLOBALS["sel_titulo"], ", ", EW_REPORT_DATATYPE_STRING);
	if ($sExtWrk <> "" || $sWrk <> "")
		$sFilterList .= "Titulo<br />";
	if ($sExtWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
	if ($sWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

	// Field User
	$sExtWrk = "";
	$sWrk = "";
	if (is_array($GLOBALS["sel_User"]))
		$sWrk = ewrpt_JoinArray($GLOBALS["sel_User"], ", ", EW_REPORT_DATATYPE_STRING);
	if ($sExtWrk <> "" || $sWrk <> "")
		$sFilterList .= "User<br />";
	if ($sExtWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
	if ($sWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

	// Field grupo
	$sExtWrk = "";
	$sWrk = "";
	if (is_array($GLOBALS["sel_grupo"]))
		$sWrk = ewrpt_JoinArray($GLOBALS["sel_grupo"], ", ", EW_REPORT_DATATYPE_STRING);
	if ($sExtWrk <> "" || $sWrk <> "")
		$sFilterList .= "Grupo<br />";
	if ($sExtWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
	if ($sWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

	// Show Filters
	if ($sFilterList <> "")
		echo "CURRENT FILTERS:<br />$sFilterList";
}

/**
 * Regsiter your Custom filters here
 */

// Setup custom filters
function SetupCustomFilters() {

	// 1. Register your custom filter below (see example)
	// 2. Write your custom filter function (see example fucntions: GetLastMonthFilter, GetStartsWithAFilter)

}

/**
 * Write your Custom filters here
 */

// Filter for 'Last Month' (example)
function GetLastMonthFilter($FldExpression) {
	$today = getdate();
	$lastmonth = mktime(0, 0, 0, $today['mon']-1, 1, $today['year']);
	$sVal = date("Y|m", $lastmonth);
	$sWrk = $FldExpression . " BETWEEN " .
		ewrpt_QuotedValue(DateVal("month", $sVal, 1), EW_REPORT_DATATYPE_DATE) .
		" AND " .
		ewrpt_QuotedValue(DateVal("month", $sVal, 2), EW_REPORT_DATATYPE_DATE);
	return $sWrk;
}

// Filter for 'Starts With A' (example)
function GetStartsWithAFilter($FldExpression) {
	return $FldExpression . " LIKE 'A%'";
}
?>
<?php

// Return poup filter
function GetPopupFilter() {
	$sWrk = "";
	if (is_array($GLOBALS["sel_titulo"])) {
		if ($sWrk <> "") $sWrk .= " AND ";
		$sWrk .= ewrpt_FilterSQL($GLOBALS["sel_titulo"], "archivos.titulo", EW_REPORT_DATATYPE_STRING, $GLOBALS["af_titulo"]);
	}
	if (is_array($GLOBALS["sel_User"])) {
		if ($sWrk <> "") $sWrk .= " AND ";
		$sWrk .= ewrpt_FilterSQL($GLOBALS["sel_User"], "usuarios.NombreCompleto", EW_REPORT_DATATYPE_STRING, $GLOBALS["af_User"]);
	}
	if (is_array($GLOBALS["sel_grupo"])) {
		if ($sWrk <> "") $sWrk .= " AND ";
		$sWrk .= ewrpt_FilterSQL($GLOBALS["sel_grupo"], "`grupo`", EW_REPORT_DATATYPE_STRING, $GLOBALS["af_grupo"]);
	}
	return $sWrk;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function getSort
// - Return Sort parameters based on Sort Links clicked
// - Variables setup: Session[EW_REPORT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
function getSort()
{

	// Check for a resetsort command
	if (strlen(@$_GET["cmd"]) > 0) {
		$sCmd = @$_GET["cmd"];
		if ($sCmd == "resetsort") {
			$_SESSION[EW_REPORT_TABLE_SESSION_ORDER_BY] = "";
			$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = 1;
			$_SESSION["sort_RelatF3rio_de_visualizaE7E3o_fecha_descarga"] = "";
			$_SESSION["sort_RelatF3rio_de_visualizaE7E3o_titulo"] = "";
			$_SESSION["sort_RelatF3rio_de_visualizaE7E3o_User"] = "";
			$_SESSION["sort_RelatF3rio_de_visualizaE7E3o_grupo"] = "";
		}

	// Check for an Order parameter
	} elseif (strlen(@$_GET[EW_REPORT_TABLE_ORDER_BY]) > 0) {
		$sSortSql = "";
		$sSortField = "";
		$sOrder = @$_GET[EW_REPORT_TABLE_ORDER_BY];
		if (strlen(@$_GET[EW_REPORT_TABLE_ORDER_BY_TYPE]) > 0) {
			$sOrderType = @$_GET[EW_REPORT_TABLE_ORDER_BY_TYPE];
		} else {
			$sOrderType = "";
		}
	}
	return @$_SESSION[EW_REPORT_TABLE_SESSION_ORDER_BY];
}
?>
