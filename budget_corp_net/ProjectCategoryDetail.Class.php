<?php require_once("includes/connection.php"); ?> 
<?php require_once("includes/functions.php"); ?>
<?php
class ProjectCategoryDetail
{
    private $projCategDetailID; 
    private $projCategID;
    private $productID;
    private $quantity;
                   
    public function ProjectCategoryDetail(){} // default constructor
       
    // set methods      
    public function setProjCategID($pCategID) { $this->projCategID = $pCategID; }    
    public function setProductID($pID) { $this->productID = $pID; }    
    public function setQuantity($quantity) { $this->quantity = $quantity; }
    
    // get methods
    public function getProjCategDetailID() { return $this->projCategDetailID; }     
    public function getProjCategID() { return $this->projCategID; }    
    public function getProductID() { return $this->productID; }    
    public function getQuantity() { return $this->quantity; }
    
    // insctanciate object. Called in ProjectCategoryDetailController
    public function create()
    {
        global $connection;
        
        $pCategID = $this->getProjCategID();
        $pID = $this->getProductID();
        $quantity = $this->getQuantity();
       
        $query = "INSERT INTO project_category_detail (project_category_id, product_id, quantity)
                VALUES ( {$pCategID}, {$pID}, {$quantity})";                
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("ProjectCategoryDetailCreateView.php");   
               
    } // end create($selected)
    
    // this function update the projectCategoryDetail. No is called
    public function update($project_category_detail_id)
    {   
        global $connection;
        $pID = $this->getProductID();
        $quantity = $this->getQuantity();
        
        $query = "UPDATE project_category_detail SET
            product_id = '{$pID}', quantity = '{$quantity}' WHERE project_category_detail_id = {$project_category_detail_id}";        
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("ProjectCategoryDetailCreateView.php");	
    }// end update($project_category_detail_id)
    
    // this function delete the projectCategoryDetail. Called in ProjectCategoryDetailDeleteController
    public function delete($project_category_detail_id)
    {
        global $connection;
        $query = "DELETE FROM project_category_detail WHERE project_category_detail_id = {$project_category_detail_id}";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        echo "<script>javascript:history.back(-2);</script>";
    }// end function delete($Supplier_id)
    
    // toString
    public function getProject_category_detail_idList()
    {        
        $table = "project_category_detail"; display_db_table($table, TRUE, "border='1'");
    } // end getProject_category_detail_idList()
    
}

?>    
