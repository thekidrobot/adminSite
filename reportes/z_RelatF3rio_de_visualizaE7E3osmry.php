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
define("EW_REPORT_TABLE_VAR", "z_RelatF3rio_de_visualizaE7E3o", TRUE);
define("EW_REPORT_TABLE_SESSION_GROUP_PER_PAGE", "z_RelatF3rio_de_visualizaE7E3o_grpperpage", TRUE);
define("EW_REPORT_TABLE_SESSION_START_GROUP", "z_RelatF3rio_de_visualizaE7E3o_start", TRUE);
define("EW_REPORT_TABLE_SESSION_SEARCH", "z_RelatF3rio_de_visualizaE7E3o_search", TRUE);
define("EW_REPORT_TABLE_SESSION_CHILD_USER_ID", "z_RelatF3rio_de_visualizaE7E3o_childuserid", TRUE);
define("EW_REPORT_TABLE_SESSION_ORDER_BY", "z_RelatF3rio_de_visualizaE7E3o_orderby", TRUE);

// Table level SQL
$EW_REPORT_TABLE_SQL_FROM = "archivos Inner Join log_descargas On archivos.id_archivo = log_descargas.id_archivo Inner Join usuarios On log_descargas.id_usuario = usuarios.IdUsuario Inner Join grupos On grupos.idGrupos = log_descargas.id_grupo";
$EW_REPORT_TABLE_SQL_SELECT = "SELECT log_descargas.fecha_descarga, archivos.titulo, usuarios.NombreCompleto As User, grupos.grupos FROM " . $EW_REPORT_TABLE_SQL_FROM;
$EW_REPORT_TABLE_SQL_WHERE = "";
$EW_REPORT_TABLE_SQL_GROUPBY = "";
$EW_REPORT_TABLE_SQL_HAVING = "";
$EW_REPORT_TABLE_SQL_ORDERBY = "archivos.titulo ASC";
$EW_REPORT_TABLE_SQL_USERID_FILTER = "";
$EW_REPORT_TABLE_SQL_CHART_BASE = "";

// Table Level Group SQL
define("EW_REPORT_TABLE_FIRST_GROUP_FIELD", "archivos.titulo", TRUE);
$EW_REPORT_TABLE_SQL_SELECT_GROUP = "SELECT DISTINCT " . EW_REPORT_TABLE_FIRST_GROUP_FIELD . " AS `titulo` FROM " . $EW_REPORT_TABLE_SQL_FROM;

// Table Level Aggregate SQL
$EW_REPORT_TABLE_SQL_SELECT_AGG = "SELECT * FROM " . $EW_REPORT_TABLE_SQL_FROM;
$EW_REPORT_TABLE_SQL_AGG_PFX = "";
$EW_REPORT_TABLE_SQL_AGG_SFX = "";
$EW_REPORT_TABLE_SQL_SELECT_COUNT = "SELECT COUNT(*) FROM " . $EW_REPORT_TABLE_SQL_FROM;
$af_fecha_descarga = NULL; // Popup filter for fecha_descarga
$af_titulo = NULL; // Popup filter for titulo
$af_grupos = NULL; // Popup filter for grupos
$af_User = NULL; // Popup filter for User
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
// Field fecha_descarga

$sv_fecha_descarga = ""; $svd_fecha_descarga = "";
$st_fecha_descarga = "Day";
$sr_fecha_descarga = array();

// Text Extended Filters
// Custom filters

$ewrpt_CustomFilters = array();
?>
<?php
$EW_REPORT_FIELD_TITULO_SQL_SELECT = "SELECT DISTINCT archivos.titulo FROM " . $EW_REPORT_TABLE_SQL_FROM;
$EW_REPORT_FIELD_TITULO_SQL_ORDERBY = "archivos.titulo";
$EW_REPORT_FIELD_FECHA_DESCARGA_SQL_SELECT = "SELECT DISTINCT log_descargas.fecha_descarga FROM " . $EW_REPORT_TABLE_SQL_FROM;
$EW_REPORT_FIELD_FECHA_DESCARGA_SQL_ORDERBY = "log_descargas.fecha_descarga";
?>
<?php

