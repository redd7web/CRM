<!DOCTYPE html>
<html>
<head>
	<title>Safety Check Table</title>
	<style type="text/css">
	table {
		border-collapse: collapse;
		width: 500px;
		column-gap: 20px;
		color: #008080;
		font-family: monospace;
		font-size: 25px;
		text-align: left;
	}
	th{
		background-color: #008080;
		color: white;
	}
	tr:nth-child(even) {background-color: #f2f2f2}
	h1 {
		font-family: monospace;
		font-size: 30px;
		text-align: center;
		color: #008080;
	</style>
</head>
<body>
<h1>Employee Safety Training</h1>
<table>
	<caption>Lock Out Tag Out OOS Vehicles</caption>
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Employee Number<th>
		<th>Training Completed</th>
</tr>

<?php
	//Establish connection to database connection is -> mysqli_connect([server], [username], [password], [database])
	$conn = mysqli_connect("localhost", "root", "password1",  "Inetforms");
	//Check to make sure connection to database, if not throw an error 
	if ($conn-> connect_error){
		die("Connection failed:". $conn-> connect_error);
		}
	
	//Create variable of the SQL query
	$sql = "SELECT element_1_1, element_1_2, element_2  FROM ap_form_63687 WHERE element_15 = 2";
	
	//fetch the query by the connection
	$result = $conn-> query($sql);
	
	//Checks to make sure our database table contains at least 1 row
	if ($result-> num_rows > 0) {
		while ($row = $result-> fetch_assoc()){
			echo "<tr><td>". $row["element_1_1"]."</td>"; //First Name
			echo "<td>". $row["element_1_2"]."</td>";	//Last Name
			echo "<td>" . $row["element_2"]."</td>"; //Employee Number
			echo "<td><input type='Checkbox' rel='$row[id]' class='checkbox'></td></tr>"; //Checkbox
			}
		echo "</table>";
		}
		else {
		echo "0 result";
		}
		$conn-> close();
?>

</table>

<script>

$(".checkbox").click(function(){
  if(  $(this).is(":checked") ){
      $.post("update_file.php",{id:$(this).attr('rel'),value:1},function(data){
            alert("Value Changed")
      });
  }else{
    $.post("update_file.php",{id:$(this).attr('rel'),value:2},function(data){
            alert("Value Changed")
      });
  }
   
    
});

//A function that will trigger on checkbox click that will run a SQL update to change the value of element_15 = 1

</script>


</body>
</html>
