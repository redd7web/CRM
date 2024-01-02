<?php 
ini_set("display_errors",1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="ReDDaWG" />
    <meta http-equiv="expires" content="0" />
    <meta charset="UTF-8" />
    <script src="js/jquery-1.11.1.js"></script>
    
    <script type="text/javascript" src="plugins/shadow/shadowbox.js"></script>
    
    <link type="text/css" rel="stylesheet" href="plugins/shadow/shadowbox.css" />
    <style type="text/css">
    body{
        
        padding:0px 0px 0px 0px;
        margin:0px 0px 0px 0px;
    }
     div.demo {
          border: 0px solid #0BB427;
          padding: 10px;
          margin-bottom: 10px;
      }
      
      div.original {
          border: 0px solid #B40400;
          padding: 10px;
      }
      
      .pointer {
          cursor: pointer;
      }
      
      code {
          padding: 3px;
          background-color: #eee;
      }
      
      td{
        font-family:arial;
      }
      .scrabble{
        display:inline-block;
        cursor:pointer;
      }
    </style>
    <script type="text/javascript">
        Shadowbox.init({
            showOverlay:true,
            modal:false, 
            loadingImage:"shadow/loading.gif",
            displayNav: true,
            slideshowDelay: 2,        
            overlayOpacity: '0.9',
            overlayColor:"rgb(113,124,90)",
            gallery: "gall" ,
                
        });
        (function ($) {
        $.fn.marquee = function (klass) {
            var newMarquee = [],
            last = this.length;

                // works out the left or right hand reset position, based on scroll
                // behavior, current direction and new direction
                function getReset(newDir, marqueeRedux, marqueeState) {
                    var behavior = marqueeState.behavior, width = marqueeState.width, dir = marqueeState.dir;
                    var r = 0;
                    if (behavior == 'alternate') {
                        r = newDir == 1 ? marqueeRedux[marqueeState.widthAxis] - (width*2) : width;
                    } else if (behavior == 'slide') {
                        if (newDir == -1) {
                            r = dir == -1 ? marqueeRedux[marqueeState.widthAxis] : width;
                        } else {
                            r = dir == -1 ? marqueeRedux[marqueeState.widthAxis] - (width*2) : 0;
                        }
                    } else {
                        r = newDir == -1 ? marqueeRedux[marqueeState.widthAxis] : 0;
                    }
                    return r;
                }
        
                // single "thread" animation
                function animateMarquee() {
                    var i = newMarquee.length,
                        marqueeRedux = null,
                        $marqueeRedux = null,
                        marqueeState = {},
                        newMarqueeList = [],
                        hitedge = false;
                        
                    while (i--) {
                        marqueeRedux = newMarquee[i];
                        $marqueeRedux = $(marqueeRedux);
                        marqueeState = $marqueeRedux.data('marqueeState');
                        
                        if ($marqueeRedux.data('paused') !== true) {
                            // TODO read scrollamount, dir, behavior, loops and last from data
                            marqueeRedux[marqueeState.axis] += (marqueeState.scrollamount * marqueeState.dir);
        
                            // only true if it's hit the end
                            hitedge = marqueeState.dir == -1 ? marqueeRedux[marqueeState.axis] <= getReset(marqueeState.dir * -1, marqueeRedux, marqueeState) : marqueeRedux[marqueeState.axis] >= getReset(marqueeState.dir * -1, marqueeRedux, marqueeState);
                            
                            if ((marqueeState.behavior == 'scroll' && marqueeState.last == marqueeRedux[marqueeState.axis]) || (marqueeState.behavior == 'alternate' && hitedge && marqueeState.last != -1) || (marqueeState.behavior == 'slide' && hitedge && marqueeState.last != -1)) {                        
                                if (marqueeState.behavior == 'alternate') {
                                    marqueeState.dir *= -1; // flip
                                }
                                marqueeState.last = -1;
        
                                $marqueeRedux.trigger('stop');
        
                                marqueeState.loops--;
                                if (marqueeState.loops === 0) {
                                    if (marqueeState.behavior != 'slide') {
                                        marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir, marqueeRedux, marqueeState);
                                    } else {
                                        // corrects the position
                                        marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir * -1, marqueeRedux, marqueeState);
                                    }
        
                                    $marqueeRedux.trigger('end');
                                } else {
                                    // keep this marquee going
                                    newMarqueeList.push(marqueeRedux);
                                    $marqueeRedux.trigger('start');
                                    marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir, marqueeRedux, marqueeState);
                                }
                            } else {
                                newMarqueeList.push(marqueeRedux);
                            }
                            marqueeState.last = marqueeRedux[marqueeState.axis];
        
                            // store updated state only if we ran an animation
                            $marqueeRedux.data('marqueeState', marqueeState);
                        } else {
                            // even though it's paused, keep it in the list
                            newMarqueeList.push(marqueeRedux);                    
                        }
                    }
        
                    newMarquee = newMarqueeList;
                    
                    if (newMarquee.length) {
                        setTimeout(animateMarquee, 25);
                    }            
                }
                
                // TODO consider whether using .html() in the wrapping process could lead to loosing predefined events...
                this.each(function (i) {
                    var $marquee = $(this),
                        width = $marquee.attr('width') || $marquee.width(),
                        height = $marquee.attr('height') || $marquee.height(),
                        $marqueeRedux = $marquee.after('<div ' + (klass ? 'class="' + klass + '" ' : '') + 'style="display: block-inline; width: ' + width + 'px; height: ' + height + 'px; overflow: hidden;"><div style="float: left; white-space: nowrap;">' + $marquee.html() + '</div></div>').next(),
                        marqueeRedux = $marqueeRedux.get(0),
                        hitedge = 0,
                        direction = ($marquee.attr('direction') || 'left').toLowerCase(),
                        marqueeState = {
                            dir : /down|right/.test(direction) ? -1 : 1,
                            axis : /left|right/.test(direction) ? 'scrollLeft' : 'scrollTop',
                            widthAxis : /left|right/.test(direction) ? 'scrollWidth' : 'scrollHeight',
                            last : -1,
                            loops : $marquee.attr('loop') || -1,
                            scrollamount : $marquee.attr('scrollamount') || this.scrollAmount || 2,
                            behavior : ($marquee.attr('behavior') || 'scroll').toLowerCase(),
                            width : /left|right/.test(direction) ? width : height
                        };
                    
                    // corrects a bug in Firefox - the default loops for slide is -1
                    if ($marquee.attr('loop') == -1 && marqueeState.behavior == 'slide') {
                        marqueeState.loops = 1;
                    }
        
                    $marquee.remove();
                    
                    // add padding
                    if (/left|right/.test(direction)) {
                        $marqueeRedux.find('> div').css('padding', '0 ' + width + 'px');
                    } else {
                        $marqueeRedux.find('> div').css('padding', height + 'px 0');
                    }
                    
                    // events
                    $marqueeRedux.bind('stop', function () {
                        $marqueeRedux.data('paused', true);
                    }).bind('pause', function () {
                        $marqueeRedux.data('paused', true);
                    }).bind('start', function () {
                        $marqueeRedux.data('paused', false);
                    }).bind('unpause', function () {
                        $marqueeRedux.data('paused', false);
                    }).data('marqueeState', marqueeState); // finally: store the state
                    
                    // todo - rerender event allowing us to do an ajax hit and redraw the marquee
        
                    newMarquee.push(marqueeRedux);
        
                    marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir, marqueeRedux, marqueeState);
                    $marqueeRedux.trigger('start');
                    
                    // on the very last marquee, trigger the animation
                    if (i+1 == last) {
                        animateMarquee();
                    }
                });            
        
                return $(newMarquee);
            };
        }(jQuery));
        </script>
        <script type="text/javascript">
        $(function () {
            // basic version is: $('div.demo marquee').marquee() - but we're doing some sexy extras
            
            $('div.demo marquee').marquee('pointer').mouseover(function () {
                $(this).trigger('stop');
            }).mouseout(function () {
                $(this).trigger('start');
            }).mousemove(function (event) {
                if ($(this).data('drag') == true) {
                    this.scrollLeft = $(this).data('scrollX') + ($(this).data('x') - event.clientX);
                }
            }).mousedown(function (event) {
                $(this).data('drag', true).data('x', event.clientX).data('scrollX', this.scrollLeft);
            }).mouseup(function () {
                $(this).data('drag', false);
            });
        });
        </script>
	<title>IWP Management System</title>
