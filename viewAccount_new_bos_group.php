<?php
include "protected/global.php";
include "source/css.php";
include "source/scripts.php";
ini_set("display_errors",0);


if(isset($_GET['id'])){

    $account = new Account($_GET['id']);
    $person = new Person();

    if(strlen($account->new_bos) > 0 && $account->new_bos != 0){
        $request = $db->query("SELECT * FROM iwp_accounts WHERE new_bos = $account->new_bos");
        ?>


    <img style="text-align:center;" new_bos="<?php echo $account->new_bos;?>" account_id="<?php echo $account->acount_id;?>" class="created_new_account" id="create_new_account" src="img/newbos_button.png">

    <table id="table_id" class="display">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>Last Pickup</th>
            <th>Scheduled Pickup</th>
            <th>Average Gallons (Lifetime)</th>
        </tr>
        </thead>
        <tbody>

<?php

        if(count($request) > 0){
            foreach($request as $value){

                $new_account = new Account($value['account_ID']);

                $scheduled_request = $db->query("SELECT account_no,
                                                                scheduled_start_date
                                                        FROM iwp_scheduled_routes
                                                        WHERE route_status = 'scheduled' AND account_no = $value[account_ID] ORDER BY scheduled_start_date");

                if(count($scheduled_request) > 0 ){
                    $schedule_date = $scheduled_request[0]['scheduled_start_date'];
                } else {
                    $schedule_date = "No Scheduled Service";
                }


                $lifetime_gallons =  number_format($new_account->total_gallons / $new_account->number_of_pickups,2);



                echo "<tr>";
                echo "<td>$value[account_ID]</td>";
                echo "<td><a href='https://inet.iwpusa.com/viewAccount.php?id=$value[account_ID]' >$value[name]</a></td>";
                echo "<td>$value[address]</td>";
                echo "<td>$value[state]</td>";
                echo "<td>$value[city]</td>";
                echo "<td>$value[zip]</td>";
                echo "<td>$value[date_of_last_pickup]</td>";
                echo "<td>$schedule_date</td>";
                echo "<td>$lifetime_gallons</td>";
                echo "</tr>";
            }
        }

        echo "</tbody>";

    } else{
        echo "No Newbos Number for Account or Newbos Number = 0";
    }
}

?>

<script>

    $(document).ready( function () {
        $('#table_id').DataTable();
    } );


    $(".created_new_account").click(function(){
        Shadowbox.open({
            content:"addAcount.php?new_bos="+$(this).attr('new_bos')+"&account_id="+$(this).attr('account_id'),
            //content:"edit_route_stop.php?entry="+$(this).attr('title')+"&route_id="+$(this).attr('rte')+"&schedule="+$(this).attr('schedule')+"&account="+$(this).attr('account'),
            player:"iframe",
            width: 1200,
            height:800
        })
    });

</script>
