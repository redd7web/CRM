<meta  charset="UTF-8"/>
<script type="text/javascript" src="../js/jquery-1.11.1.js"></script>
<style>
body{
    padding:3px 3px 3px 3px; 
}
</style>

<input type="text" id="website" name="website" placeholder="Website" style="margin-left:20px;width:200px;"/> 
<input type="submit" style="color: green;" value="Edit" name="editpayee" id="editpayee"/>
<input type="hidden" id="account_no" name="account_no" value="<?php echo $_GET['id']; ?>"  style="width: 30px;"/>


<script>

$("#editpayee").click(function(){
   $.post("updateAccountName.php",{website: $("input#website").val(),id:$("input#account_no").val()  },function(data){
         alert(data);
    }); 
    return false;
});
</script>