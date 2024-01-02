<?php
include "protected/global.php";
//include "source/scripts.php";

ini_set("display_errors",0);


if(isset($_SESSION['id'])) {

    if(isset($_GET['account_id'])){
    $account = new Account($_GET['account_id']);
    $person = new Person();
    ?>

    <style>
        table, tr {
            border: 1px solid green;
            text-align: left;
        }


        table.center {
            margin-left:auto;
            margin-right:auto;
            border-radius: 25px;

        }

        tr:nth-child(even) {
            background: #CCC
        }
        #archive {
            font-family:tahoma;
        }
    </style>

    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>

    <script type="text/javascript">

        window.onload = function() {
            document.getElementById('competitorList').style.display = 'none';
            document.getElementById('other_reason').style.display = 'none';
            document.getElementById('competitor_other').style.display = 'none';
            document.getElementById('competitor_title').style.display = 'none';
        }

        function hideOptions() {
            if (document.getElementById('lostToCompetitor').checked) {
                document.getElementById('competitorList').style.display = 'block';
                document.getElementById('other_reason').style.display = 'none';
            } else if (document.getElementById('other').checked){
                document.getElementById('other_reason').style.display = 'block';
                document.getElementById('competitorList').style.display = 'none';
            }
            else {
                document.getElementById('competitorList').style.display = 'none';
                document.getElementById('other_reason').style.display = 'none';
                document.getElementById('competitor_other').style.display = 'none';
            }

        }

        $(document).ready(function(){
            $("#competitor_id").change(function(){
                var competitor_choice = $("#competitor_id").val();
                console.log(competitor_choice);
                if(competitor_choice == 18){
                    document.getElementById('competitor_other').style.display = 'block';
                    document.getElementById('competitor_title').style.display = 'block';
                } else {
                    document.getElementById('competitor_other').style.display = 'none';
                    document.getElementById('competitor_title').style.display = 'none';
                }
            })
        })

    </script>


    <div id="archive">
        <h3 style="text-align:center;">Archiving Account <?php echo $account->name_plain;?></h3>
        <p style="text-align: center;">If a reason is not chosen the account will not be archived.</p>
        <form method="post" action="accountArchiveUpdate.php" onsubmit="return confirm('Confirm Archiving Account')">
            <input type="hidden" value="<?php echo $account->acount_id;?>" name="account_id">
            <input type="hidden" value="<?php echo $person->user_id;?>" name="user_id">

        <table class="center">
            <tr>
                <th style="text-align: center;">
                    Archive Reason
                </th>
            </tr>
            <tr>
                <td>
                    <input type="radio" onclick="hideOptions()" name="archive_reason" value="1" required> High Theft Area
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" onclick="hideOptions()" name="archive_reason" value="2" required> Issues with Service
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" onclick="hideOptions()" name="archive_reason" value="3" id="lostToCompetitor" required> Lost to Competitor
                <div id="competitorList">
<!--                    <p style="margin-top:2px;margin-bottom: 2px;text-align: center;">Competitor</p>-->
                    <?php
                    $competitors = $db->where('active', 1)->orderBy('name', "ASC")->get('iwp_competitors', 'competitor_id, name');
                    echo "<select id='competitor_id' name='competitor_id' style='display: block; margin:0 auto'>";
                    echo "<option value=''>--Select--</option>";
                    foreach($competitors as $competitor) {
                        echo "<option value='$competitor[competitor_id]'>$competitor[name]</option>";
                    }
                    echo "</select>";
                    ?>
                    <p id="competitor_title">Other Competitor Name:</p>

                    <input type="text" id="competitor_other" name="competitor_other" placeholder="Enter Competitor Name">

                </div>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" onclick="hideOptions()" name="archive_reason" value="4" required> Low Producer
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" onclick="hideOptions()" name="archive_reason" value="5" required> No Longer Produces Oil
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" onclick="hideOptions()" name="archive_reason" value="6" required> No Reason Given by Customer
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" onclick="hideOptions()" name="archive_reason" value="3" id="outOfBusiness" required> Out of Business
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" onclick="hideOptions()" id="other" name="archive_reason" value="7" required> Other
                    <div id="other_reason">
                        <p style="margin-top:2px;margin-bottom:2px;">Other Description</p>
                        <textarea rows="5" cols="25"  onclick="hideOptions()" name="other_reason"></textarea>
                    </div>
                </td>

            </tr>
            <tr>
                <td id="other_reason">
                </td>
            </tr>
            <tr>
                <td>
                    <input style="display: block;margin: auto;" type="submit">
                </td>
            </tr>
        </table>

        </form>
    </div>




<?php
} else {
        echo "Account ID is not set!";
    }
} else {
    echo "You should not be here!";
}