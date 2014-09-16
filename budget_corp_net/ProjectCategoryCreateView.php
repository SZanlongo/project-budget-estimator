<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once ("ProjectCategory.Class.php"); ?>
<?php find_selected() ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
<td id="navigation">
        <?php echo navigation($sel_project_category,$sel_project); ?>
        </td>
    <td id="categories">
    <h2>Edit project: <?php echo $sel_project['description']; ?></h2>
    <?php session_start();// output a list of the fields that had errors		
        if (isset($_SESSION['errors'])) { $errors=$_SESSION['errors']; display_errors($errors); session_destroy(); }?>

        <form action="ProjectCategoryController.php?proj=<?php echo
        urlencode($sel_project['project_id']);?>" method="post">
        <p>Category : 
            <select name="description">								
            <?php
                $category_set = get_all_category();						
                while($row = mysql_fetch_array($category_set)){	 echo "<option value=\"{$row['description']}\">{$row['description']}</option>"; }
            ?>						
            </select>
        </p>								
        <br/>
        <input type="submit" name="submit" value="Add category" />									
        </form>

    <a href="javascript:history.back(-1)">Back</a>
</td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>
