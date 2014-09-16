<?php require_once ("ProjectCategoryDetail.Class.php"); ?>
<?php
	if (intval($_GET['proj_categ_detail']) == 0) {
		redirect_to("content.php");
	}        
        $projectCategoryDetail = new ProjectCategoryDetail();
	$pCatDetID = mysql_prep($_GET['proj_categ_detail']);
        $projectCategoryDetail->delete($pCatDetID);        
?>
