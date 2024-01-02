<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUBO94w0fjpCA0-zgoRU7CikeEnGoNA1U&libraries=places"></script>
    <?php
    //ini_set("display_errors",1);

    if(isset($_GET['new_bos'])){
        /*
        include "protected/global.php";
            

        if(isset($_GET['account_id'])){

            echo "<input type='checkbox' value='1' id='hidden_account_id' hidden>";

            $account_info_request = $db->query("SELECT * FROM iwp_accounts WHERE account_ID = $_GET[account_id]");

            if(count($account_info_request) > 0){

                $billing_adress = $account_info_request[0]['billing_address'];
                $billing_state = $account_info_request[0]['billing_state'];
                $billing_city = $account_info_request[0]['billing_city'];
                $billing_zip = $account_info_request[0]['billing_zip'];
                $new_bos = $account_info_request[0]['new_bos'];
                $area_code = $account_info_request[0]['area_code'];
                $phone = $account_info_request[0]['phone'];

                //Split contact name string
                $contact_name_request = $account_info_request[0]['contact_name'];
                $contact_names = explode(" ", $contact_name_request);
                $contact_first = $contact_names[0];
                $contact_last = $contact_names[1];


                $contact_title = $account_info_request[0]['contact_title'];
                $contact_email = $account_info_request[0]['email_address'];
                $division = $account_info_request[0]['division'];
                $account_rep = $account_info_request[0]['account_rep'];



            }

        }
    */

    }

    include "source/css.php";
    include "source/scripts.php";
    ?>

    <script src="js/jquery.geocomplete.js"></script>
<style type="text/css">
.field { 
    margin-top:10px;
    padding-left: 10px;
    width:23%;
    float:left;
    font-family:Tahoma;
    letter-spacing:1px;
   height:20px;
}
input[type=text]{ 
    border-radius:5px;
    border:1px solid #bbb;
    width:95%;
    height:25px;
}

#adduser { 
    box-shadow:         1px 1px 1px 1px #000000;
    width: 900px;
    min-height:550px;
    height:auto;
    margin:10px auto;
    border-radius:10px;
    border:1px solid black;padding-top:10px;
    padding-bottom:10px;
}

.map_canvas { 
      width: 100%; 
      height: 400px; 
      margin: 10px 20px 10px 0;
    }
    
    #multiple li { 
      cursor: pointer; 
      text-decoration: underline; 
    }