</head>
<body>

<div id="cover" style="width:100%;height:auto;margin:auto;overflow:hidden;border:0px solid green;min-height:1444px;background:url(img/img/bodystrip.jpg) repeat-x left top;padding:0px 0px 0px 0px;">
    <table><tr><td style="width: 100%;height:70px;text-align:left;vertical-align:middle;"><span style="float:left;margin-left:5px;font-size:34px;color:rgb(236,134,11);font-family:gothic;">Welcome to Imperial Western Network Solutions</span>
    <span style="float: right;margin-right:5px;border-collapse:collapse;width:auto;"><?php echo date("l, F j Y")." ".date("H:i a"); ?></span>
    <div class="demo" style="width: 100%;float:left;margin-left:-5px;background:white;color:black;text-align:center;">
    <marquee behavior="scroll" scrollamount="1" direction="left" width="1130" >Welcome to the new INET homepage!  We have added some new features as well and are available with a simple click! * The google maps icon will bring you to a free form route optimization application * Filebound is now also accessible by clicking it�s icon and will bring a new environment full of functionality * Our new Grease Trap Module is available under its respected Biotane logo * Organics will be coming soon * Clicking the �Your Logo Here� will bring up a couple sample forms that can be used as a sales tool or reference </marquee></div>
    </td></tr>
    <tr><td style="height: 123px;text-align:center;vertical-align:top;" colspan="2">
    
    <a  href="home.php" ><img src="img/img/pumpm.png" style="margin-right:5px;"/></a>
    <a href="bakery/"><img src="img/img/bakem.png"  style="margin-right:5px;"/></a>
    <a href="grease/"><img src="img/img/greasem.png" style="margin-right:5px;"/></a>
    <a href="organics/"><img src="img/img/orgm.png"  style="margin-right:5px;"/></a>
    <a href="assets/"><img src="img/img/ov.png"  /></a>
    <a href="sludge/"><img src="sludge/img/sludge.png" style="margin-right:5px;"/></a>
    </td></tr>
    <tr><td style="height: 150px;text-align:center;vertical-align:top;" colspan="2">
     <div style="text-align: center;float:left;"><a href="ops.php" rel="shadowbox;width=400px;height=500px;"><img src="img/img/ops.jpg"  id="ops_forms" style="cursor: pointer;margin-right:5px;"/></a></div>
     <div style="text-align: center;float:left;"><a href="cuteflow/cuteflow_v.2.11.2/"><img src="img/img/workflows.jpg" style="margin-right:5px;"/></a></div>
     <div style="text-align: center;float:left;"><a href="compliance.php" rel="shadowbox;width=400px;height=500px;"><img src="img/compliance.jpg"/></a></div>
     <div style="text-align: center;float:left;"><a href="https://iwp.filebound.com/LogOn.aspx"><img src="grease/img/filebound-fb.png"  style="width:102px;height:100px;"/></a></div>
     <div style="text-align: center;float:left;"><a href="https://na3.docusign.net/Member/PowerFormSigning.aspx?PowerFormId=c065d3ff-2283-4551-b306-bc41a0ce79cb" title="Docusign" target="_blank"><img src="img/docusign2.jpg" style="width:102px;height:100px;"/></a></div>
     <div style="text-align: center;float:left;"><a href="indexmap.php" target="_blank"><img src="img/map.png"/></a></div>
     <div style="text-align: center;float:left;"><a href="lab.php" rel="shadowbox"><img src="img/lab.jpg" style="width:80px;height:80px;"/></a></div>
     <div style="text-align: center;float:left;"><a href="labpass.php" rel="shadowbox"><img src="img/lab-3.png" style="width:80px;height:80px;"/></a></div>
     <div style="text-align: center;float:left;"><a title="Assets" href="links.php" rel="shadowbox;width=504px;height=500px" target="_blank"><img src="img/tool.jpg" style="width: 102px; height:100px;"/></a></div>
     <div style="text-align: center;float:left;"><a title="IT Project Request Help Form" href="ITProjectRequest.php" target="_blank"><img src="img/itp.png"/></a></div>
    <div style="text-align: center;float:left;"><a title="Email IT Help" href="mailto:help@iwpusa.com"><img src="img/email.jpg" style="width: 102px;height:100px;"/><br />Email IT Help</a></div>
	<div style="text-align: center; float:left;"><a title="Scale Dash"  rel="shadowbox;width=400px;height=150px;" href="scaleDash.php"><img id="Scale_pic" src="/img/img/scale_img.png" style="height: 102px; width: 100px"/></a> </div>
	</td></tr>
    <!--<a href="ticket_queue.php" target="_blank"><img src="img/hd.png" /></a>--!></td></tr>
   <tr><td style="height: 20px;">&nbsp;</td></tr>
   <tr><td style="height:40px;vertical-align:center;text-align:left;color:white;font-size:20px;font-weight:bold;background: rgb(241,231,103); /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover, rgba(241,231,103,1) 0%, rgba(254,182,69,1) 100%); /* FF3.6-15 */
