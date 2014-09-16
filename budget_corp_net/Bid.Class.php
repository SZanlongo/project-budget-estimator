<?php require_once("includes/connection.php"); ?> 
<?php require_once("includes/functions.php"); ?>
<?php
class Bid
{	
    private $projectCategoryDetailID;
    private $suplierID;
    private $bid;
    
    /**
     * Default constructor 
     */
    public function Bid(){} 
       
    /**
     * Sets the global variable $this->projectCategoryDetailID 
     * @param type $projectCategoryDetailID String
     */  
    public function setprojectCategoryDetailID($projectCategoryDetailID) 
        { $this->projectCategoryDetailID = $projectCategoryDetailID; } 
        
        /**
         * Sets the global variable $this->suplierID
         * @param type $suplierID integer 
         */
    public function setSuplierID($suplierID) 
        { $this->suplierID = $suplierID; }   
    
        /**
         *
         * Sets the global variable $this->bid
         * @param type $bid double
         */
    public function setBid($bid) 
        { $this->bid = $bid; }
    
    /**
     * 
     * @return type integer
     */
    public function getprojectCategoryDetailID() 
        { return $this->projectCategoryDetailID; }
    
    /**
     * Returns the global variable $suplierID
     * @return type integer
    */
    public function getSuplierID() 
            { return $this->suplierID; }    
    
   /**
    * Returns the global variable $bid
    * @return type double
    */         
    public function getBid() 
            { return $this->bid; }
    
    
    /**
     * This function creates a new bid item for a specific category 
     * of a project. Called in BidController
     * @global type $connection 
     */
    public function create()
    {
        global $connection;
        $projectCategoryDetailID = $this->getprojectCategoryDetailID();
        $getSuplierID = $this->getSuplierID();
        $getBid = $this ->getBid();                    
        $query = "INSERT INTO bit (project_category_detail_id, supplier_id, bit)
        VALUES ( {$projectCategoryDetailID}, {$getSuplierID}, '{$getBid}')";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        echo "<script>javascript:history.back(-2);</script>";                
    } // end create()
}// end class Bid

?>    