</style>
<form id="myForm" action="insertAccount.php" method="post" enctype="multipart/form-data">
    <div id="adduser" style="margin-top:90px;background:rgb(242, 242, 242);height:auto;padding-bottom:10px;margin-bottom:170px;">
    <div class="field" style="height: auto;">
        <label for="first_name">Category</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
            <ul>
            <li><input type="checkbox"/>&nbsp;Senior CITIZEN</li>
            <li><input type="checkbox"/>&nbsp;Senior CITIZEN INDIGENT</li>
            <li><input type="checkbox"/>&nbsp;INDIGENT</li>
            <li><input type="checkbox"/>&nbsp;Remaining Population (16 years above)</li>
            </ul>
    </div>
    
    <div class="field" style="height: auto;">
        <label for="first_name">INDIGENT</label>&nbsp;
    </div>
    <div class="field"  style="height: auto;">
        <ul>
            <li><input type="radio"/>&nbsp;YES</li>
            <li><input type="radio"/>&nbsp;NO</li>
            </ul>
    </div>
    <div class="field" style="width: 100%;height:3px">
    
    </div>
    <div class="field" style="height: auto;">
        <label for="first_name">Category ID (Government issued ID)</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    
    
    <div class="field" style="height: auto;">
        <label for="first_name">Category ID Number </label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    <div class="field" style="width: 100%;height:3px">
    
    </div>
    
    <div class="field" style="height: auto;">
        <label for="first_name">Phil Health Number</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    
    <div class="field" style="height: auto;">
        <label for="first_name">PWD ID Number</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    
    <div class="field" style="width: 100%;height:3px">
    
    </div>
    
    
    <div class="field" style="height: auto;">
        <label for="first_name">First Name</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    
    <div class="field" style="height: auto;">
        <label for="first_name">Last Name</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    <div class="field" style="width: 100%;height:3px">
    
    </div>
    
    
    <div class="field" style="height: auto;">
        <label for="first_name">Middle Name</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    
    <div class="field" style="height: auto;">
        <label for="first_name">Suffix (Jr. / Sr. / III)</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    
    
    <div class="field" style="width: 100%;height:3px">
    
    </div>
    
    <div class="field" style="height: auto;">
        <label for="first_name">Contact Number</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    
    <div class="field" style="height: auto;">
        <label for="first_name">Sex</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="radio"/>&nbsp;Male&nbsp;&nbsp;<input type="radio"/>&nbsp;Female
    </div>
    
    <div class="field" style="width: 100%;height:3px">
    
    </div>
    <div class="field" style="height: auto;">
        <label for="first_name">Address</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    
    <div class="field" style="height: auto;">
        <label for="first_name">Barangay</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    <div class="field" style="width: 100%;height:3px">
    
    </div>
    <div class="field" style="height: auto;">
        <label for="first_name">Birthdate</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="input" id="start_date"/>
    </div>
     <div class="field" style="height: auto;">
        <label for="first_name">Civil Status</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="radio"/>&nbsp;Married&nbsp;&nbsp;<input type="radio"/>&nbsp;Single&nbsp;&nbsp;<input type="radio"/>&nbsp;Widowed
    </div>
    <div class="field" style="width: 100%;height:3px">
    
    </div>
    
    
    <div class="field" style="height: auto;">
        <label for="first_name">Employment Status</label>&nbsp;
    </div>
    
    
    <div class="field" style="height: auto;">
    <ul>
        <li><input type="checkbox"/>&nbsp;Gov't Employed</li>
        <li><input type="checkbox"/>&nbsp;Private Employed</li>
        <li><input type="checkbox"/>&nbsp;Self-employed</li>
        <li><input type="checkbox"/>&nbsp;Private Practioner</li>
        <li><input type="checkbox"/>&nbsp;Others</li>
        <li><input type="checkbox"/>&nbsp;Not Applicable</li>
    </ul>
    </div>
    
    <div class="field" style="height: auto;">
        <label for="first_name">Directly in Interaction with Covid Patient</label>&nbsp;
    </div>
    <div class="field" style="height:auto;">
        <ul>
            <li><input type="radio"/>&nbsp;YES</li>
            <li><input type="radio"/>&nbsp;NO</li>
        </ul>
    </div>
    
    
    <div class="field" style="width:100%"></div>
    
    
    <div class="field" style="height: auto;">
        <label for="first_name">Profession</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    
    <div class="field" style="height: auto;">
        <label for="first_name">Employer</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    <div class="field" style="width:100%"></div>
    <div class="field" style="height: auto;">
        <label for="first_name">Employer Address</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    <div class="field" style="height: auto;">
        <label for="first_name">Employer Contact Number</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    <div id="hold_left" style="float: left;height:auto;width:50%;">
            <div class="field" style="height: auto;">
                <label for="first_name">Drug Allergy</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>
            <div class="field" style="width: 100%;height:3px"></div>
            
            <div class="field" style="height: auto;">
                <label for="first_name">Food Allergy</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>
            <div class="field" style="width: 100%;height:3px"></div>
            
            <div class="field" style="height: auto;">
                <label for="first_name">Insect Allergy</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>
            <div class="field" style="width: 100%;height:3px"></div>
            
            <div class="field" style="height: auto;">
                <label for="first_name">Latex Allergy</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>
            <div class="field" style="width: 100%;height:3px"></div>
            
            <div class="field" style="height: auto;">
                <label for="first_name">Mold Allergy</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>
            <div class="field" style="width: 100%;height:3px"></div>
            
            <div class="field" style="height: auto;">
                <label for="first_name">Pet Allergy</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>
            <div class="field" style="width: 100%;height:3px"></div>
            
            <div class="field" style="height: auto;">
                <label for="first_name">Pollen Allergy</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>    
            <div style="clear: both;"></div>  
        </div>
    
    <div id="hold_right" style="width: 50%;float:left;height:auto;">
             <div class="field" style="height: auto;">
            <label for="first_name">With Comobility ? Yes with any below</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>
            
            <div class="field" style="width: 100%;height:3px"></div>
            
            <div class="field" style="height: auto;">
                <label for="first_name">Hypertension</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>
            
            <div class="field" style="width: 100%;height:3px"></div>
            
            <div class="field" style="height: auto;">
                <label for="first_name">Heart Disease</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>
            
            <div class="field" style="width: 100%;height:3px"></div>
            
            <div class="field" style="height: auto;">
                <label for="first_name">Kidney Disease</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>
            <div class="field" style="width: 100%;height:3px"></div>
            
            <div class="field" style="height: auto;">
                <label for="first_name">Diabetes</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>
            <div class="field" style="width: 100%;height:3px"></div>
            
            <div class="field" style="height: auto;">
                <label for="first_name">Bronchial Asthema</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>
            <div class="field" style="width: 100%;height:3px"></div>
            
            <div class="field" style="height: auto;">
                <label for="first_name">Immuno Deficiency </label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>
            <div class="field" style="width: 100%;height:3px"></div>
            
            <div class="field" style="height: auto;">
                <label for="first_name">Cancer</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <ul>
                    <li><input type="radio"/>&nbsp;YES</li>
                    <li><input type="radio"/>&nbsp;NO</li>
                </ul>
            </div>
            <div class="field" style="width: 100%;height:3px;"></div>
            <div class="field" style="height: auto;">
                <label for="first_name">Others</label>&nbsp;
            </div>
            <div class="field" style="height: auto;">
                <textarea style="width: 250px;height:150px;"></textarea>
            </div>
            
            <div style="clear: both;"></div>
        </div>
    
    <div class="field" style="width: 100%;height:3px"></div>
    <div class="field" style="height: auto;">
        <label for="first_name">Diagnosed with Covid-19 ?</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <ul>
            <li><input type="radio"/>&nbsp;YES</li>
            <li><input type="radio"/>&nbsp;NO</li>
        </ul>
    </div>
    <div class="field" style="height: auto;">
        <label for="first_name">Date first Diagnosed with Covid-19/Speciment collected</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text" id="diagnosed"/>
    </div>
    <div class="field" style="width: 100%;height:3px;"></div>
    <div class="field" style="height: auto;">
        <label for="first_name">Date of first Jab</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text" id="f_jab"/>
    </div>
    <div class="field" style="height: auto;">
        <label for="first_name">Date of second Jab</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text" id="s_jab"/>
    </div>
    <div class="field" style="width: 100%;height:3px;"></div>
    <div class="field" style="height: auto;">
        <label for="first_name">Vaccine Brand</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    
    <div class="field" style="height: auto;">
        <label for="first_name">Name of Facility</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    <div class="field" style="width: 100%;height:3px;"></div>
    <div class="field" style="height: auto;">
        <label for="first_name">Name of Adminstering Doctor/Nurse</label>&nbsp;
    </div>
    <div class="field" style="height: auto;">
        <input type="text"/>
    </div>
    
    <div id="submit" style="width: 100%;padding:5px 5px 5px 5px;margin-top:5px;float:left;">
       <input type="reset" value="Reset Form"/>&nbsp;&nbsp;<input type="submit" name="usercreate" id="usercreate" style="float: right;margin-right:10px;" value="Create Account"/>
    </div>   
   <div style="clear: both;"></div>
  </div>
   <!--</div>-->
