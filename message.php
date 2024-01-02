<?php
include "protected/global.php";
include "source/scripts.php";
ini_set("display_errors",0);
ini_set('memory_limit','1064M');
if(isset($_GET['account'])){
    $acnt = new Account($_GET['account']);
}
$act[]="";
$usr[]="";
//$ac = $db->get($dbprefix."_accounts");
//if(count($ac) !=0){
//    foreach($ac as $value){
//        $act[] = "\"".htmlspecialchars($value['name'])." - $value[account_ID]\" ";
//    }
//}

?>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="css/style.css"/>


<style type="text/css">
body{
    margin:5px 5px 5px 5px;
    padding:10px 10px 10px 10px;
    background:rgb(250, 250, 250);
    font-family: arial;
    overflow: scroll;
    -webkit-overflow-scrolling: touch;

}

    li{
        background-color:lightblue;
        cursor: pointer;
    }
</style>
<body ontouchstart="">




<h1 style="width:100%;margin:auto;text-align:center;text-transform:uppercase;padding:0px 0px 0px 0px;">Service Task</h1>
<p style="margin: auto;width:150px;">Create an Task or Private Message</p>

Assigned User, Issue, and Time Called Are All Required.
Please Be Patient After Submitting An Issue, An Alert Will Let You Know An Issue Has Been Created.

 <br />


<br>
<!--<input type="text" style="width: 99%;" id="to" required placeholder="To:"/>-->
<br>
<b>Assigned User:  </b><?php getAllApprovedUsers(); ?>
<br /><br />
<input type="text" " placeholder="subject" id="subject" name="subject" /><br /><br />



 <div class="quicksearch">
     <b>Select Account:</b>
     <input type="text" placeholder="Account ID or Name" id="quicks" class="quicks"
        <?php if(isset($_GET['account'])){
            echo 'value="' . account_NumtoName_plain($_GET['account']) . ' ~ ' . $_GET['account'] . '"';
        }
        ?>
     />
</div>


<!--//Old Account Stuff-->
<!--<input type="text" placeholder="Account Name"  --><?php
//if(isset($_GET['account'])){
//    echo "value=\"$acnt->name_plain - $acnt->acount_id\"";
//}
//
// ?><!-- name="acntname" id="acntname"/>-->




<input type="hidden" name="user_id" id="user_id" readonly=""/>
<input type="hidden"  placeholder="accountnumber" readonly="" id="account_number" name="account_number" <?php
if(isset($_GET['account'])){
    echo "value='$acnt->acount_id'";
}

 ?>/>
<br /><br />
<b>Code Red?</b>
<input type="checkbox" id="priority_id" name="priority_id" value="20">
<!--<select id="priority_id" >-->
<!---->
<!--<option value="0">---choose---</option>-->
<!--<option value="20">Normal</option>-->
<!---->
<!--<option value="10">Urgent</option>-->
<!--</select>-->
<br/><br>
<b>Issue:</b>
<?php 
zero_gallons_reasons("","message_category_id");

?>
<br /><br />
<b>Time Called: </b>&nbsp;<input type="text" name="time_called" id="time_called" autocomplete="off" required placeholder="Time of Call"/><br /><br />
<textarea style="width: 99%;height:60px;" placeholder="Please write your message here." id="mesg"></textarea>
<br /><br />
<input type="submit" value="Send Message" id="ght" style="float: right;" disabled=""/>
<span style="float: right;margin-right:30px;">
<input type="radio" name="msg_type" class="msg_type" value="1" required  />&nbsp;Issue&nbsp;&nbsp;

<!--<input type="radio" name="msg_type"  class="msg_type" value="2"/>&nbsp;Message&nbsp;&nbsp; -->

<input type="radio" name="msg_type" class="msg_type" value="3"/>&nbsp;Private Message&nbsp;&nbsp; </span>



<!--<div id="debug"></div>-->

<?php


$ac = $db->query("SELECT name,account_ID FROM iwp_accounts WHERE status IN ('active', 'new') AND name IS NOT NULL");
if(count($ac) >0){
    foreach($ac as $value){
        if(strlen(trim($value['name']))>0){
            $name =str_replace("-","",htmlspecialchars($value['name']));
            $act[] = "\"".$name." ~ $value[account_ID]\" \r\n";
        }
    }
}

//echo "var accountlist = [";
//echo implode(",",array_filter($act) )."]; ";
?>



<script>
    $(document).ready(function(){
        // $("#account_name_jquery").keyup(function(){
        //     var query = $(this).val();
        //     if(query.length > 2 ){
        //         if (query != "") {
        //             $.ajax({
        //                 url: "accountIssueSearch.php",
        //                 type: "POST",
        //                 data: {
        //                     query: query
        //                 },
        //                 success: function (data) {
        //                     $("#account_name_jquery_list").fadeIn();
        //                     $("#account_name_jquery_list").html(data);
        //                 }
        //             })
        //
        //         }
        //     }
        // });

        $(document).on('click', 'li', function() {
            $("#quicks").val($(this).text());
            var checking = $("#quicks").val();

            var split_account_id = checking.split('~');


            $("#account_number").val(split_account_id[1]);
            var checking_accounts_id = $("#account_number").val();
            //alert(checking_accounts_id);
            //$("#account_name_jquery_list").fadeOut();
        })

    });


