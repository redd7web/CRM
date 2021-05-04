<?php include "protected/global.php"; 
ini_set("display_errors",0);
//print_r($_SESSION);
$page = "customers"; 


    
    
    /*
    $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if($_SERVER['HTTP_REFERER'] != $actual_link && !in_assoc($actual_link,$_SESSION['history']) ){
          $_SESSION['page_counter']++;  
        if($_SESSION['page_counter']<5){
            $_SESSION['history'][] = array(
                "url"=>$actual_link,
                "name"=>$account->name_plain
            );
        } else {
            if( $_SESSION['page_counter']%4 == 1  ){
                $_SESSION['history'][0] = array(
                    "url"=>$actual_link,
                    "name"=>$account->name_plain
                );
            } else if( $_SESSION['page_counter']%4 == 2  ){
                $_SESSION['history'][1] = array(
                        "url"=>$actual_link,
                        "name"=>$account->name_plain
                );
            } else if( $_SESSION['page_counter']%4 == 3  ){
                $_SESSION['history'][2] = array(
                        "url"=>$actual_link,
                        "name"=>$account->name_plain
                );
            } else if( $_SESSION['page_counter']%4 == 0  ){
                $_SESSION['history'][3] = array(
                        "url"=>$actual_link,
                        "name"=>$account->name_plain
                );
            }
        }
    }   */ 
    
    $person = new Person();
    
    if($person->division_restriction >=34 && $person->division_restriction <=50){
        $addtn = " AND (division >=34 AND division <=50 ) AND division IN (8) "; 
    }else{
        $addtn ="";
    }
    
    $value = $db->where("account_no",$account->acount_id)->get("iwp_containers");
    //echo "<br/>".$account->acount_id;
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="ReDDaWG" />
    <meta charset="UTF-8" />    
   <?php include "source/css.php"; ?>
   <?php include "source/scripts.php"; ?>
	<title>Customer Management System</title>
    <style>
    ul.navi {
        height:60px;
       position:relative;top:5px;
       left:-40px;
    }
    ul.navi li {
        list-style:none;
        font-style:italic;
        text-transform:uppercase;
        border:1px solid black;
        display: inline;
        height:38px;
        cursor:pointer;
        font-family:tahoma;
        font-size:18px;
        width:auto;
        margin-left:1px;
        padding:10px 10px 10px 10px;
    }
    
    #topfac{
        background:transparent;
        border:0px solid #bbb;
    }
    </style>

</head>

<body>



<?php 
include "source/header.php"; 


