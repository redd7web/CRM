<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
</head>

<?php
$con=mysqli_connect("localhost","user","password","company");

$con_data = mysqli_connect("localhost","user","password","readings");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//upload the data file to our server
$uploaddir = '/var/www/upload/';
$uploadfile = $uploaddir . basename($_FILES['file']['name'].$random);

$macaddress = strstr($_FILES['file']['name'], '.', true);



if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    //echo "Possible file upload attack!\n";
}

//get the data
$file=fopen($uploadfile,"r") or exit("Unable to open file!");
while (!feof($file))
{
    $string =  fgets($file);
    $arr = explode("2014", $string);
    $arr[1] = "2014" . $arr[1];

    $column = explode(",", $arr[0]);
    $data = explode(",", $arr[1]);

}
fclose($file);

//insert the name of meter
$datasource = $_POST["datasource"];
//$res = explode("_", $datasource);

$query = "SELECT * FROM `company_meters` WHERE macaddress = '".strtolower($macaddress)."'";
$result = mysqli_query($con, $query);

$query="SELECT * FROM `pre_approve_meters` WHERE macaddress = '".strtolower($macaddress)."', AND company='".strtolower($datasource)."'";
$res = mysqli_query($con, $query);
if(mysqli_num_rows($res)){
    $approve = 1;
}
else{
    $approve = 0;
}
if(!mysqli_num_rows($result)){
    $query = "INSERT INTO `company_meters` (`id`,`company`,`macaddress`,`name`,`approve`)
                                         VALUES (NULL, '" . strtolower($datasource)."','".strtolower($macaddress)."','Acuvim II',".$approve.")";
    mysqli_query($con, $query);
}

//if(in_array("Vnavg_V", $arr[0])){
    //get Acuvim II data column
    $querystring = "";
    $file=fopen("/var/www/upload/Acuvim II.csv","r") or exit("Unable to open file!");
    while (!feof($file))
    {
        $string =  fgets($file);
        $columntitle = explode(",", $string);

        for($i=1;$columntitle[$i];$i++){
            $querystring .= $columntitle[$i] . " varchar(20) NOT NULL, ";
        }

    }
    fclose($file);
//}
//check if the meter is in the approved list and is approved
$query ="SELECT * FROM company_meters WHERE macaddress ='".$macaddress."' AND approve = 1";
$res = mysqli_query($con, $query);

if(mysqli_num_rows($res)){
	//create table if the table does not exist
	$sql = "CREATE TABLE IF NOT EXISTS `readings_". $macaddress. "` (
	   `id` int(11) unsigned NOT NULL auto_increment,
	   `time` datetime NOT NULL,"
	    .$querystring.
	    "PRIMARY KEY  (`id`)
	   )";

	mysqli_query($con_data,$sql);

	$querystring1 = "";
	for($i=0;$column[$i];$i++){
	    $querystring1 .= ", ". $column[$i];
	}
	$querystring2 = "";
	for($i=0;$data[$i]!=null;$i++){
	    $querystring2 .= ",'". $data[$i]. "'";
	}


    $query = "INSERT INTO `readings_". $macaddress ."` (`id`".$querystring1.")
                                         VALUES (NULL" . $querystring2.")";

    mysqli_query($con_data, $query);
}
?>