///Checking this
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
                //window.location.href = 'viewAccount.php?id='+number;
            } else {
                var k = ui.item.value;
                var buffer = k.split("-");
                var number = buffer[1].replace(/[^0-9]/g, '');
                var o,y;
                y= buffer[0];
                o = y.toUpperCase();
                $("input#quicks").val(buffer[0]);
                //window.location.href = 'viewAccount.php?id='+number;
            }
        }
    });

    //Adding Extra


    
    
$("#time_called").datetimepicker({dateFormat: "yy-mm-dd",changeMonth: true, changeYear: true,yearRange: "1:c+10"});

var typ;
$(".msg_type").click(function(){
    typ = $(this).val(); 
});


$('#message_category_id').change(function () {
    if ($('#message_category_id').val() == 0) {
        alert("Please choose an issue");
      $(this).prop('disabled', 'disabled'); 
    }else {
      $('#ght').prop("disabled", false);
    }
});



$("#ght").click(function(){
    //$(this).prop('disabled', 'disabled');


        if ($("#message_category_id").val() != 0 && $("#to :selected").val() != "") {
            if ($("input#time_called").val() != "") {

                //alert($("#to :selected").val() + " " + $("#anumber").val() + " " + typ);
                $.post('sendMessage.php', {
                    user_id: $("#to :selected").val(), //person sent to
                    title: $("input#subject").val(),
                    acnt: $("#account_number").val(),
                    priority: $("#priority_id").val(),
                    issue: $("#message_category_id").val(),
                    mesg: $("#mesg").val(), //message
                    type: typ,
                    subject: $("input#subject").val(),
                    time_called: $("input#time_called").val()
                }, function (data) {
                    //$("#debug").html(data);
                    alert(data);
                    console.log(data);
                    //$('button.btn').prop('disabled', false);
                });
            } else {
                alert("Please Input the Time of Call");
            }
        } else {
            alert("Please select and issue or assigned user before submitting");
        }
    
});



<?php
 echo "var accountlist = [";
 echo implode(",",array_filter($act) )."]; ";

?>



$("#acntname").autocomplete({
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
          var test = "United States";//results containing the pattern united      
          var resultArray = matches.filter(function(d){
                return /United States/.test(d);
          });
          
          
          var second = matches.filter(function(d){ //results not containing United States
                return !/United States/.test(d);
          });
          
          //results containing united states first, then others
          var newlist = resultArray.concat(second);
          
          responseFn(  newlist);
          
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
            buffer = k.split("-");     
            var o,y;
            y= buffer[0];
            o = y.toUpperCase();   
            $("input#acntname").val(o);              
            $("input#acntname").val(o);
            $("input#anumber").val(buffer[1]);
        } else {
            var k = ui.item.value;
            buffer = k.split("-");     
            var o,y;
            y= buffer[0];
            o = y.toUpperCase();   
            $("input#acntname").val(o);              
            $("input#acntname").val(o);
            $("input#anumber").val(buffer[1]);
        }
    }
});  

var wordlist = [
<?php

$results = $db->where("approved",1)->get($dbprefix."_users","first,last,user_id");
if(count($results) != 0) {
    str_replace(" ","",$results);
    foreach ($results as $key) {
        $icao = str_replace("\"","",$key['first']);
        $icao = trim($icao);
        $air = str_replace("\"","",$key['last']);
        $air = trim($air);
        $usr[] =" \"$icao $air $key[user_id]\"";
    }
    echo implode("," ,array_filter($usr));
}
?>
];


$("#to").autocomplete({
     minLength: 3,
     source: function(req, responseFn) {
          var matches = new Array();
          var needle = req.term.toLowerCase();            
          var len = wordlist.length;
          for(i = 0; i < len; ++i){
              var haystack = wordlist[i].toLowerCase();
              if(haystack.indexOf(needle) === 0 || haystack.indexOf(" " + needle) != -1)
              {
                  matches.push(wordlist[i]);
              }
          }
          var test = "United States";//results containing the pattern united      
          var resultArray = matches.filter(function(d){
                return /United States/.test(d);
          });
          
          
          var second = matches.filter(function(d){ //results not containing United States
                return !/United States/.test(d);
          });
          
          //results containing united states first, then others
          var newlist = resultArray.concat(second);
          
          responseFn(  newlist);
          
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
            buffer = k.split(" ");     
            var o,y;
            y= buffer[0]+" "+buffer[1];
            o = y.toUpperCase();   
            $("input#to").val(o);              
            $("input#to").val(o);
            $("input#user_id").val(buffer[2]);
        } else {
            var k = ui.item.value;
            buffer = k.split(" ");     
            var o,y;
            y= buffer[0]+" "+buffer[1];
            o = y.toUpperCase();   
            $("input#to").val(o);              
            $("input#to").val(o);
            $("input#user_id").val(buffer[2]);
        }
    }
});  
</script>
</body>