<?php
include "protected/global.php";

ini_set("display_errors",0);

if(isset($_SESSION['id'])){ 
    $person = new Person();
    if(isset($_POST['removal_upload'])){
        //print_r($_POST);
        
        
        $sched = new Scheduled_Routes($_POST['schedule_id']);
        //************************create issue****************//
        $issue_pack = array(
            "issue"=>32,
            "account_no"=>$sched->account_number,
            "date_created"=>date("Y-m-d H:i:s"),
            "message"=>$_POST['container_remove_expaination'],
            "assigned_to"=>146,//automatically assigned to Veronica Treminio
            "reported_by"=>$person->user_id,
            "issue_status"=>"new",
            "subject"=>"IWP and Competitor Container(s) At Account",
            "schedule_id"=>$sched->schedule_id,
            "route_id"=>$sched->route_id
        );
        $db->insert("iwp_issues",$issue_pack);
        echo "<b><span style='color:red;'>Competitor Container Request Submitted</span>";
        //************************create issue****************//
        $issue_id = $db->getInsertId();
        foreach ($_FILES['file']['name'] as $f => $name) {     
    	    $temp = explode(".",$_FILES["file"]["name"][$f]);
            $mod = uniqid();
            $newfilename = "container-removal-photo-$sched->account_number-$mod.".$temp[1]; 
            //echo $newfilename."<br/>";
    	    move_uploaded_file($_FILES["file"]["tmp_name"][$f], "container_removal_photos/".$newfilename);
            $container_issue = array(
                "route_id"=>$sched->route_id,
                "schedule_id"=>$sched->schedule_id,
                "account_no"=>$sched->account_number,
                "issue_no"=>$issue_id,
                "comment"=>$_POST['container_remove_expaination'],
                "photo_path"=>$newfilename,
                "competitor_id"=>$_POST['competitor'],
                "submitted_by"=>$person->user_id
            );
            echo "<br>";
            //print_r($container_issue);
            $db->insert("iwp_container_removal_photos",$container_issue);

    	}
        
        
    }



            function getCompetitors($compare = NULL)
            {
                //echo $compare;
                global $dbprefix;
                global $db;
                $selected = "";
                $table = $dbprefix . "_competitors";
                $request = $db->query("SELECT competitor_id, name FROM $table WHERE active = 1 ORDER BY name ASC");
                echo "<select name='competitor' id='competitor'><option value=''>--</option>";
                if (count($request) > 0) {
                    foreach ($request as $competitor) {
                        echo "<option $selected value='$competitor[competitor_id]'>$competitor[name]</option>";

                    }
                }

                echo "</select>";
            }


    ?>
        <form method="POST" action="container_removal_photo_upload.php?schedule=<?php echo $_GET['schedule']."&route=$_GET[route]"; ?>" enctype="multipart/form-data" >
        <table style="width: 100%;margin:auto;" >
        <tr><td><input type="file" name="file[]" id="file" multiple="" accept=".jpg,.jpeg,.gif,.png"  /></td></tr>
        <tr><td><textarea name="container_remove_expaination" style="width: 100%;" placeholder="Please provide a brief explaination of the situation"></textarea><br />
            <input name="schedule_id" type="text" value="<?php echo $_GET['schedule']; ?>" readonly="" hidden/>
            <input name="route_id" type="text" value="<?php echo $_GET['route']; ?>" readonly="" hidden/>
        
        </td></tr>
        <tr><td>Competitor Onsite</td>
            <td><?php getCompetitors(); ?> </td>
        </tr>




        <tr><td style="text-align: right;"><input type="submit" name="removal_upload" id="removal_upload" value="Removal Request"/></td></tr>
        </table>
        </form>
    <?php 
}else{
    echo "Please Log In to submit a photo.";
}

?>