// Field variables
$x_fecha_descarga = NULL;
$x_titulo = NULL;
$x_grupos = NULL;
$x_User = NULL;

// Group variables
$o_titulo = NULL; $g_titulo = NULL; $dg_titulo = NULL; $t_titulo = NULL; $ft_titulo = 200; $gf_titulo = $ft_titulo; $gb_titulo = ""; $gi_titulo = "0"; $gq_titulo = ""; $rf_titulo = NULL; $rt_titulo = NULL;

// Detail variables
$o_fecha_descarga = NULL; $t_fecha_descarga = NULL; $ft_fecha_descarga = 135; $rf_fecha_descarga = NULL; $rt_fecha_descarga = NULL;
$o_grupos = NULL; $t_grupos = NULL; $ft_grupos = 201; $rf_grupos = NULL; $rt_grupos = NULL;
$o_User = NULL; $t_User = NULL; $ft_User = 200; $rf_User = NULL; $rt_User = NULL;
?>
<?php

// Filter
$sFilter = "";

// Aggregate variables
// 1st dimension = no of groups (level 0 used for grand total)
// 2nd dimension = no of fields

$nDtls = 4;
$nGrps = 2;
$val = ewrpt_InitArray($nDtls, 0);
$cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
$smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
$mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
$mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
$grandsmry = ewrpt_InitArray($nDtls, 0);
$grandmn = ewrpt_InitArray($nDtls, NULL);
$grandmx = ewrpt_InitArray($nDtls, NULL);

// Set up if accumulation required
$col = array(FALSE, FALSE, FALSE, FALSE);

// Set up groups per page dynamically
SetUpDisplayGrps();
$sel_titulo = "";
$seld_titulo = "";
$val_titulo = "";
$sel_fecha_descarga = "";
$seld_fecha_descarga = "";
$val_fecha_descarga = "";

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

// Get total group count
$sSql = ewrpt_BuildReportSql($EW_REPORT_TABLE_SQL_SELECT_GROUP, $EW_REPORT_TABLE_SQL_WHERE, $EW_REPORT_TABLE_SQL_GROUPBY, $EW_REPORT_TABLE_SQL_HAVING, $EW_REPORT_TABLE_SQL_ORDERBY, $sFilter, @$sSort);
$nTotalGrps = GetGrpCnt($sSql);
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

// Get current page groups
$rsgrp = GetGrpRs($sSql, $nStartGrp, $nDisplayGrps);

// Init detail recordset
$rs = NULL;
?>
<?php include "phprptinc/header.php"; ?>
<script type="text/javascript">
var EW_REPORT_DATE_SEPARATOR = "/";
if (EW_REPORT_DATE_SEPARATOR == "") EW_REPORT_DATE_SEPARATOR = "/"; // Default date separator
</script>
<script type="text/javascript" src="phprptjs/ewrpt.js"></script>
<script type="text/javascript">

