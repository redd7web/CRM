<?php
    //include "../source/scripts.php";
include "../protected/global.php";
?>
<style type="text/css">

.field { 
    margin-top:10px;
    padding-left: 10px;
    width:20%;
    float:left;
    font-family:Tahoma;
    letter-spacing:1px;
   height:15px;
}
input[type=text]{ 
    border-radius:5px;
    border:1px solid #bbb;
    width:95%;
    height:25px;
}

#adduser { 
    box-shadow:         1px 1px 3px 3px #70a170;
  height:auto;margin:10px auto;border-radius:10px;border:1px solid black;padding-top:10px;
    padding-bottom:10px;
}
</style>

<form action="insertCompetitor.php" method="post">
<div id="adduser" style="margin-top:90px;background:rgb(212, 208, 200)">
    <div class="field">
        <label for="name">Name</label>&nbsp;
    </div>
    <div class="field">
        <input type="text" id="name" name="name" placeholder="Comepitor Name" required/>
    </div>

    <div class="field">
        <label for="email">Email</label>&nbsp;
    </div>
    <div class="field">
        <input type="text" id="email" name="email"  placeholder="email" required/>
    </div>
    
    <div class="field">
        <label for="address">Address</label>&nbsp;
    </div>
    <div class="field">
        <input type="text" id="address" name="address"  placeholder="address" required/>
    </div>
    
    <div class="field">
        <label for="city">City</label>&nbsp;
    </div>
    <div class="field">
        <input type="text" id="city" name="city"  placeholder="city" required/>
    </div>
    
    <div class="field">
        <label for="state">State</label>&nbsp;
    </div>
    <div class="field">
        <select name="state" id="state"><option value="" selected="selected">Select a State</option> 
<option value="AL">Alabama</option> 
<option value="AK">Alaska</option> 
<option value="AZ">Arizona</option> 
<option value="AR">Arkansas</option> 
<option value="CA">California</option> 
<option value="CO">Colorado</option> 
<option value="CT">Connecticut</option> 
<option value="DE">Delaware</option> 
<option value="DC">District Of Columbia</option> 
<option value="FL">Florida</option> 
<option value="GA">Georgia</option> 
<option value="HI">Hawaii</option> 
<option value="ID">Idaho</option> 
<option value="IL">Illinois</option> 
<option value="IN">Indiana</option> 
<option value="IA">Iowa</option> 
<option value="KS">Kansas</option> 
<option value="KY">Kentucky</option> 
<option value="LA">Louisiana</option> 
<option value="ME">Maine</option> 
<option value="MD">Maryland</option> 
<option value="MA">Massachusetts</option> 
<option value="MI">Michigan</option> 
<option value="MN">Minnesota</option> 
<option value="MS">Mississippi</option> 
<option value="MO">Missouri</option> 
<option value="MT">Montana</option> 
<option value="NE">Nebraska</option> 
<option value="NV">Nevada</option> 
<option value="NH">New Hampshire</option> 
<option value="NJ">New Jersey</option> 
<option value="NM">New Mexico</option> 
<option value="NY">New York</option> 
<option value="NC">North Carolina</option> 
<option value="ND">North Dakota</option> 
<option value="OH">Ohio</option> 
<option value="OK">Oklahoma</option> 
<option value="OR">Oregon</option> 
<option value="PA">Pennsylvania</option> 
<option value="RI">Rhode Island</option> 
<option value="SC">South Carolina</option> 
<option value="SD">South Dakota</option> 
<option value="TN">Tennessee</option> 
<option value="TX">Texas</option> 
<option value="UT">Utah</option> 
<option value="VT">Vermont</option> 
<option value="VA">Virginia</option> 
<option value="WA">Washington</option> 
<option value="WV">West Virginia</option> 
<option value="WI">Wisconsin</option> 
<option value="WY">Wyoming</option></select>
    </div>
    
    <div class="field">
        <label for="zipcode">Zipcode</label>&nbsp;
    </div>
    <div class="field">
        <input type="text" id="zipcode" name="zipcode"  placeholder="zipcode" required/>
    </div>

    <div id="submit" style="width: 100%;padding:5px 5px 5px 5px;margin-top:5px;float:left;">
        <input type="submit" name="usercreate" id="usercreate" style="float: right;margin-right:10px;" value="Add Competitor"/>
    </div>
    
    <div style="clear: both;"></div>
</div>

</form>
<script>


//
//$("#usercreate").click(function(){
//        alert("Are you here? ");
//     if(true) {
//        //alert(usertype);
//        $.post("management/insertCompetitor.php",{
//            name:          $("input#comp_name").val(),
//            comp_email:          $("input#email").val(),
//            address:        $("input#address").val(),
//            city:           $("input#city").val(),
//            state:          $("#state").val(),
//            zipcode:       $("input#zipcode").val()
//            },function(data){
//                alert(data);
//
//         });
//     } else {
//        alert('User Name Required');
//     }
//});

</script>
