<?php

include "source/css.php";
ini_set("display_errors",1);
?>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <style type="text/css">
  body{
    font-size:12px;
    padding:10px 10px 10px 10px;
    margin:10px 10px 10px 10px;
  }
.tableNavigation {
    width:1000px;
    text-align:center;
    margin:auto;
    overflow-x:auto;
}
.tableNavigation ul {
    display:inline;
    width:1000px;
}
.tableNavigation ul li {
    display:inline;
    margin-right:5px;
}

#myTable th{
    padding:5px 5px 5px 5px;
}
#myTable td {
     padding:5px 5px 5px 5px;  
}

td{
    background:transparent;
    border:0px solid #bbb;  
    padding:0px 0px 0px 0px;  
    text-align:center;
    font-size:12px;
    vertical-align:middle;
    
}
th{
    font-size:13px;
    white-space: nowrap;
    
    width:auto;
}
tr.even{
    background:-moz-linear-gradient(center top , #F7F7F9, #E5E5E7);
}

tr.odd{
    background:transparent;
}
.setThisRoute{ 
    z-index:9999;
}



input[type=checkbox]{
    width:10px;
}
li{
    display: inline;
    float:left;
    margin-left:10px;
    padding:5px 5px 5px 5px;
     border: 2px solid green;
   border-top-left-radius: 4px;
   border-top-right-radius: 4px;
   background:#DADADA;
   color:black;
   font-weight:bold;
   font-size:16px;
}

li:hover{
    background:white;
}
</style>
<script>
  $( function() {
    $( "#tabs" ).tabs();
    $("li").click(function(){
         $("li").css("background-color","#DADADA");
         $("li").css("border-bottom:","#FBFBFB");
         $(this).css("background-color","1px");
         $("a").css("color","black")
         var j = $(this).find("a");
         $(this).css("border-bottom","0px;");
         $(j).css("color","white");
    });
    
    var iFrames = $('iframe');
      
    function iResize() {
    	
    	for (var i = 0, j = iFrames.length; i < j; i++) {
    	iFrames[i].style.height = iFrames[i].contentWindow.document.body.offsetHeight + 'px';}
    }
    	    
    if ($.support.safari || $.support.opera) { 
    
       iFrames.load(function(){
           setTimeout(iResize, 0);
       });
    
       for (var i = 0, j = iFrames.length; i < j; i++) {
    		var iSource = iFrames[i].src;
    		iFrames[i].src = '';
    		iFrames[i].src = iSource;
       }
       
    } else {
       iFrames.load(function() { 
           this.style.height = this.contentWindow.document.body.offsetHeight + 'px';
       });
    }
        
      
  } );

  
</script>

 <ul style="width: auto;display:inline-block;width:100%;float:left;background: green;" id="tabs">
    <li><a href="outbound1.php" target="targe" >OutBound</a></li>
    <li><a href="outboundmx.php"  target="targe" >OutBound MX</a></li>
    <li><a href="outboundbio.php"  target="targe" >OutBound BIO</a></li>
    <li><a href="outboundmgxgrease.php"  target="targe" >OutBound MX Grease</a></li>
    <li><a href="inwcs.php"  target="targe" >IN WCS</a></li>
    <li><a href="inbound.php"  target="targe" >Inbound</a></li>
    <li><a href="ingrease.php"  target="targe" >IN-Grease</a></li>
    <li><a href="rwater.php"  target="targe" >R-Water</a></li>
    <li><a href="petfood.php"  target="targe" >Pet Food</a></li>
  </ul>
<iframe name="targe" id="targe" style="width:3200px;float:left;border:0px solid #bbb;height:1800px;background:transparent;"></iframe>  

  