<?php
$links = array(
    "<a href='https://inet.iwpusa.com/machforms/machform' target='_blank'>Forms Admin Portal</a>"=>"Forms Admin Portal",
	"<a href='https://inet.iwpusa.com/assetAudit.php' target='_blank'>Asset Audit</a>"=>"Asset Audit",
    "<a href='https://inet.iwpusa.com/MissedBreak.php' target='_blank'>Employee Missed Break Form</a>"=>"Employee Missed Break Form",
    "<a href='https://inet.iwpusa.com/JHA.php' target='_blank'>Job Hazard Analysis</a>"=>"Job Hazard Analysis",
    "<a href='https://inet.iwpusa.com/FitnessExam.php' target='_blank'>Pre-Employment Fitness</a>"=>"Pre-Employment Fitness",
    "<a href='https://inet.iwpusa.com/RoadTest.php' target='_blank'>Record of Road Test</a>"=>"Record of Road Test",
    "<a href='https://inet.iwpusa.com/DriveAlong.php' target='_blank'>IWP Driver Ride Along</a>"=>"IWP Driver Ride Along",
    "<a href='https://inet.iwpusa.com/DiscrepancyDash.php' target='_blank'>Discrepancy Dashboard</a>"=>"Discrepancy Dashboard",
    "<a href='https://inet.iwpusa.com/InspecDiscrep.php' target='_blank'>Inspection Discrepancy</a>"=>"Inspection Discrepancy",
    "<a href='https://inet.iwpusa.com/IncidentReport.php' target='_blank'>Incident Report</a>"=>"Incident Report",
    "<a href='https://inet.iwpusa.com/CounselingReport.php' target='_blank'>Counseling Report</a>"=>"Counseling Report",
    "<a href='https://inet.iwpusa.com/DriverInspection.php' target='_blank'>Vehicle/Driver Inspection</a>"=>"Vehicle/Driver Inspection",
	"<a href='https://inet.iwpusa.com/FacilityInspection.php' target='_blank'>Facility Inspection</a>"=>"Facility Inspection",
	"<a href='https://inet.iwpusa.com/PPE_audit.php' target='_blank'>PPE Audit</a>"=>"PPE Audit"
);

?>
<style>
body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
}
</style>

<ul >
    <?php
        arsort($links);
        $x = array_reverse($links);
        foreach($x as $key=>$value){
            echo "<li>$key</li>";
        }
    
    ?>
</ul>