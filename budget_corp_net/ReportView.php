<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once ("Employee.Class.php"); ?>

<?php find_selected() ?>
<?php include("includes/header.php"); 
    session_start();
    if (isset($_SESSION['result'])) $result = $_SESSION['result'];
    if (isset($_SESSION['total'])) $total = $_SESSION['total'];
?>
<br/>

<br/>&nbsp;
<table border="3" align="center" width="30%">
    <tr>
        <td><b>Item</b></td>
        <td><b>Quantity</b></td>
        <td><b>Price</b></td>
        <td><b>Subtotal</b></td>
        
    </tr>
    <?php foreach ($result as $row) { ?>
    <tr >	
     <?php
        if ($row) {
            print("<td id=\"category\" align=\"left\" >");
            print($row[3]."</td><td align=\"center\">".$row[4]."</td><td align=\"right\">$".$row[5]."</td><td align=\"right\">$".($row[4]*$row[5]));
            print("</td>");
        }
    ?>
    </tr>
    <?php } ?>
    <tr>
        <td></td><td></td>
        <td><b>Total:</b></td>
        <td align="right">$<?php print($total); ?></td>
    </tr>
</table>

<br/>
<CENTER>
                <a href="ProjectConsolidateView.php"> + Back to consolidate area.</a>
</CENTER>
                
<?php require("includes/footer.php"); ?>