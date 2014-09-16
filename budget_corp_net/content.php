<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php find_selected()  ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
     <td id="navigation">
		<?php echo navigation($sel_project_category,$sel_project); ?>
		</br>
		<?php /*<a href="create_project.php"> + Add a new project</a>*/?>
                <a href="ProjectCreateView.php"> + Add a new project</a>
                <br/>
                <a href="staff.php"> + Go to staff menu.</a>
                <br/>
                <a href="LoginView.php"> + Log out</a>
     </td>
	 <td id="categories">
	 <?php if (!is_null($sel_project)){ // project selected ?>
		<h2><?php echo $sel_project['description']; ?></h2>
	 <?php } elseif (!is_null($sel_project_category)) { // project category selected ?>
		<h2><?php echo $sel_project_category['description']; ?></h2>
	 <?php } else { // nathing selected ?>
		<h2>Projects area.</h2>
		
        <?php } ?>
        </td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>
