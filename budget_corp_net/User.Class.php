<?php require_once("includes/connection.php"); ?> 
<?php require_once("includes/functions.php"); ?>
<?php
class User
{
    private $userID;
    private $uName;
    private $uPassword;
    
    /**
     *  Default constructor
     */
    public function User(){} 
       
    /**
     * Username setter
     * @param type $name String
     */    
    public function setName($name) { $this->uName = $name; } 
    
     /**
     * User password setter
     * @param type $name String
     */  
    public function setPassword($password) { $this->uPassword = $password; }
    
    /**
     * Return the id of a user that
     * was retreived before from the database
     * @return type integer
     */
    public function getId() { return $this->userId; } 
    
       /**
     * Return the username of a user that
     * was retreived before from the database
     * @return type String
     */
    public function getName() { return $this->uName; } 
    
       /**
     * Return the password of a user that
     * was retreived before from the database
     * @return type String
     */
    public function getPassword() { return $this->uPassword; }    
        
    /**
     * This function creates a User and inserts it in the User table
     * in the database. Called in UserController
     * @global type $connection 
     */
    public function create()
    {
        global $connection;
        $name = $this->getName();
        $password = $this->getPassword();
        $query = "INSERT INTO user (name, password)
                    VALUES ('{$name}','{$password}')";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        /*if (mysql_affected_rows() == 1)
        {
                // Success
                $message = "The user was successfully created.";
        } else {
                // Failed
                $message = "The user creation failed.";
                $message .= "<br />". mysql_error();
        }
        $errors[] = $message;
        session_start();                
        $_SESSION['errors'] = $errors;*/
        redirect_to("LoginView.php");
    } // end create()
    
    
    /**
     * validates whether the user is admin or regular user
     * @global type $connection 
     */
     public function validate()
    {   
        global $connection;
       	$name = $this->getName();
        $password = $this->getPassword();
        
        $query = "SELECT *FROM user WHERE name = '{$name}' 
        AND password = '{$password}'";
                
        $result = mysql_query($query, $connection);
        confirm_query($result);
        if(mysql_num_rows($result)== 1)
        {
            $user = mysql_fetch_array($result);
            $name = $user[1];
            if($name == "admin")
            {
                redirect_to("staff.php");
            }else{
                redirect_to("content.php");
            }
        }else{
            $message = "Username/password combination incorrect.<br/>
            Please make sure your caps lock key is off and try again.";
            $errors[] = $message;
            session_start();                
            $_SESSION['errors'] = $errors;
            redirect_to("LoginView.php");
       }
        
    }// end validate()
}
?>    
