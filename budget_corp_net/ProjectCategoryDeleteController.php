<?php require_once ("ProjectCategory.Class.php"); ?>
<?php
	if (intval($_GET['project_category_id']) == 0) {
		redirect_to("content.php");
	}        
        $ProjectCategory = new ProjectCategory();
	$pCatID = mysql_prep($_GET['project_category_id']);
        $ProjectCategory->delete($pCatID);        
?>
