<?php
include "protected/global.php";
ini_set("display_errors",1);
if(isset($_POST['upload'])){
    if (!is_dir("$_POST[account]/issue_uploads/")) {
        mkdir("$_POST[account]/issue_uploads/", 0777, true);
    }


                foreach ($_FILES['file']['name'] as $f => $name) {
                    $temp = explode(".", $_FILES["file"]["name"][$f]);
                    $mod = uniqid();
                    $newfilename = "issue-$_POST[route_id]-$_POST[account]$mod." . end($temp);
                    echo $newfilename . "<br/>";
                    move_uploaded_file($_FILES["file"]["tmp_name"][$f], "$_POST[account]/issue_uploads/" . $newfilename);
                    $buffer = array(
                        "route_id" => $_POST['route_id'],
                        "account_id" => $_POST['account'],
                        "image" => "$_POST[account]/issue_uploads/$newfilename"
                    );
                    var_dump($buffer);
                    echo "File(s) Uploaded";
                    //echo "Contract Uploaded<br/>";
                    $db->insert("iwp_issues_uploads", $buffer);

                }



//        switch($_POST['mode']){
//
//
//
//            case "walmart":
//                if (!is_dir("$_POST[account]/proof/")) {
//                    mkdir("$_POST[account]/proof/", 0777, true);
//                }
//
//                foreach ($_FILES['file']['name'] as $f => $name) {
//                    $temp = explode(".", $_FILES["file"]["name"][$f]);
//                    $mod = uniqid();
//                    $newfilename = "proof$_POST[schedule_id]-$_POST[route_id]-$_POST[account]$mod." . end($temp);
//                    echo $newfilename . "<br/>";
//                    move_uploaded_file($_FILES["file"]["tmp_name"][$f], "$_POST[account]/proof/" . $newfilename);
//                    $buffer = array(
//                        "route_id" => $_POST['route_id'],
//                        "account_no" => $_POST['account'],
//                        "schedule_id" => $_POST['schedule_id'],
//                        "image" => "$_POST[account]/proof/$newfilename"
//                    );
//                    //var_dump($buffer);
//                    //echo "Contract Uploaded<br/>";
//                    $db->insert("organics_walmart_pictures", $buffer);
//
//                }
//            break;
//            case "sprouts":
//                if (!is_dir("$_POST[account]/proof/")) {
//                    mkdir("$_POST[account]/proof/", 0777, true);
//                }
//
//                foreach ($_FILES['file']['name'] as $f => $name) {
//            	   $temp = explode(".",$_FILES["file"]["name"][$f]);
//                    $mod = uniqid();
//                    $newfilename = "proof$_POST[schedule_id]-$_POST[route_id]-$_POST[account]$mod.".end($temp);
//                    echo $newfilename."<br/>";
//            	    move_uploaded_file($_FILES["file"]["tmp_name"][$f], "$_POST[account]/proof/".$newfilename);
//                        $buffer = array(
//                        "route_id"=>$_POST['route_id'],
//                        "account_no"=>$_POST['account'],
//                        "schedule_id"=>$_POST['account'],
//                        "image"=>"$_POST[account]/proof/$newfilename"
//                    );
//                    //var_dump($buffer);
//                    //echo "Contract Uploaded<br/>";
//                    $db->insert("organics_organix_pictures",$buffer);
//            	}
//
//
//            break;
//        }
}

?>

<!--    <style>-->
<!--        body{-->
<!--            margin:1px 1px 1px 1px;-->
<!--            padding:1px 1px 1px 1px;-->
<!--        }-->
<!--    </style>-->


    <table>
        <tr>
            <td>

                <form enctype="multipart/form-data" method="post" action="data_entry_pic_upload.php?account=<?php echo $_GET['account']; ?>&route_id=<?php echo $_GET['route_id']; ?>">

                    <input type="text" style="display:none;" name="account" value="<?php echo $_GET['account']; ?>" readonly />
                    <input type="text" style="display:none;" name="route_id" value="<?php echo $_GET['route_id']; ?>"  readonly />
                    <!--    <input type="text" hidden name="schedule_id" value="--><?php //echo $_GET['schedule_id']; ?><!--"  readonly  /><br />-->
                    <!--    <input type="text" hidden name="mode" value="--><?php //echo $_GET['mode']; ?><!--"  readonly /><br />-->
                    <input type="file" name="file[]" multiple accept=".jpg,.jpeg,.gif,.png" /><br />
                    <input type="submit" value="Submit"  name="upload"/><br />
                </form>
            </td>
        </tr>
    </table>
