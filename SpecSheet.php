<?php
	include "protected/global.php";
	ini_set("display_errors",0);
	
	if (is_numeric($_GET[Req_ID])){
		
		$weightCert = mysql_escape_string($_GET[Req_ID]);
		
		
		//Why did using $db not work? 
		$conn = mysqli_connect("localhost", "root", "Ld98Tesn3L2sUm39",  "Inetforms");
		if ($conn-> connect_error){
			die("Connection failed:". $conn-> connect_error);
			}
	
		$sql = "SELECT id FROM ap_form_27963 WHERE element_41 = '$weightCert'";	

		$result = $conn-> query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				
					echo "<a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=27963&entry_id=". $row["id"] ."' target=_blank>Click Here For Product Information Entry</a> ";
					$entry = "'https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=27963&entry_id=". $row["id"] ."'";
					echo"
						<head>
						<title>Spec Sheet Confirmation</title>
						<script>
							window.location.href=$entry
						</script>
						</head>
						<body>
						</body>
						</html>";
			}	
		} else {
			echo "Weight Cert Missing From Product Information Mach Form";
		}
		
		$conn->close();
		
	} else {
		echo "The Weight Cert _GET[Req_ID] is not a number, please confirm the Weight Cert is correct";
	}
?>
