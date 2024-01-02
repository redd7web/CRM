<meta  charset="UTF-8"/>
<script type="text/javascript" src="../js/jquery-1.11.1.js"></script>
<style>
body{
    padding:3px 3px 3px 3px; 
}
</style>

<input type="text" id="jake_percent" name="jake_percent" placeholder="Payee Name" style="margin-left:20px;width:200px;"/> 
<input type="submit" style="color: green;" value="Edit" name="editpayee" id="editpayee"/>
<input type="hidden" id="account_no" name="account_no" value="<?php echo $_GET['id']; ?>"  style="width: 30px;"/>


<script>

$("#editpayee").click(function(){
   $.post("updateJakePercent.php",{jake_percent: $("input#jake_percent").val(),id:$("input#account_no").val()  },function(data){
         alert(data);
    }); 
    return false;
});
</script>
