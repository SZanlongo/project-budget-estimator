<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
    <td id="categories">
        <h2>Insert user and password.</h2>
        <?php session_start();// output a list of the fields that had errors		
        if (isset($_SESSION['errors'])) { $errors=$_SESSION['errors']; display_errors($errors); session_destroy(); }?>
        <form action="LoginController.php" method="post">
        <table>
            <tr>                
                 <p>User name : <input type="text" name="name" value="" id="name" > 
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" maxlength="30" value="" id="password"/></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Login" /></td>
            </tr>
        </table>
        </form>
    </td>		
</tr>
</table>
<?php require("includes/footer.php"); ?>