background: -webkit-radial-gradient(center, ellipse cover, rgba(241,231,103,1) 0%,rgba(254,182,69,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: radial-gradient(ellipse at center, rgba(241,231,103,1) 0%,rgba(254,182,69,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f1e767', endColorstr='#feb645',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */" colspan="2">&nbsp;&nbsp;Co-West Commodities </td></tr>
        <tr>
            <td style="width: 50%;height: 185px;vertical-align:top;text-align:center;"> 
            <a href="cowestlogin.php" rel="shadowbox;width=450;height=250;"><img style="margin-right:5px;"src="img/cwlgo.jpg"/></a>
            <a href='https://na3.docusign.net/Member/PowerFormSigning.aspx?PowerFormId=92346203-914b-4b25-ac97-b9dd4112abc3'><img id="co-west_docusign" src="img/img/docusigncwc.PNG" style="width:102px;height:100px;" /></a>
            <a href="mscraps.php" rel="shadowbox;width=400px;height=150px;"><img id="meat_scraps" src="img/img/cow.jpg"  style="cursor:pointer;"/></a>
            </td>
            <td style="vertical-align: top;text-align:left;width:50%;">
            
            </td>
    </tr>
<!--     
		<tr>
			<td style="height:40px;vertical-align:center;text-align:left;color:white;font-size:20px;font-weight:bold;background: rgb(241,231,103); /* Old browsers */
			background: -moz-radial-gradient(center, ellipse cover, rgba(241,231,103,1) 0%, rgba(254,182,69,1) 100%); /* FF3.6-15 */
			background: -webkit-radial-gradient(center, ellipse cover, rgba(241,231,103,1) 0%,rgba(254,182,69,1) 100%); /* Chrome10-25,Safari5.1-6 */
			background: radial-gradient(ellipse at center, rgba(241,231,103,1) 0%,rgba(254,182,69,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f1e767', endColorstr='#feb645',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */" colspan="2">&nbsp;&nbsp;CSM Bakery Solutions
			</td>
		</tr>
    
      
    <tr>
		<td style="width: 50%;height: 185px;vertical-align:top;text-align:center;">
			<a href="csmx.php" rel="shadowbox;width=200px;height=150px;"><img src="img/index.jpg" style="cursor: pointer;"/></a>
		</td>
	</tr>
   --> 
    
    <!--<tr><td style="height:40px;vertical-align:center;text-align:left;color:white;font-size:20px;font-weight:bold;background: rgb(241,231,103); /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover, rgba(241,231,103,1) 0%, rgba(254,182,69,1) 100%); /* FF3.6-15 */
background: -webkit-radial-gradient(center, ellipse cover, rgba(241,231,103,1) 0%,rgba(254,182,69,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: radial-gradient(ellipse at center, rgba(241,231,103,1) 0%,rgba(254,182,69,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f1e767', endColorstr='#feb645',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */" colspan="2">&nbsp;&nbsp;Divisions</td></tr>
    
      
    <tr><td style="width: 50%;height: 200px;vertical-align:top;text-align:center;">
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -228px 0px;" id="b" ></div>
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -338px 0px;margin-left:5px;" id="c"></div>
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -448px 0px;margin-left:5px;" id="d"></div>
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -9px -111px;margin-left:5px;" id="e"></div>
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -117px -111px;margin-left:5px;" id="f"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -228px -111px;margin-left:5px;" id="g"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -338px -111px;margin-left:5px;" id="h"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -448px -111px;margin-left:5px;" id="i"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -561px -111px;margin-left:5px;" id="j"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -9px -222px;margin-left:5px;" id="k"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -117px -222px;margin-left:5px;" id="l"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -228px -222px;margin-left:5px;" id="m"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -338px -222px;margin-left:5px;" id="n"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -448px -222px;margin-left:5px;" id="o"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -561px -222px;margin-left:5px;" id="p"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -9px -332px;margin-left:5px;" id="q"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -117px -332px;margin-left:5px;" id="r"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -228px -332px;margin-left:5px;" id="s"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -338px -332px;margin-left:5px;" id="t"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -448px -332px;margin-left:5px;" id="u"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -561px -332px;margin-left:5px;" id="v"></div>
        
        <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -117px -442px;margin-left:5px;" id="w"></div>
        
         <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -228px -442px;margin-left:5px;" id="x"></div>
         
          <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -332px -442px;margin-left:5px;" id="y"></div>
           <div class="scrabble" style="width: 101px;height:110px;background:url(img/scrabble_letters.jpg) no-repeat -448px -442px;margin-left:5px;" id="z"></div>
    </td></tr>
    
    <tr><td style="height:40px;vertical-align:center;text-align:left;color:white;font-size:20px;font-weight:bold;background: rgb(241,231,103); /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover, rgba(241,231,103,1) 0%, rgba(254,182,69,1) 100%); /* FF3.6-15 */
background: -webkit-radial-gradient(center, ellipse cover, rgba(241,231,103,1) 0%,rgba(254,182,69,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: radial-gradient(ellipse at center, rgba(241,231,103,1) 0%,rgba(254,182,69,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f1e767', endColorstr='#feb645',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */" colspan="2">&nbsp;&nbsp;Jessie Lord Bakery LLC</td></tr>
    <tr><td style="width: 50%;height: 185px;vertical-align:top;text-align:center;">
    <a href="bakery/jl_option.php"  rel="shadowbox;width=200px;height=150px;"><img src="bakery/img/jl.jpg"/></a>
    </td></tr>--!>
   
    </table>
    <div id="spacer" style="width: 100%;height:15px;">
    
    </div>
    <!--
    <div id="bottom" style="width: 100%;height:300px;background:transparent">
        <div id="bottom_left" style="width:50%;height:300px;float:left;">
            <a href="https://inet.iwpusa.com/samplex.php" rel="shadowbox;width=200px;height=300px;" ><img src="https://promotionalhacks.files.wordpress.com/2013/11/your_logo_here_logomark_symbol_by_garconis-d53d7q6.png" style="width: 400px;height:200px;float:left;margin-left:10px;margin-top:10px;"/></a>
        </div>
        <div id="bottom_right" style="height:300px;width:50%;float:left;text-align:center;">
            <p>text here</p>
        </div>
        
    </div>--!>
    
    <div style="clear:both;"></div>
</div>

  
  


<script>
$("#ops_forms").click(function(){
    $("#formlist").fadeIn("fast");
});
$("#formlist").hide();
$("#meat_scraps").click(function(){
    $("#meatlist").fadeIn("fast");
});
$("#meatlist").hide();

<?php
    if(isset($_GET['from_cowest'])){
        ?>
        $(window).load(function(){
            Shadowbox.open({
                player:"iframe",
                content:"cowestlogin.php",            
                width:450,
                height:250,
                title:"Co-West Login"
            });    
        });
        
        <?php
    }

?>

$(".scrabble").click(function(){
    Shadowbox.open({
        player:"iframe",
        content:"portals.php?div="+$(this).attr("id")+"",
        width:450,
        height:500    
    });
});
</script>
</body>
</html>