function ewrpt_ValidateExtFilter(form_obj) {
	return true;
}
</script>
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
ewrpt_CreatePopup("z_RelatF3rio_de_visualizaE7E3o_titulo", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($val_fecha_descarga, $sel_fecha_descarga, $ft_fecha_descarga) ?>
ewrpt_CreatePopup("z_RelatF3rio_de_visualizaE7E3o_fecha_descarga", [<?php echo $jsdata ?>]);
</script>
<div id="z_RelatF3rio_de_visualizaE7E3o_titulo_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="z_RelatF3rio_de_visualizaE7E3o_fecha_descarga_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
Report 1
<?php if ($bFilterApplied) { ?>
&nbsp;&nbsp;<a href="z_RelatF3rio_de_visualizaE7E3osmry.php?cmd=reset">Reset All Filters</a>
<?php } ?>
<br /><br />
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
<!-- summary report starts -->
<div id="report_summary">
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
<form name="fz_RelatF3rio_de_visualizaE7E3osummaryfilter" id="fz_RelatF3rio_de_visualizaE7E3osummaryfilter" action="z_RelatF3rio_de_visualizaE7E3osmry.php" class="ewForm" onSubmit="return ewrpt_ValidateExtFilter(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker">Fecha Descarga</span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_fecha_descarga" id="sv_fecha_descarga"<?php echo ($sClearExtFilter == 'z_RelatF3rio_de_visualizaE7E3o_fecha_descarga') ? " class=\"ewInputCleared\"" : "" ?> onchange="this.form.submit();">
		<option value="<?php echo EW_REPORT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($sv_fecha_descarga, EW_REPORT_ALL_VALUE)) echo " selected"; ?>></option>
<?php

// Popup filter
$cntf = is_array($ewrpt_CustomFilters) ? count($ewrpt_CustomFilters) : 0;
$cntd = is_array($sr_fecha_descarga) ? count($sr_fecha_descarga) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;

//if (is_array($ewrpt_CustomFilters)) {
//	$cntf = count($ewrpt_CustomFilters);

	for ($i = 0; $i < $cntf; $i++) {
		if ($ewrpt_CustomFilters[$i][0] == 'fecha_descarga') {
?>
		<option value="<?php echo "@@" . $ewrpt_CustomFilters[$i][1] ?>"<?php if (ewrpt_MatchedFilterValue($sv_fecha_descarga, "@@" . $ewrpt_CustomFilters[$i][1])) echo " selected" ?>><?php echo $ewrpt_CustomFilters[$i][2] ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
//if (is_array($sr_fecha_descarga)) {
//	$cntd = count($sr_fecha_descarga);

	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $sr_fecha_descarga[$i] ?>"<?php if (ewrpt_MatchedFilterValue($sv_fecha_descarga, $sr_fecha_descarga[$i])) echo " selected" ?>><?php echo ewrpt_DropDownDisplayValue($sr_fecha_descarga[$i], $st_fecha_descarga, 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
</table>
</form>
<!-- Search form (end) -->
</div>
<br />
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
	GetGrpRow(1);
	$nGrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $nGrpCount <= $nDisplayGrps) || $bShowFirstHeader) {

	// Show header
	if ($bShowFirstHeader) {
?>
	<thead>
	<tr>
<?php if (@$sExport <> "") { ?>
		<td valign="bottom" class="ewRptGrpHeader1">
		Titulo
		</td>
<?php } else { ?>
		<td class="ewTableHeader">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr>
			<td>Titulo</td>
			<td style="width: 20px;" align="right"><a href="#" onClick="ewrpt_ShowPopup(this.name, 'z_RelatF3rio_de_visualizaE7E3o_titulo', false, '<?php echo $rf_titulo; ?>', '<?php echo $rt_titulo; ?>');return false;" name="x_titulo<?php echo $cnt[0][0]; ?>" id="x_titulo<?php echo $cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt=""></a></td>
			</tr></table>
		</td>
<?php } ?>
<?php if (@$sExport <> "") { ?>
		<td valign="bottom" class="ewTableHeader">
		Fecha Descarga
		</td>
<?php } else { ?>
		<td class="ewTableHeader">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr>
			<td>Fecha Descarga</td>
			<td style="width: 20px;" align="right"><a href="#" onClick="ewrpt_ShowPopup(this.name, 'z_RelatF3rio_de_visualizaE7E3o_fecha_descarga', false, '<?php echo $rf_fecha_descarga; ?>', '<?php echo $rt_fecha_descarga; ?>');return false;" name="x_fecha_descarga<?php echo $cnt[0][0]; ?>" id="x_fecha_descarga<?php echo $cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt=""></a></td>
			</tr></table>
		</td>
<?php } ?>
<?php if (@$sExport <> "") { ?>
		<td valign="bottom" class="ewTableHeader">
		Grupos
		</td>
<?php } else { ?>
		<td class="ewTableHeader">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr>
			<td>Grupos</td>
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
			</tr></table>
		</td>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
		$bShowFirstHeader = FALSE;
	}

	// Build detail SQL
	//$sWhere = EW_REPORT_TABLE_FIRST_GROUP_FIELD . " = " . ewrpt_QuotedValue($x_titulo, EW_REPORT_DATATYPE_STRING);

	$sWhere = ewrpt_DetailFilterSQL(EW_REPORT_TABLE_FIRST_GROUP_FIELD, $x_titulo, EW_REPORT_DATATYPE_STRING, $gb_titulo, $gi_titulo, $gq_titulo);
	if ($sFilter != "")
		$sWhere = "($sFilter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($EW_REPORT_TABLE_SQL_SELECT, $EW_REPORT_TABLE_SQL_WHERE, $EW_REPORT_TABLE_SQL_GROUPBY, $EW_REPORT_TABLE_SQL_HAVING, $EW_REPORT_TABLE_SQL_ORDERBY, $sWhere, @$sSort);

//	echo "sql: " . $sSql . "<br>";
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$nRecCount++;

		// Set row color
		$sItemRowClass = " class=\"ewTableRow\"";

		// Display alternate color for rows
		if ($nRecCount % 2 <> 1)
			$sItemRowClass = " class=\"ewTableAltRow\"";

		// Show group values
		$dg_titulo = $x_titulo;
		if ((is_null($x_titulo) && is_null($o_titulo)) ||
			(($x_titulo <> "" && $o_titulo == $dg_titulo) && !ChkLvlBreak(1))) {
			$dg_titulo = "&nbsp;";
		} elseif (is_null($x_titulo)) {
			$dg_titulo = EW_REPORT_NULL_LABEL;
		} elseif ($x_titulo == "") {
			$dg_titulo = EW_REPORT_EMPTY_LABEL;
		}
?>
	<tr>
		<td class="ewRptGrpField1">
		<?php $t_titulo = $x_titulo; $x_titulo = $dg_titulo; ?>
<?php echo ewrpt_ViewValue($x_titulo) ?>
		<?php $x_titulo = $t_titulo; ?></td>
		<td<?php echo $sItemRowClass; ?>>
<?php echo ewrpt_ViewValue(ewrpt_FormatDateTime($x_fecha_descarga,0)) ?>
</td>
		<td<?php echo $sItemRowClass; ?>>
<?php echo ewrpt_ViewValue(str_replace(chr(10), "<br>", $x_grupos)); ?>
</td>
		<td<?php echo $sItemRowClass; ?>>
<?php echo ewrpt_ViewValue($x_User) ?>
</td>
	</tr>
<?php

		// Accumulate page summary
		AccumulateSummary();

		// Save old group values
		$o_titulo = $x_titulo;

		// Get next record
		GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php

	// Next group
	$o_titulo = $x_titulo; // Save old group value
	GetGrpRow(2);
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
<div class="ewGridLowerPanel">
<form action="z_RelatF3rio_de_visualizaE7E3osmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td nowrap>
<?php if (!isset($Pager)) $Pager = new cPrevNextPager($nStartGrp, $nDisplayGrps, $nTotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="z_RelatF3rio_de_visualizaE7E3osmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="z_RelatF3rio_de_visualizaE7E3osmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="z_RelatF3rio_de_visualizaE7E3osmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="z_RelatF3rio_de_visualizaE7E3osmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpreportmaker">&nbsp;of <?php echo $Pager->PageCount ?></span></td>
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
</td></tr></table>
</div>
<!-- Summary Report Ends -->
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
<?php
$conn->Close();

// display elapsed time
if (defined("EW_REPORT_DEBUG_ENABLED"))
	echo ewrpt_calcElapsedTime($starttime);
?>
<?php include "phprptinc/footer.php"; ?>
<?php

// Check level break
function ChkLvlBreak($lvl) {
	switch ($lvl) {
		case 1:
			return (is_null($GLOBALS["x_titulo"]) && !is_null($GLOBALS["o_titulo"])) ||
				(!is_null($GLOBALS["x_titulo"]) && is_null($GLOBALS["o_titulo"])) ||
				($GLOBALS["x_titulo"] <> $GLOBALS["o_titulo"]);
	}
}

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
	if ($lvl <= 1) $GLOBALS["o_titulo"] = "";

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

// Get group count
function GetGrpCnt($sql) {
	global $conn;

	//echo "sql (GetGrpCnt): " . $sql . "<br>";
	$rsgrpcnt = $conn->Execute($sql);
	$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
	return $grpcnt;
}

// Get group rs
function GetGrpRs($sql, $start, $grps) {
	global $conn;
	$wrksql = $sql . " LIMIT " . ($start-1) . ", " . ($grps);

	//echo "wrksql: (rsgrp)" . $sSql . "<br>";
	$rswrk = $conn->Execute($wrksql);
	return $rswrk;
}

// Get group row values
function GetGrpRow($opt) {
	global $rsgrp;
	if (!$rsgrp)
		return;
	if ($opt == 1) { // Get first group

		//$rsgrp->MoveFirst(); // NOTE: no need to move position
	} else { // Get next group
		$rsgrp->MoveNext();
	}
	if ($rsgrp->EOF) {
		$GLOBALS['x_titulo'] = "";
	} else {
		$GLOBALS['x_titulo'] = $rsgrp->fields('titulo');
	}
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
		$GLOBALS['x_grupos'] = $rs->fields('grupos');
		$GLOBALS['x_User'] = $rs->fields('User');
		$val[1] = $GLOBALS['x_fecha_descarga'];
		$val[2] = $GLOBALS['x_grupos'];
		$val[3] = $GLOBALS['x_User'];
	} else {
		$GLOBALS['x_fecha_descarga'] = "";
		$GLOBALS['x_grupos'] = "";
		$GLOBALS['x_User'] = "";
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
			$g_titulo = $x_titulo;
			$dg_titulo = $x_titulo;
			ewrpt_SetupDistinctValues($GLOBALS["val_titulo"], $g_titulo, $dg_titulo, FALSE);
		}
		$rswrk->MoveNext();
	}
	if ($rswrk)
		$rswrk->Close();
	if ($bEmptyValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_titulo"], EW_REPORT_EMPTY_VALUE, EW_REPORT_EMPTY_LABEL, FALSE);
	if ($bNullValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_titulo"], EW_REPORT_NULL_VALUE, EW_REPORT_NULL_LABEL, FALSE);

	// Build distinct values for fecha_descarga
	$bNullValue = FALSE;
	$bEmptyValue = FALSE;
	$sSql = ewrpt_BuildReportSql($GLOBALS["EW_REPORT_FIELD_FECHA_DESCARGA_SQL_SELECT"], $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], $GLOBALS["EW_REPORT_TABLE_SQL_GROUPBY"], $GLOBALS["EW_REPORT_TABLE_SQL_HAVING"], $GLOBALS["EW_REPORT_FIELD_FECHA_DESCARGA_SQL_ORDERBY"], $sFilter, "");
	$rswrk = $conn->Execute($sSql);
	while ($rswrk && !$rswrk->EOF) {
		$x_fecha_descarga = $rswrk->fields[0];
		if (is_null($x_fecha_descarga)) {
			$bNullValue = TRUE;
		} elseif ($x_fecha_descarga == "") {
			$bEmptyValue = TRUE;
		} else {
			$t_fecha_descarga = ewrpt_FormatDateTime($x_fecha_descarga,0);
			ewrpt_SetupDistinctValues($GLOBALS["val_fecha_descarga"], $x_fecha_descarga, $t_fecha_descarga, FALSE);
		}
		$rswrk->MoveNext();
	}
	if ($rswrk)
		$rswrk->Close();
	if ($bEmptyValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_fecha_descarga"], EW_REPORT_EMPTY_VALUE, EW_REPORT_EMPTY_LABEL, FALSE);
	if ($bNullValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_fecha_descarga"], EW_REPORT_NULL_VALUE, EW_REPORT_NULL_LABEL, FALSE);

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
			ClearSessionSelection('fecha_descarga');
			ResetPager();
		}
	}

	// Load selection criteria to array
	// Get Titulo selected values

	if (is_array(@$_SESSION["sel_z_RelatF3rio_de_visualizaE7E3o_titulo"])) {
		LoadSelectionFromSession('titulo');
	} elseif (@$_SESSION["sel_z_RelatF3rio_de_visualizaE7E3o_titulo"] == EW_REPORT_INIT_VALUE) { // Select all
		$GLOBALS["sel_titulo"] = "";
	}

	// Get Fecha Descarga selected values
	if (is_array(@$_SESSION["sel_z_RelatF3rio_de_visualizaE7E3o_fecha_descarga"])) {
		LoadSelectionFromSession('fecha_descarga');
	} elseif (@$_SESSION["sel_z_RelatF3rio_de_visualizaE7E3o_fecha_descarga"] == EW_REPORT_INIT_VALUE) { // Select all
		$GLOBALS["sel_fecha_descarga"] = "";
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

	// Field fecha_descarga
	$sSelect = "SELECT DISTINCT log_descargas.fecha_descarga FROM " . $GLOBALS["EW_REPORT_TABLE_SQL_FROM"];
	$sOrderBy = "log_descargas.fecha_descarga ASC";
	$wrkSql = ewrpt_BuildReportSql($sSelect, $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], "", "", $sOrderBy, "", "");
	$GLOBALS["sr_fecha_descarga"] = ewrpt_GetDistinctValues($GLOBALS["st_fecha_descarga"], $wrkSql);
}

// Return extended filter
function GetExtendedFilter() {
	$sFilter = "";
	$bPostBack = (count($_POST) > 0);
	$bRestoreSession = TRUE;
	$bSetupFilter = FALSE;

	// Reset extended filter if filter changed
	if ($bPostBack) {

		// Clear dropdown for field fecha_descarga
		if ($GLOBALS["sClearExtFilter"] == 'z_RelatF3rio_de_visualizaE7E3o_fecha_descarga')
			SetSessionDropDownValue(EW_REPORT_INIT_VALUE, 'fecha_descarga');

	// Reset search command
	} elseif (@$_GET["cmd"] == "reset") {

		// Load default values
		// Field fecha_descarga

		SetSessionDropDownValue($GLOBALS["sv_fecha_descarga"], 'fecha_descarga');
		$bSetupFilter = TRUE;
	} else {

		// Field fecha_descarga
		if (GetDropDownValue($GLOBALS["sv_fecha_descarga"], 'fecha_descarga')) {
			$bSetupFilter = TRUE;
			$bRestoreSession = FALSE;
		} elseif ($GLOBALS["sv_fecha_descarga"] <> EW_REPORT_INIT_VALUE && !isset($_SESSION['sv_z_RelatF3rio_de_visualizaE7E3o_fecha_descarga'])) {
			$bSetupFilter = TRUE;
		}
	}

	// Restore session
	if ($bRestoreSession) {

		// Field fecha_descarga
		GetSessionDropDownValue($GLOBALS["sv_fecha_descarga"], 'fecha_descarga');
	}

	// Build SQL
	// Field fecha_descarga

	BuildDropDownFilter($sFilter, 'fecha_descarga', 'log_descargas.fecha_descarga', EW_REPORT_DATATYPE_DATE, 0, $GLOBALS["sv_fecha_descarga"], $GLOBALS["st_fecha_descarga"]);

	// Save parms to session
	// Field fecha_descarga

	SetSessionDropDownValue($GLOBALS["sv_fecha_descarga"], 'fecha_descarga');

	// Setup filter
	if ($bSetupFilter) {

		// Field fecha_descarga
		//$GLOBALS["sel_fecha_descarga"] = "";

		$sWrk = "";
		BuildDropDownFilter($sWrk, 'fecha_descarga', 'log_descargas.fecha_descarga', EW_REPORT_DATATYPE_DATE, 0, $GLOBALS["sv_fecha_descarga"], $GLOBALS["st_fecha_descarga"]);
		LoadSelectionFromFilter('fecha_descarga', $sWrk, $GLOBALS["sel_fecha_descarga"]);
		$_SESSION['sel_z_RelatF3rio_de_visualizaE7E3o_fecha_descarga'] = ($GLOBALS["sel_fecha_descarga"] == "") ? EW_REPORT_INIT_VALUE : $GLOBALS["sel_fecha_descarga"];
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
	GetSessionValue($sv, 'sv_z_RelatF3rio_de_visualizaE7E3o_' . $parm);
}

// Get filter values from session
function GetSessionFilterValues(&$sv1, &$so1, &$sc, &$sv2, &$so2, $parm) {
	GetSessionValue($sv1, 'sv1_z_RelatF3rio_de_visualizaE7E3o_' . $parm);
	GetSessionValue($so1, 'so1_z_RelatF3rio_de_visualizaE7E3o_' . $parm);
	GetSessionValue($sc, 'sc_z_RelatF3rio_de_visualizaE7E3o_' . $parm);
	GetSessionValue($sv2, 'sv2_z_RelatF3rio_de_visualizaE7E3o_' . $parm);
	GetSessionValue($so2, 'so2_z_RelatF3rio_de_visualizaE7E3o_' . $parm);
}

// Get value from session
function GetSessionValue(&$sv, $sn) {
	if (isset($_SESSION[$sn]))
		$sv = $_SESSION[$sn];
}

// Set dropdown value to session
function SetSessionDropDownValue($sv, $parm) {
	$_SESSION['sv_z_RelatF3rio_de_visualizaE7E3o_' . $parm] = $sv;
}

// Set filter values to session
function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
	$_SESSION['sv1_z_RelatF3rio_de_visualizaE7E3o_' . $parm] = $sv1;
	$_SESSION['so1_z_RelatF3rio_de_visualizaE7E3o_' . $parm] = $so1;
	$_SESSION['sc_z_RelatF3rio_de_visualizaE7E3o_' . $parm] = $sc;
	$_SESSION['sv2_z_RelatF3rio_de_visualizaE7E3o_' . $parm] = $sv2;
	$_SESSION['so2_z_RelatF3rio_de_visualizaE7E3o_' . $parm] = $so2;
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
	$_SESSION["sel_z_RelatF3rio_de_visualizaE7E3o_$parm"] = "";
	$_SESSION["rf_z_RelatF3rio_de_visualizaE7E3o_$parm"] = "";
	$_SESSION["rt_z_RelatF3rio_de_visualizaE7E3o_$parm"] = "";
}

// Load selection from session
function LoadSelectionFromSession($parm) {
	$GLOBALS["sel_$parm"] = @$_SESSION["sel_z_RelatF3rio_de_visualizaE7E3o_$parm"];
	$GLOBALS["rf_$parm"] = @$_SESSION["rf_z_RelatF3rio_de_visualizaE7E3o_$parm"];
	$GLOBALS["rt_$parm"] = @$_SESSION["rt_z_RelatF3rio_de_visualizaE7E3o_$parm"];
}

// Load default value for filters
function LoadDefaultFilters() {

	/**
	* Set up default values for non Text filters
	*/

	// Field fecha_descarga
	$GLOBALS["svd_fecha_descarga"] = EW_REPORT_INIT_VALUE;
	$GLOBALS["sv_fecha_descarga"] = $GLOBALS["svd_fecha_descarga"];
	$sWrk = "";
	BuildDropDownFilter($sWrk, 'fecha_descarga', 'log_descargas.fecha_descarga', EW_REPORT_DATATYPE_DATE, 0, $GLOBALS["sv_fecha_descarga"], $GLOBALS["st_fecha_descarga"]);
	LoadSelectionFromFilter('fecha_descarga', $sWrk, $GLOBALS["seld_fecha_descarga"]);

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

	/**
	* Set up default values for popup filters
	* NOTE: if extended filter is enabled, use default values in extended filter instead
	*/

	// Field titulo
	// Setup your default values for the popup filter below, e.g.
	// $seld_titulo = array("val1", "val2");

	$GLOBALS["seld_titulo"] = "";
	$GLOBALS["sel_titulo"] =  $GLOBALS["seld_titulo"];
}

// Check if filter applied
function CheckFilter() {

	// Check fecha_descarga extended filter
	if (NonTextFilterApplied("fecha_descarga"))
		return TRUE;

	// Check fecha_descarga popup filter
	if (!ewrpt_MatchedArray($GLOBALS["seld_fecha_descarga"], $GLOBALS["sel_fecha_descarga"]))
		return TRUE;

	// Check titulo popup filter
	if (!ewrpt_MatchedArray($GLOBALS["seld_titulo"], $GLOBALS["sel_titulo"]))
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
	BuildDropDownFilter($sExtWrk, 'fecha_descarga', 'log_descargas.fecha_descarga', EW_REPORT_DATATYPE_DATE, 0, $GLOBALS["sv_fecha_descarga"], $GLOBALS["st_fecha_descarga"]);
	if (is_array($GLOBALS["sel_fecha_descarga"]))
		$sWrk = ewrpt_JoinArray($GLOBALS["sel_fecha_descarga"], ", ", EW_REPORT_DATATYPE_DATE);
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
	// fecha_descarga (example)
	//RegisterCustomFilter('fecha_descarga', 'LastMonth', 'Last Month', 'log_descargas.fecha_descarga', 'GetLastMonthFilter');

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
	if (!DropDownFilterExist('fecha_descarga', 'log_descargas.fecha_descarga', EW_REPORT_DATATYPE_DATE, 0, $GLOBALS["sv_fecha_descarga"], $GLOBALS["st_fecha_descarga"])) {
	if (is_array($GLOBALS["sel_fecha_descarga"])) {
		if ($sWrk <> "") $sWrk .= " AND ";
		$sWrk .= ewrpt_FilterSQL($GLOBALS["sel_fecha_descarga"], "log_descargas.fecha_descarga", EW_REPORT_DATATYPE_DATE, $GLOBALS["af_fecha_descarga"]);
	}
	}
	if (is_array($GLOBALS["sel_titulo"])) {
		if ($sWrk <> "") $sWrk .= " AND ";
		$sWrk .= ewrpt_FilterSQL($GLOBALS["sel_titulo"], "archivos.titulo", EW_REPORT_DATATYPE_STRING, $GLOBALS["af_titulo"], $GLOBALS["gb_titulo"], $GLOBALS["gi_titulo"], $GLOBALS["gq_titulo"]);
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
			$_SESSION["sort_z_RelatF3rio_de_visualizaE7E3o_titulo"] = "";
			$_SESSION["sort_z_RelatF3rio_de_visualizaE7E3o_fecha_descarga"] = "";
			$_SESSION["sort_z_RelatF3rio_de_visualizaE7E3o_grupos"] = "";
			$_SESSION["sort_z_RelatF3rio_de_visualizaE7E3o_User"] = "";
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
