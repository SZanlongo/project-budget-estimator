<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php

class ProjectCategory 
{
    // instance variables
    private $projectCategId;
    private $projectID;
    private $categoryID;

    public function ProjectCategory() {}

    /**
     * Set the global variable $projectID
     * @param type $pID 
     */
    public function setProjectID($pID) { $this->projectID = $pID; }   
    
     /**
     * Set the global variable $categoryID
     * @param type $pID 
     */
    public function setCategoryID($cID) { $this->categoryID = $cID; }

    /**
     * Returns the global variable $projectCategId
     * @return type integer
     */  
    public function getProjectCategID() { return $this->projectCategId;}
    
    
    /**
     * Returns the global variable $ProjectId
     * @return type integer
     */ 
    public function getProjectID() { return $this->projectID;}
    
    
    /**
     * Returns the global variable $CategoryId
     * @return type integer
     */ 
    public function getCategoryID() { return $this->categoryID;}
    
    /**
     * Creates a new category for a project.
     * Called in ProjectCategoryController.
     * @global type $connection 
     */
    public function create()
    {
        global $connection;
        $projectID = $this->getProjectID();
        $categoryID = $this->getCategoryID();

        $query = "INSERT INTO project_category (project_id, category_id)
                    VALUES ('{$projectID}', '{$categoryID}')";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("ProjectCategoryCreateView.php");
    }// end create()

    // this function update the projectCategory. No is called
    
    /**
     * Updates an existing project category in the 
     * project_category table in the database.
     * Called in ProjectCategoryDeleteController
     * @global type $connection
     * @param type $proj_category_id 
     */
    public function update($proj_category_id) 
    {
        global $connection;
        
        $projectID = $this->getProjectID();
        $categoryID = $this->getCategoryID();
        
        $query = "UPDATE project_category 
                SET project_id = '{$projectID}', category_id = '{$categoryID}'
                WHERE category_id = {$proj_category_id}";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        redirect_to("ProjectCategoryCreateView.php");
    }// end update($proj_category_id)

    
     /**
     * Deletes an existing project category in the 
     * project_category table in the database.
     * Called in ProjectCategoryDeleteController.
     * @global type $connection
     * @param type $proj_category_id 
     */
    public function delete($proj_category_id) 
    {
        global $connection;
        $query = "DELETE FROM project_category WHERE project_category_id = {$proj_category_id} LIMIT 1";
	$result = mysql_query($query, $connection);
        confirm_query($result);
	redirect_to("content.php");	
        
    }// end delete($proj_category_id)

    /**
     *
     * @global type $connection
     * @param type $project_category_id.
     * Called in ProjectCategoryDeleteController.
     * @return type String 
     * @return null 
     * 
     */
    function get_project_category_by_id($project_category_id) 
    {
        global $connection;       	
		$query = "SELECT project_category.project_category_id, 
				project_category.project_id, 
				project_category.category_id, category.description ";
		$query .= "FROM project_category , category ";
		$query .= "WHERE project_category_id = $project_category_id "; 
		$query .= "AND project_category.category_id = category.category_id ";
		$query .= "LIMIT 1";
				
        $result_set = mysql_query($query, $connection);
        confirm_query($result_set);
        if($project_category = mysql_fetch_array($result_set)) { return $project_category; } else { return NULL; }
    }// end get_project_category_by_id($project_category_id)
   
// end getEmployeeList()
}

?>