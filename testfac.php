<html>
<?php
include "source/scripts.php";
ini_set("max_memory_size",-1);

?>
<table id="acnts">


</table>
<script>
function grab(){
     

}
var count =0;

$("document").ready(function(){
   $.post("grab_address.php",function(data){
        $("#acnts").html(data);
        
        $("table#acnts tr").each(function(){
            count++;
             var value=$(this).closest('tr').children('td:nth-child(2)').text();
            var third_cell=$(this).closest('tr').children('td:nth-child(3)');
            //alert(value);
            $.post("address_plain.php",{address:$.trim(value)},function(data){
                    
                    third_cell.html(data);    
            }); 
            if(count>1){
                return false;
            }
        });
   }); 
});

</script>
</html>

