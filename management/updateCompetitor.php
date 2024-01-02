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



<?php

if(isset($_GET['competitor_id'])){

    $competitor_request = $db->query("SELECT * FROM iwp_competitors WHERE competitor_id =  $_GET[competitor_id]");


}

?>


<form action="updateCompetitorSQL.php" method="post">
<div id="adduser" style="margin-top:90px;background:rgb(212, 208, 200)">
    <div class="field">
        <label for="name">Name</label>&nbsp;
    </div>
    <div class="field">
        <input type="text" id="name" name="name" <?php if(isset($_GET['competitor_id'])){echo "value='" . $competitor_request[0]['name'] . "'";} else { echo ' placeholder="Competitor Name" ';} ?> required/>

    </div>

    <div class="field">
        <label for="email">Email</label>&nbsp;
    </div>
    <div class="field">
        <input type="text" id="email" name="email"  <?php if(isset($_GET['competitor_id'])){echo "value='" . $competitor_request[0]['comp_email'] . "'";} else { echo ' placeholder="Email" ';} ?> required/>
    </div>
    
    <div class="field">
        <label for="address">Address</label>&nbsp;
    </div>
    <div class="field">
        <input type="text" id="address" name="address"  <?php if(isset($_GET['competitor_id'])){echo "value='" . $competitor_request[0]['address'] . "'";} else { echo ' placeholder="Address" ';} ?> required/>
    </div>
    
    <div class="field">
        <label for="city">City</label>&nbsp;
    </div>
    <div class="field">
        <input type="text" id="city" name="city"  <?php if(isset($_GET['competitor_id'])){echo "value='" . $competitor_request[0]['city'] . "'";} else { echo ' placeholder="City" ';} ?> required/>
    </div>
    
    <div class="field">
        <label for="state">State</label>&nbsp;
    </div>
    <div class="field">
        <select name="state" id="state">
            <option value="" >Select a State</option>
            <option <?php if($competitor_request[0]['state'] == "AL"){ echo 'selected';} ?> value="AL">Alabama</option>
            <option <?php if($competitor_request[0]['state'] == "AK"){ echo 'selected';} ?> value="AK">Alaska</option>
            <option <?php if($competitor_request[0]['state'] == "AZ"){ echo 'selected';} ?> value="AZ">Arizona</option>
            <option <?php if($competitor_request[0]['state'] == "AR"){ echo 'selected';} ?> value="AR">Arkansas</option>
            <option <?php if($competitor_request[0]['state'] == "CA"){ echo 'selected';} ?> value="CA">California</option>
            <option <?php if($competitor_request[0]['state'] == "CO"){ echo 'selected';} ?> value="CO">Colorado</option>
            <option <?php if($competitor_request[0]['state'] == "CT"){ echo 'selected';} ?> value="CT">Connecticut</option>
            <option <?php if($competitor_request[0]['state'] == "DE"){ echo 'selected';} ?> value="DE">Delaware</option>
            <option <?php if($competitor_request[0]['state'] == "DC"){ echo 'selected';} ?> value="DC">District Of Columbia</option>
            <option <?php if($competitor_request[0]['state'] == "FL"){ echo 'selected';} ?> value="FL">Florida</option>
            <option <?php if($competitor_request[0]['state'] == "GA"){ echo 'selected';} ?> value="GA">Georgia</option>
            <option <?php if($competitor_request[0]['state'] == "HI"){ echo 'selected';} ?> value="HI">Hawaii</option>
            <option <?php if($competitor_request[0]['state'] == "ID"){ echo 'selected';} ?> value="ID">Idaho</option>
            <option <?php if($competitor_request[0]['state'] == "IL"){ echo 'selected';} ?> value="IL">Illinois</option>
            <option <?php if($competitor_request[0]['state'] == "IN"){ echo 'selected';} ?> value="IN">Indiana</option>
            <option <?php if($competitor_request[0]['state'] == "IA"){ echo 'selected';} ?> value="IA">Iowa</option>
            <option <?php if($competitor_request[0]['state'] == "KS"){ echo 'selected';} ?> value="KS">Kansas</option>
            <option <?php if($competitor_request[0]['state'] == "KY"){ echo 'selected';} ?> value="KY">Kentucky</option>
            <option <?php if($competitor_request[0]['state'] == "LA"){ echo 'selected';} ?> value="LA">Louisiana</option>
            <option <?php if($competitor_request[0]['state'] == "ME"){ echo 'selected';} ?> value="ME">Maine</option>
            <option <?php if($competitor_request[0]['state'] == "MD"){ echo 'selected';} ?> value="MD">Maryland</option>
            <option <?php if($competitor_request[0]['state'] == "MA"){ echo 'selected';} ?> value="MA">Massachusetts</option>
            <option <?php if($competitor_request[0]['state'] == "MI"){ echo 'selected';} ?> value="MI">Michigan</option>
            <option <?php if($competitor_request[0]['state'] == "MN"){ echo 'selected';} ?> value="MN">Minnesota</option>
            <option <?php if($competitor_request[0]['state'] == "MS"){ echo 'selected';} ?> value="MS">Mississippi</option>
            <option <?php if($competitor_request[0]['state'] == "MO"){ echo 'selected';} ?> value="MO">Missouri</option>
            <option <?php if($competitor_request[0]['state'] == "MT"){ echo 'selected';} ?> value="MT">Montana</option>
            <option <?php if($competitor_request[0]['state'] == "NE"){ echo 'selected';} ?> value="NE">Nebraska</option>
            <option <?php if($competitor_request[0]['state'] == "NV"){ echo 'selected';} ?> value="NV">Nevada</option>
            <option <?php if($competitor_request[0]['state'] == "NH"){ echo 'selected';} ?> value="NH">New Hampshire</option>
            <option <?php if($competitor_request[0]['state'] == "NJ"){ echo 'selected';} ?> value="NJ">New Jersey</option>
            <option <?php if($competitor_request[0]['state'] == "NM"){ echo 'selected';} ?> value="NM">New Mexico</option>
            <option <?php if($competitor_request[0]['state'] == "NY"){ echo 'selected';} ?> value="NY">New York</option>
            <option <?php if($competitor_request[0]['state'] == "NC"){ echo 'selected';} ?> value="NC">North Carolina</option>
            <option <?php if($competitor_request[0]['state'] == "ND"){ echo 'selected';} ?> value="ND">North Dakota</option>
            <option <?php if($competitor_request[0]['state'] == "OH"){ echo 'selected';} ?> value="OH">Ohio</option>
            <option <?php if($competitor_request[0]['state'] == "OK"){ echo 'selected';} ?> value="OK">Oklahoma</option>
            <option <?php if($competitor_request[0]['state'] == "OR"){ echo 'selected';} ?> value="OR">Oregon</option>
            <option <?php if($competitor_request[0]['state'] == "PA"){ echo 'selected';} ?> value="PA">Pennsylvania</option>
            <option <?php if($competitor_request[0]['state'] == "RI"){ echo 'selected';} ?> value="RI">Rhode Island</option>
            <option <?php if($competitor_request[0]['state'] == "SC"){ echo 'selected';} ?> value="SC">South Carolina</option>
            <option <?php if($competitor_request[0]['state'] == "SD"){ echo 'selected';} ?> value="SD">South Dakota</option>
            <option <?php if($competitor_request[0]['state'] == "TN"){ echo 'selected';} ?> value="TN">Tennessee</option>
            <option <?php if($competitor_request[0]['state'] == "TX"){ echo 'selected';} ?> value="TX">Texas</option>
            <option <?php if($competitor_request[0]['state'] == "UT"){ echo 'selected';} ?> value="UT">Utah</option>
            <option <?php if($competitor_request[0]['state'] == "VT"){ echo 'selected';} ?> value="VT">Vermont</option>
            <option <?php if($competitor_request[0]['state'] == "VA"){ echo 'selected';} ?> value="VA">Virginia</option>
            <option <?php if($competitor_request[0]['state'] == "WA"){ echo 'selected';} ?> value="WA">Washington</option>
            <option <?php if($competitor_request[0]['state'] == "WV"){ echo 'selected';} ?> value="WV">West Virginia</option>
            <option <?php if($competitor_request[0]['state'] == "WI"){ echo 'selected';} ?> value="WI">Wisconsin</option>
            <option <?php if($competitor_request[0]['state'] == "WY"){ echo 'selected';} ?> value="WY">Wyoming</option>





        </select>
    </div>
    
    <div class="field">
        <label for="zipcode">Zipcode</label>&nbsp;
    </div>
    <div class="field">
        <input type="text" id="zipcode" name="zipcode"  <?php if(isset($_GET['competitor_id'])){echo "value='" . $competitor_request[0]['zip_code'] . "'";} else { echo ' placeholder="Zip Code" ';} ?> required/>
    </div>

    <input type="text" id="competitor_id" hidden value="<?php echo $_GET['competitor_id']; ?>">

    <div id="submit" style="width: 100%;padding:5px 5px 5px 5px;margin-top:5px;float:left;">
        <input type="submit" name="usercreate" id="usercreate" style="float: right;margin-right:10px;" value="Update Competitor"/>
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
