<?php 
include "source/css.php";
$logger = new Person();
?>
<style type="text/css">
.tableNavigation {
    width:1000px;
    text-align:center;
    margin:auto;
}
.tableNavigation ul {
    display:inline;
    width:1000px;
}
.tableNavigation ul li {
    display:inline;
    margin-right:5px;
}

td{
    background:transparent;
    border:0px solid #bbb;  
    padding:0px 0px 0px 0px;  
}

tr.even{
    background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);
}

tr.odd{
    background:transparent;
}
.setThisRoute{ 
    z-index:9999;
}


</style>
<script>

$(document).ready(function(){
   $('#myTable').dataTable(); 
});
</script>

<table style="width: 100%;margin:auto;" >
  <tr><th colspan="3" style="height: 20px;"><img id="competitor_add" src="img/add_item.big.gif" />&nbsp;</th></tr>
</table>


<table style="width: 100%;margin:auto;" id="myTable">

<thead>

  
  
  <tr style="background:url(img/biotanestrip.jpg) repeat-x left top;background-size:contain;">
      <th style="width:5%;border:1px solid #000000;padding:0px 0px 0px 0px;">Entry ID</th>
      <th style="width:10%;border:1px solid #000000;padding:0px 0px 0px 0px;">Name</th>
      <th style="width:5%;border:1px solid #000000;padding:0px 0px 0px 0px;">Email</th>
      <th style="width:7%;underline;border:1px solid #000000;padding:0px 0px 0px 0px;">Address</th>
      <th style="width:5%;border:1px solid #000000;padding:0px 0px 0px 0px;">City</th>
      <th style="width:5%;border:1px solid #000000;padding:0px 0px 0px 0px;">State</th>
      <th style="width:5%;border:1px solid #000000;padding:0px 0px 0px 0px;">Zip Code</th>
                    <th class="cell_label" style="width:5%;">Active</th>
                 </tr>
                 </thead>
                 <tbody>
                 
                  <?php 
                  $alter ="";
                  if(!isset($_GET['filter'])){
                    $result = $db->get($dbprefix."_competitors","*");
                  }
                  $header_again = 0;
                  if(count($result)) { 
                    foreach($result as $request){
                        $alter++;
            
                        if($alter%2 == 0){
                            $bg = '-moz-linear-gradient(center top , #F7F7F9, #E5E5E7) repeat scroll 0 0 rgba(0, 0, 0, 0)';
                        }
                        else { 
                            $bg = 'trnsparent';
                        }
                        
                        //$person = new Person($user['user_id']);
                        echo "<tr style='background:$bg;'>

                            <td><span style='font-size:12px;'>";
                           echo $request['competitor_id'];


                            echo "</span></td>
                            
                            <td class='competitor_edit' id='" . $request['competitor_id'] . "'><span style='font-size:12px;'>$request[name]</span></td>
                            
                            <td style='padding:0px 0px 0px 0px;'>$request[comp_email]</td>
                            
                            <td><span style='font-size:12px;'>$request[address]</span></td>
                            
                            <td><span style='font-size:12px;'>$request[city]</span></td></td>
                            
                            <td id='data_entry'>$request[state]</td>
                                   <td id='data_entry'>$request[zip_code]</td>                     
 
                            <td>";


                            if($request['active'] == 1 ){
                                echo 'Active';
                            } else {
                                echo "Not Active";
                            }

                            echo "</td>

</tr>
";
                        
    }
  } 
?>
 </tbody>                 
</table>
<script>

<?php
if($logger->user_id== 185 || $logger->user_id == 99){
    ?>
        $(".approve").click(function(){
            if(confirm("Are you sure you want to approve this user?")){
                $.post("approve_user.php",{user:$(this).attr('rel')},function(data){
                     alert("User approved! " + data);
                     window.location.reload();
                });
            }
        })
    <?php
}
?>

$(".competitor_edit").click(function(){

    var competitor_id = $(this).attr('id');
    
    Shadowbox.open({
        player: "iframe",
        content: "management/updateCompetitor.php?competitor_id=" + competitor_id,
        width: 700,
        height:500,
        options: {
            modal:   true,
            onClose: function(){window.location.href='<?php echo "/management.php?task=competitor"; ?>' }
        }
    });
});


$("#competitor_add").click(function(){
    Shadowbox.open({
        player: "iframe",
        content: "management/addCompetitor.php",
        width: 700,
        height:500,
        options: {
            modal:   true,
            onClose: function(){window.location.href='<?php echo "/management.php?task=competitor"; ?>' }
        }
    });
});

</script>