<?php

include "protected/global.php";
include "source/css.php";
include "source/scripts.php";
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

function is_dir_empty($dir) {
    if (!is_readable($dir)) return NULL;
    $handle = opendir($dir);
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            return FALSE;
        }
    }
    return TRUE;
}


$accounts_with_no_contract = $db->query("SELECT account_ID FROM iwp_accounts WHERE contract IS NULL;");
var_dump($accounts_with_no_contract);
$accountsCounted = 0;
//foreach ($accounts_with_no_contract as $account_with_no_contract){
//    $account_id =  $account_with_no_contract['account_ID'];
//    //$accounts_ids = 44660;
//    $account = new Account($account_id);
////foreach($accounts_ids as $account_id){
//    if(file_exists("$account->acount_id/contract")){//has the sub folder already been created?
//        if ($handle = opendir("$account->acount_id/contract/")) {
//            if(!is_dir_empty("$account->acount_id/contract/")){// is the folder empty?
//                $accountsCounted += 1;
//
////                while (false !== ($entry = readdir($handle))) {
////                    if ($entry != "." && $entry != "..") {
////                        echo "&nbsp;&nbsp;<a href='$account->acount_id/contract/$entry' target='_blank'>$entry</a>";
////                    }
////                }
//            }
//            closedir($handle);
//        }
//    }


}

//$accounts_ids = 44660;
//$account = new Account($accounts_ids);
//$accountsCounted = 0;
////foreach($accounts_ids as $account_id){
//if(file_exists("$account->acount_id/contract")){//has the sub folder already been created?
//    if ($handle = opendir("$account->acount_id/contract/")) {
//        if(!is_dir_empty("$account->acount_id/contract/")){// is the folder empty?
//            $accountsCounted += 1;
//
//            while (false !== ($entry = readdir($handle))) {
//                if ($entry != "." && $entry != "..") {
//                    echo "&nbsp;&nbsp;<a href='$account->acount_id/contract/$entry' target='_blank'>$entry</a>";
//                }
//            }
//        }
//        closedir($handle);
//    }
//}
//}