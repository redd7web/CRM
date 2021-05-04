<?php
include "source/scripts.php";
include "source/css.php";

?>
<iframe src="machlogin2.php" style="display: none;"></iframe>
Logging you into Mach forms... then redirecting to edit Cotton Report please wait.
<script>
$(document).ready(function(){
    $('#sb-player').contents().find('input#admin_username').val('INET@iwpusa.com');
    $('#sb-player').contents().find('input#admin_password').val('Formlogin1');
    $('#sb-player').contents().find('#submit_button').trigger('click');
    setTimeout("window.location='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=43646&entry_id=<?php echo $_GET['form_id']; ?>'",2000);
});



</script>