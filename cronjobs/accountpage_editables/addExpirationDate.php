<meta  charset="UTF-8"/>
<script type="text/javascript" src="../js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="../js/jquery-ui.js"></script>
<link rel="stylesheet" href="../css/auto.css"/>

<style>
body{
    padding:3px 3px 3px 3px; 
}

.ui-datepicker { width: 17em; padding: .2em .2em 0; display: none; font-size:55.5%; }
</style>

<input type="text" id="expiration" name="expiration" placeholder="YYYY-MM-DD" style="margin-left:20px;width:200px;"/> 
<input type="submit" style="color: green;" value="Edit" name="expdate" id="expdate"/>
<input type="hidden" id="account_no" name="account_no" value="<?php echo $_GET['id']; ?>"  style="width: 30px;"/>


<script>
$("input#expiration").datepicker(
    { dateFormat: 'yy-mm-dd' }
);
$("#expdate").click(function(){
   $.post("updateExpDate.php",{expira: $("input#expiration").val(),id:$("input#account_no").val()  },function(data){
         alert(data);
    }); 
    return false;
});
</script>