if(isset($_SESSION['id'])  ){// are logged in ?
$account = new Account($_GET['id']);


    if (isset($_POST['submitx'])) {
        $run_package = array(
            "account_no" => $account->acount_id,
            "note" => $_POST['running_note'],
            "date" => date("Y-m-d"),
            "author" => $person->user_id
            //"time_called"=>$_POST['time_called']
        );
        $db->insert("iwp_account_notes", $run_package);
    }


    ?>

<div id="wrapper" style="margin-top: 90px;">
<div id="spacer" style="width: 100%;height:10px;">&nbsp;</div>

<div class="content-wrapper" style="min-height:450px;height: auto;">
        
        <div id="fullgray" style="width: 100%;height:30px;background: linear-gradient(#F0F0F0, #CFCFCF) repeat scroll 0 0 rgba(0, 0, 0, 0);border-bottom: 1px solid #808080;margin-bottom:10px;">
            <div id="info_hold" style="width: 100%;margin:auto;height:30px;background:transparent;padding">
            <table style="width:100%;"><tr><td>Account:<span id="hold"><?php echo $account->acount_id; ?></span> </td><td>Created: <?php echo $account->created; ?></td><td>Modified:<?php  ?> </td><td>Record Creator: <?php echo uNumToName($account->class); ?> </td><td>Facility: </td><td id="facx"><?php getFacilityList("topfac",$account->division);  ?></td><td>New Bos #</td><td><?php echo $account->new_bos; ?></td></tr></table>
            </div>
        </div>
        
        <div id="topinfo" style="width: 900px;height:60px;margin:auto;border-right:1px solid black;border-top:1px solid black;border-left:1px solid black;">
            <div class="title-box" style="width: 380px;height:40px;font-weight:bold;font-size:20px;font-family:tahoma;border:1px solid black;padding :5px 5px 5px 5px;float:left;background:rgb(255,255,255);border-top:0px solid black;border-left:0px solid black;">
               <table style="width: 400px;margin-left:0px;height:25px;"><tr><td style="text-align: center;vertical-align:middle;padding:0px 0px 0px 0px;"> <?php echo trim($account->name); ?></td></tr></table>
            </div>
                
            <div class="tabs" style="width:400px;height:60px;float:left;">
                <ul class="navi" style="margin-left: 1px;margin-top:15px;">
                    <li class="account_tab" id="main" style="font-size:15px;border-top-left-radius: 5px;border-top-right-radius:5px;margin-left:1px;text-align:center;border-bottom:0px;background:white;">Main</li>
                    <li class="account_tab" id="map"  style="font-size:15px;border-top-left-radius: 5px;border-top-right-radius:5px;margin-left:1px;text-align:center;border-bottom:0px;background:rgb(242,242,242)">Map</li>
                    <li class="account_tab" id="admin" style="font-size:15px;border-top-left-radius: 5px;border-top-right-radius:5px;margin-left:1px;text-align:center;border-bottom:0px;background:rgb(242,242,242)">Admin</li>
					<li class="account_tab" id="issues" style="font-size:15px;border-top-left-radius: 5px;border-top-right-radius:5px;margin-left:1px;text-align:center;border-bottom:0px;background:rgb(242,242,242)">Issues</li>
                    <li class="account_tab" id="new_bos_group" style="font-size:15px;border-top-left-radius: 5px;border-top-right-radius:5px;margin-left:1px;text-align:center;border-bottom:0px;background:rgb(242,242,242)">Newbos</li>
				</ul>
            </div>
            
            <div class="quicksearch" style="width: 80px;height:60px;float:left;">
                <input type="text" placeholder="Account ID or Name" id="quicks" class="quicks" style="width: 100%;margin-top:30px;" />
            </div>
        </div>
        
        
        <div id="info-box" style="width: 900px;min-height:900px;height:auto;border:1px solid #bbb;margin:auto;border:1px solid #000;margin-bottom:5px;border-top:0px;">
          
          
          
        </div>                
</div>
</div>

<script>

     
$(window).load(function() { 
    $.get("viewAccount-main.php",{id: <?php echo $account->acount_id; ?>},function(data){
                $("#info-box").css("background","none"); 
                $("#info-box").html(data);    
    }); 
}); 



$("#info-box").css("background","url(img/loading.gif) no-repeat center 30px"); 
$("#transparent").hide();


//$("ul.navi li").css('background','rgb(242,242,242)');


//B Changes


$("#issues").click(function(){    
    $.get("viewAccount-issues.php",{id: <?php echo $account->acount_id; ?> },function(data){
        $("#info-box").css("background","none");
        $("#info-box").html(data);
   });
});


//End B Changes



$("#main").click(function(){    
    $.get("viewAccount-main.php",{id: <?php echo $account->acount_id; ?> },function(data){
        $("#info-box").css("background","none");
        $("#info-box").html(data);
   });
});


$("#new_bos_group").click(function(){
    $.get("viewAccount_new_bos_group.php",{id: <?php echo $account->acount_id; ?> },function(data){
        $("#info-box").css("background","none");
        $("#info-box").html(data);
    });
});



$("#admin").click(function(){
    $.get("viewAccount-admin.php",{id: <?php echo $account->acount_id; ?> },function(data){
       $("#info-box").css("background","none");
       $("#info-box").html(data); 
    });
});


$("#map").click(function(){
    $.get("viewAccount-map.php",{id: <?php echo $account->acount_id; ?> },function(data){
        $("#info-box").css("background","none");
        $("#info-box").html(data);
    });
});


$("ul.navi li").click(function(){
   $("#info-box").css("background","url(img/loading.gif) no-repeat center 30px"); 
   $("#info-box").html(""); 
   $("ul.navi li").css({
        borderBottom: "1px solid black",
        color: "black",
        background:"rgb(242,242,242)"
   });
   $(this).css({
        borderBottom: "0px solid black",
        color:"rgb(69, 121, 55)",
        background:"white"
   }); 
});




<?php


$ac = $db->query("SELECT name,account_ID FROM iwp_accounts WHERE name IS NOT NULL $addtn ");
if(count($ac) >0){   
    foreach($ac as $value){
        if(strlen(trim($value['name']))>0){
            $name =str_replace("-","",htmlspecialchars($value['name']));
            $act[] = "\"".$name." - $value[account_ID]\" \r\n";
        }
    }
}

echo "var accountlist = [";
 echo implode(",",array_filter($act) )."]; ";
?>

$("#quicks").autocomplete({    
     minLength: 3, 
     source: function(req, responseFn) {
          var matches = new Array();
          var needle = req.term.toLowerCase();            
          var len = accountlist.length;
          for(i = 0; i < len; ++i){
              var haystack = accountlist[i].toLowerCase();
              if(haystack.indexOf(needle) === 0 || haystack.indexOf(" " + needle) != -1)
              {
                  matches.push(accountlist[i]);
              }
          }
          responseFn(matches);
    },
    select: function(event, ui) {
        var origEvent = event;
        while (origEvent.originalEvent !== undefined){
            origEvent = origEvent.originalEvent;
        }
        //console.info('Event type = ' + origEvent.type);
        //console.info('ui.item.value = ' + ui.item.value);
        if (origEvent.type == 'click'){
            var k = ui.item.value;
            var buffer = k.split("-");     
            var number = buffer[1].replace(/[^0-9]/g, '');
            var o,y;
            y= buffer[0];
            o = y.toUpperCase();
            $("input#quicks").val(buffer[0]);
            window.location.href = 'viewAccount.php?id='+number;
        } else {
            var k = ui.item.value;
            var buffer = k.split("-");     
            var number = buffer[1].replace(/[^0-9]/g, '');
            var o,y;
            y= buffer[0];
            o = y.toUpperCase();
            $("input#quicks").val(buffer[0]);   
            window.location.href = 'viewAccount.php?id='+number;
        }
    }
});

$("#sb-info").on("click",function(){
    alert('found');
});


$("#topfac").change(function(){
    $.post("topfac.php",{facnum: $(this).val(),account_no:<?php echo $account->acount_id; ?>},function(){
        alert("Facility Changed");
    });
});

// alert("HI"+$.ui.version); // is it there yet?

 if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
    $('#sb-body-inner').css({
        'overflow': 'scroll', 
        '-webkit-overflow-scrolling': 'touch' 
    }); 
}
</script>



<?php


 include "source/footer.php";
 
 }
?>

</body>
</html>  
  