</form>
  
<div id="debug" style="width: 1000px;height:auto;">
    
</div>


<script>

    $(document).ready(function() {
        //Call your function here

        if($("#hidden_account_id").val() == 1){

            var contact_name_first = "<?php echo $contact_first; ?>";
            var contact_name_last = "<?php echo $contact_last; ?>";
            var billing_address_newbos = "<?php echo $billing_adress; ?>";
            var billing_state_newbos = "<?php echo $billing_state; ?>";
            var billing_city_newbos = "<?php echo $billing_city; ?>";
            var billing_zip_newbos = "<?php echo $billing_zip; ?>";



            var new_bos_newbos = "<?php echo $new_bos; ?>";
            var area_code_newbos = "<?php echo $area_code; ?>";
            var phone_newbos = "<?php echo $phone; ?>";
            var contact_title_newbos = "<?php echo $contact_title; ?>";
            var contact_email_newbos = "<?php echo $contact_email; ?>";
            var division_newbos = "<?php echo $division; ?>";
            var account_rep_newbos = "<?php echo $account_rep; ?>";


            $("#areacode").val(area_code_newbos);
            $("#phone").val(phone_newbos);

            $("#new_bos").val(new_bos_newbos);
            $("#email").val(contact_email_newbos);
            $("#billing_email").val(contact_email_newbos);
            $("#facility").val(division_newbos);
            $("#title").val(contact_title_newbos);
            $("#sales_rep").val(account_rep_newbos);



             $("#billing_address").val(billing_address_newbos);
             $("#billing_city").val(billing_city_newbos);
             $("#billing_zip").val(billing_zip_newbos);
             $("#billing_state").val(billing_state_newbos);
            // $("#billing_email").val("");



            $("#c_first_name").val(contact_name_first);
            $("#c_last_name").val(contact_name_last);

        }
    });

$("#friendly").change(function(){
    if($(this).val() == "RE COMM"){
        console.log("RE COMM SELECTED");
        $("#manager_bypass").removeAttr('required');
        $("#contract_up").removeAttr('required');
    } else {
        console.log("OTHER FRIENDLY CHOSED");
        $("#manager_bypass").prop('required',true);
        $("#contract_up").prop('required',true);
    }
    });

    $("#contract_group_id").change(function(){
        if( $(this).val().length>0 ){
            $("#manager_bypass").removeAttr('required');
        }else if ($(this).val().length == 0){
            $("#manager_bypass").prop('required',true);
        }
    });



$("#clear_files").click(function(){
    $("#contract_up").val(null);
     $("#contract_up").prop('required',true);
    $("#manager_bypass").prop('required',true);
});

