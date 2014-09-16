<?php
    require_once 'Project.Class.php';
    
    $value = intval($_GET['proj']);
    if($value == 0)// test if it is a valid project_id
    { redirect_to("ProjectConsolidateView.php"); }
    $project_id = mysql_prep($_GET['proj']);
    

    $project = new Project();
    $result = $project->getReport($project_id);
    $total  = $project->getTotal($project_id);

    foreach ($result as $row)
        if ($row)
            echo $row[3]."------".$row[4]."------".$row[5]."--------------".($row[4]*$row[5])."<br/>";

    session_start();
    $_SESSION['result'] = $result;
    $_SESSION['total'] = $total;
        
    redirect_to("ReportView.php");;
?>
