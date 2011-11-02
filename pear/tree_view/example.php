<?php
//	step 1: create the navigation data structure
include("../../Connections/cnxRamp.php");
include './Tree.php';

$tree = &Tree::createFromMySQL(array('host'     => $hostname_cnxRamp,
                                     'user'     => $username_cnxRamp,
                                     'pass'     => $password_cnxRamp,
                                     'database' => $database_cnxRamp,
                                     'query'    => 'SELECT grupos.idGrupos as id,grupos.padre as parent_id, grupos.grupos as text FROM grupos order by padre,idGrupos'));

//	step 2:	initialise the class options
include './TreeMenu.php';
$nodeOptions = array(
 'text'          => '',
 'link'          => '',
 'icon'          => 'folder.gif',
 'expandedIcon'  => 'openfoldericon.png',
 'class'         => '',
 'expanded'      => false,
 'linkTarget'    => '_self',
 'isDynamic'     => 'true',
 'ensureVisible' => 'false',
 );

$options = array(	'structure' => $tree,
					'type' => 'heyes',
					'nodeOptions' => $nodeOptions);

//	step 3: create the HTML_TreeMenu object from the structure
$menu = &HTML_TreeMenu::createFromStructure($options);

//	step 4:	create a DHTML menu (or listbox) from the HTML_TreeMenu object
$treeMenu = &new HTML_TreeMenu_DHTML($menu, array('images' => 'imagesAlt2', 'defaultClass' => 'treeMenuDefault'));
//$treeMenu = &new HTML_TreeMenu_Listbox($menu, array('images' => 'imagesAlt2', 'defaultClass' => 'treeMenuDefault'));
?>
<html>
<head>
	<style type="text/css">
		.treeMenuDefault {
			font-style: italic;
		}
	</style>
	<script src="TreeMenu.js" language="JavaScript" type="text/javascript"></script>
</head>
<body>
<?$treeMenu->printMenu()?>
</body>
</html>