$("#contract_up").change(function(){
     if( $(this).val().length>0 ){
        $("#manager_bypass").removeAttr('required');
     }else if ($(this).val().length == 0){
        $("#manager_bypass").prop('required',true);
     }
});

$("#manager_bypass").click(function(){
    if( $("#manager_bypass").is(":checked") ){
        $("#contract_up").removeAttr('required');
    }else{
        $("#contract_up").prop('required',true);
    }  
});

$("#comp_name").append($("#comp_name option").remove().sort(function(a, b) {
    var at = $(a).text(), bt = $(b).text();
    return (at > bt)?1:((at < bt)?-1:0);
}));


$("#payment_type").change(function(){
  var option = $(this).children("option:selected").html();
   
   switch ( option ){ 
        case "Jacobson":
            $("input#changer_input").attr('placeholder','Jacobsen');
            $("input#changer_input").attr('readonly',false);
            $("#addtional").remove("input#otb");
            break;
        case "Per Gallon":
            $("input#changer_input").attr('placeholder','Per Gallon');
            $("input#changer_input").attr('readonly',false);
            $("#addtional").remove("input#otb");
            break;
        case "One Time Payment":
            $("input#changer_input").attr('placeholder','One Time Payment Value');
            $("input#changer_input").attr('readonly',false);
            $("#addtional").remove("input#otb");
            break;
        case "O.T.P. PG":
            $("input#changer_input").attr('placeholder','Per Gallon');
            $("#addtional").append('<input type="text"  placeholder="One Time Bonus" id="otb" name="otb" /> <div style="clear:both"></div>');
            $("input#changer_input").attr('readonly',false);
            break;
            break;
        case "No Pay":
            $("input#changer_input").attr('placeholder','No Pay');
            $("input#changer_input").attr('readonly','readonly');
            $("input#changer_input").val('');
            $('#otb').remove();
            break;
            
   }
   $("#changer").html(option);
   
   
});

$("body #transparent").remove();
 $("input#sharing_type").hide();  
 $("input#accound_host_sharing").hide();
 //$("#comp_name").hide();
$("#comp_name_id").hide();
$("#comeptitor_removal_name").hide();
 
$("input#start_date").datepicker({ dateFormat: 'yy-mm-dd',changeMonth: true, changeYear: true });
$("input#diagnosed,#f_jab,#s_jab").datepicker( { dateFormat: 'yy-mm-dd',changeMonth: true, changeYear: true } );

$("#accound_host_sharing").hide();


$("#sharing").click(function(){
   if( $("#sharing").is(":checked") ) {
        $("#sharing_type").show();
         $("input#accound_host_sharing").show();
        
   }else {
       $("#sharing_type").hide();
        $("#accound_host_sharing").hide();
       
   }
});






$("#on_site").click(function(){
   if( $("#on_site").is(":checked") ){ 
     //$("#comp_name").show();
        $("#comp_name_id").show();
   } 
   else { 
    //$("#comp_name").hide();
       $("#comp_name_id").hide();
   }
});


$("#competitor_onsite_removal").click(function(){
    if( $("#competitor_onsite_removal").is(":checked") ){
        $("#comeptitor_removal_name").show();
    }
    else {
        $("#comeptitor_removal_name").hide();
    }
});


var req = "";
 
 $("#usercreate").click(function(){
      if( $("#facility").val()=="--"  || $("#facility").val()==99 ){
        alert("Please choose a facility")
        return false;
       }
     
    
    $.each("#myForm input[type='text'].req",function(){
        if( $(this).val() !== ""  ){
           req = "stop";  
        } 
    });
    
 });
 
 
var options = {
      map: ".map_canvas"
    };
    
    $("#geocomplete").geocomplete(options)
      .bind("geocode:result", function(event, result){
        //$.log("Result: " + result.formatted_address);
      })
      .bind("geocode:error", function(event, status){
        //$.log("ERROR: " + status);
      })
      .bind("geocode:multiple", function(event, results){
        //$.log("Multiple: " + results.length + " results found");
      });
  
    $("#find").click(function(){
        $("#geocomplete").trigger("geocode");       
    });
    
    $("#examples a").click(function(){
      $("#geocomplete").val($(this).text()).trigger("geocode");       
      return false;
    });
    
    $("#update_address").click(function(){
        var buffer = $("input#geocomplete").val().split(",");
        var state_zip;
        state_zip = buffer[2].split(" ");
       $("input#address").val(buffer[0]);
       $("input#city").val(buffer[1]);
       alert(state_zip[1]);
       $("select#state").val( state_zip[1].trim());
       $("input#zipcode").val(state_zip[2]);
       //alert("0:"+state_zip[0]+" 1:"+state_zip[1]+" 2:"+state_zip[2]);
       
    });


</script>
