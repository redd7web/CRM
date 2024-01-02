<?php
include "protected/global.php";
ini_set("display_errors",1);


if(isset($_GET['entry_id'])){

    $request = $db->query("SELECT id,
                            element_14,
                            element_15,
                            element_16,
                            element_17,
                            element_18,
                            element_19,
                            element_20,
                            element_21,
                            element_22,
                            element_23,
                            element_26,
                            element_27,
                            element_28,
                            element_29,
                            element_30,
                            element_31,
                            element_34,
                            element_35,
                            element_36,
                            element_37,
                            element_38,
                            element_39,
                            element_41,  
                            element_42,
                            element_43,
                            element_44,
                            element_46,
                            element_47,
                            element_48,
                            element_49,
                            element_51,
                            element_52,
                            element_54,
       element_55,
element_56,
element_57,
element_58,
       element_61,
element_62,
element_63,
element_64,
element_65,
element_66,
       element_68,
element_69,
element_70,
element_71,
element_72,
       element_74,
element_75,
element_76,
element_77,
       element_79,
element_80,
element_81,
element_82,
element_83,
       element_85,
       element_87,
element_88,
element_89,
element_90,
element_91,
element_92,
element_93,
element_94,
element_95,
       element_97,
element_98,
element_99,
element_100,
element_101,
element_102,
element_104,
element_105,
element_106,
element_108,
element_109,
element_110,
       element_112,
element_113,
element_114,
element_115,
element_116,
element_117,
element_118,
element_119,
       
       element_121,
element_122,
element_123,
element_124,
element_125,
element_126,
element_127,
element_128,
element_129,
element_130,
element_131,
element_132,
element_133,
element_136,
element_137,
element_138,
element_139,
element_140,
element_141,
element_142,
element_143,
element_144,
element_146,
element_147,
element_148,
element_149,
element_151,
element_152,
element_153,


                            element_286,
                            element_288,
         element_289,
       element_291,
       element_299,
       element_300,
       element_301,
              element_302,
              element_303,
              element_304,
              element_305,
       element_306




                                FROM Inetforms.ap_form_57427 WHERE id = $_GET[entry_id];");

    if(count($request) > 0 ){

        $failed = 0;

        echo "Found it";

        //element 32, and 33,50, 40, 45, 53,  do nto exist
        //59,60, 67
        if($request[0]['element_28'] == 0){$failed = 1;}
        if($request[0]['element_29'] == 0){$failed = 1;}
        if($request[0]['element_30'] == 0){$failed = 1;}
        if($request[0]['element_31'] == 0){$failed = 1;}


        if($request[0]['element_14'] == 0){$failed = 1;}
        if($request[0]['element_15'] == 0){$failed = 1;}
        if($request[0]['element_16'] == 0){$failed = 1;}
        if($request[0]['element_17'] == 0){$failed = 1;}
        if($request[0]['element_18'] == 0){$failed = 1;}
        if($request[0]['element_19'] == 0){$failed = 1;}
        if($request[0]['element_20'] == 0){$failed = 1;}
        if($request[0]['element_21'] == 0){$failed = 1;}
        if($request[0]['element_22'] == 0){$failed = 1;}
        if($request[0]['element_23'] == 0){$failed = 1;}
        if($request[0]['element_26'] == 0){$failed = 1;}
        if($request[0]['element_27'] == 0){$failed = 1;}
        if($request[0]['element_28'] == 0){$failed = 1;}
        if($request[0]['element_29'] == 0){$failed = 1;}
        if($request[0]['element_30'] == 0){$failed = 1;}
        if($request[0]['element_31'] == 0){$failed = 1;}
        if($request[0]['element_34'] == 0){$failed = 1;}
        if($request[0]['element_35'] == 0){$failed = 1;}
        if($request[0]['element_36'] == 0){$failed = 1;}
        if($request[0]['element_37'] == 0){$failed = 1;}
        if($request[0]['element_38'] == 0){$failed = 1;}
        if($request[0]['element_39'] == 0){$failed = 1;}
        if($request[0]['element_41'] == 0){$failed = 1;}
        if($request[0]['element_42'] == 0){$failed = 1;}
        if($request[0]['element_43'] == 0){$failed = 1;}
        if($request[0]['element_44'] == 0){$failed = 1;}
        if($request[0]['element_46'] == 0){$failed = 1;}
        if($request[0]['element_47'] == 0){$failed = 1;}
        if($request[0]['element_48'] == 0){$failed = 1;}
        if($request[0]['element_49'] == 0){$failed = 1;}
        if($request[0]['element_51'] == 0){$failed = 1;}
        if($request[0]['element_52'] == 0){$failed = 1;}
        if($request[0]['element_54'] == 0){$failed = 1;}
        if($request[0]['element_55'] == 0){$failed = 1;}
        if($request[0]['element_56'] == 0){$failed = 1;}
        if($request[0]['element_57'] == 0){$failed = 1;}
        if($request[0]['element_58'] == 0){$failed = 1;}
        if($request[0]['element_61'] == 0){$failed = 1;}
        if($request[0]['element_62'] == 0){$failed = 1;}
        if($request[0]['element_63'] == 0){$failed = 1;}
        if($request[0]['element_64'] == 0){$failed = 1;}
        if($request[0]['element_65'] == 0){$failed = 1;}
        if($request[0]['element_66'] == 0){$failed = 1;}
        if($request[0]['element_68'] == 0){$failed = 1;}
        if($request[0]['element_69'] == 0){$failed = 1;}
        if($request[0]['element_70'] == 0){$failed = 1;}
        if($request[0]['element_71'] == 0){$failed = 1;}
        if($request[0]['element_72'] == 0){$failed = 1;}
        if($request[0]['element_74'] == 0){$failed = 1;}
        if($request[0]['element_75'] == 0){$failed = 1;}
        if($request[0]['element_76'] == 0){$failed = 1;}
        if($request[0]['element_77'] == 0){$failed = 1;}
        if($request[0]['element_79'] == 0){$failed = 1;}
        if($request[0]['element_80'] == 0){$failed = 1;}
        if($request[0]['element_81'] == 0){$failed = 1;}
        if($request[0]['element_82'] == 0){$failed = 1;}
        if($request[0]['element_83'] == 0){$failed = 1;}
        if($request[0]['element_85'] == 0){$failed = 1;}
        if($request[0]['element_87'] == 0){$failed = 1;}
        if($request[0]['element_88'] == 0){$failed = 1;}
        if($request[0]['element_89'] == 0){$failed = 1;}
        if($request[0]['element_90'] == 0){$failed = 1;}
        if($request[0]['element_91'] == 0){$failed = 1;}
        if($request[0]['element_92'] == 0){$failed = 1;}
        if($request[0]['element_93'] == 0){$failed = 1;}
        if($request[0]['element_94'] == 0){$failed = 1;}
        if($request[0]['element_95'] == 0){$failed = 1;}
        if($request[0]['element_97'] == 0){$failed = 1;}
        if($request[0]['element_98'] == 0){$failed = 1;}
        if($request[0]['element_99'] == 0){$failed = 1;}
        if($request[0]['element_100'] == 0){$failed = 1;}
        if($request[0]['element_101'] == 0){$failed = 1;}
        if($request[0]['element_102'] == 0){$failed = 1;}
        if($request[0]['element_104'] == 0){$failed = 1;}
        if($request[0]['element_105'] == 0){$failed = 1;}
        if($request[0]['element_106'] == 0){$failed = 1;}
        if($request[0]['element_108'] == 0){$failed = 1;}
        if($request[0]['element_109'] == 0){$failed = 1;}
        if($request[0]['element_110'] == 0){$failed = 1;}
        if($request[0]['element_112'] == 0){$failed = 1;}
        if($request[0]['element_113'] == 0){$failed = 1;}
        if($request[0]['element_114'] == 0){$failed = 1;}
        if($request[0]['element_115'] == 0){$failed = 1;}
        if($request[0]['element_116'] == 0){$failed = 1;}
        if($request[0]['element_117'] == 0){$failed = 1;}
        if($request[0]['element_118'] == 0){$failed = 1;}
        if($request[0]['element_119'] == 0){$failed = 1;}
        if($request[0]['element_121'] == 0){$failed = 1;}
        if($request[0]['element_122'] == 0){$failed = 1;}
        if($request[0]['element_123'] == 0){$failed = 1;}
        if($request[0]['element_124'] == 0){$failed = 1;}
        if($request[0]['element_125'] == 0){$failed = 1;}
        if($request[0]['element_126'] == 0){$failed = 1;}
        if($request[0]['element_127'] == 0){$failed = 1;}
        if($request[0]['element_128'] == 0){$failed = 1;}
        if($request[0]['element_129'] == 0){$failed = 1;}
        if($request[0]['element_130'] == 0){$failed = 1;}
        if($request[0]['element_131'] == 0){$failed = 1;}
        if($request[0]['element_132'] == 0){$failed = 1;}
        if($request[0]['element_133'] == 0){$failed = 1;}
        if($request[0]['element_136'] == 0){$failed = 1;}
        if($request[0]['element_137'] == 0){$failed = 1;}
        if($request[0]['element_138'] == 0){$failed = 1;}
        if($request[0]['element_139'] == 0){$failed = 1;}
        if($request[0]['element_140'] == 0){$failed = 1;}
        if($request[0]['element_141'] == 0){$failed = 1;}
        if($request[0]['element_142'] == 0){$failed = 1;}
        if($request[0]['element_143'] == 0){$failed = 1;}
        if($request[0]['element_144'] == 0){$failed = 1;}
        if($request[0]['element_146'] == 0){$failed = 1;}
        if($request[0]['element_147'] == 0){$failed = 1;}
        if($request[0]['element_148'] == 0){$failed = 1;}
        if($request[0]['element_149'] == 0){$failed = 1;}
        if($request[0]['element_151'] == 0){$failed = 1;}
        if($request[0]['element_152'] == 0){$failed = 1;}
        if($request[0]['element_153'] == 0){$failed = 1;}
        if($request[0]['element_286'] == 0){$failed = 1;}
        if($request[0]['element_288'] == 0){$failed = 1;}
        if($request[0]['element_289'] == 0){$failed = 1;}
        if($request[0]['element_291'] == 0){$failed = 1;}
        if($request[0]['element_299'] == 0){$failed = 1;}
        if($request[0]['element_300'] == 0){$failed = 1;}
        if($request[0]['element_301'] == 0){$failed = 1;}
        if($request[0]['element_302'] == 0){$failed = 1;}
        if($request[0]['element_303'] == 0){$failed = 1;}
        if($request[0]['element_304'] == 0){$failed = 1;}
        if($request[0]['element_305'] == 0){$failed = 1;}
        if($request[0]['element_306'] == 0){$failed = 1;}





 if($failed == 1){
     echo "Test Failed";
 } else{
     echo "Test Passed";
 }


        

    } else {
        echo "Not found";
    }

}