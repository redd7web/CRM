<?php 
include "source/css.php";
include "source/scripts.php";
?>
<style>
body{
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
}
</style>
<form action="grease/protected/biologin.php" method="post" id="form_one" target="_parent">
    <table style="margin: 0 auto;width:400px;height:100px;font-size:18px;background:#F2F2F2">
        <tr><td colspan="2" style="text-align: center;"><h2>CO-WEST LOGIN - Grease Trap</h2></td></tr>
        <tr><td style="text-align: center;font-weight:normal;font-size:14px;text-align:right;">Please select module</td><td style="text-align: left;">
        <select>
        <option id="oil">Oil</option>
        <option id="gt" selected="">Grease Trap</option>
        </select></td></tr>
        <tr><td style="vertical-align: middle;text-align:right;border:0px solid #bbb;font-weight:normal;font-size:14px;">User Name</td><td style="text-align: left;"><input id="user" name="gtuser" type="text" placeholder="Username" style="width:250px;"/></td></tr>
        <tr><td style="vertical-align:middle;border:0px solid #bbb;text-align:right;font-weight:normal;font-size:14px;">Password</td><td style="text-align: left;"><input id="pw" name="gtpw" type="password" placeholder="Password" style="float:left;width:250px; "/></td></tr>
        <tr><td colspan="2" style="text-align: right;">
        <input type="hidden" value="1" name="is_cowest_user" />
        <input id="gtsub" type="submit" name="gtsub" value="Submit" style="margin-left:5px;"/></td></tr>
    </table>
</form>
  <script>
    
    
    
    
  
    
    $("#oil").click(function(){
      window.location="cowestlogin.php";
    });
    </script>