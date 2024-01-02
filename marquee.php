<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>jQuery Marquee Demo</title>
    <style type="text/css" media="screen">
    <!--
      body { 
          margin: 10px; 
          padding: 10px; 
          font: 1em "Trebuchet MS", verdana, arial, sans-serif; 
          font-size: 80%;
      }
      
      div.demo {
          border: 3px solid #0BB427;
          padding: 10px;
          margin-bottom: 10px;
      }
      
      div.original {
          border: 3px solid #B40400;
          padding: 10px;
      }
      
      .pointer {
          cursor: pointer;
      }
      
      code {
          padding: 3px;
          background-color: #eee;
      }
    -->
    </style>

    <script src="js/jquery-1.11.1.js"></script>
    <script>
/**
* author Remy Sharp
* url http://remysharp.com/tag/marquee
*/

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
    <!--
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
    //-->
    </script>
  </head>
  <body id="page">
    <div id="doc">
        <h1>jQuery Marquee Demo</h1>
        <p>Full details of how this plugin works and where do download can be taken from <a href="http://remysharp.com/2008/09/10/the-silky-smooth-marquee/">jQuery marquee project page</a>.</p>
        <div class="demo">
            <h2>Vanilla</h2>
            <pre><code>&lt;marquee behavior="scroll" scrollamount="1" direction="left" width="350"&gt;</code></pre>
            <marquee behavior="scroll" direction="left" scrollamount="2" width="350"><p>START Lorem ipsum dolor sit amet END</p></marquee>
            <pre><code>&lt;marquee scrollamount="2" behavior="alternate" direction="right" width="350"&gt;</code></pre>
            <marquee scrollamount="2" behavior="alternate" direction="right" width="350"><p>START Lorem ipsum dolor sit amet END</p></marquee>
            <pre><code>&lt;marquee loop="3" behavior="slide" direction="right" width="350"&gt;</code></pre>
            <marquee loop="3" behavior="slide" direction="right" width="350"><p>START Lorem ipsum dolor sit amet END</p></marquee>
            <pre><code>&lt;marquee behavior="scroll" direction="down" scrollamount="2" height="100" width="350"&gt;</code></pre>
            <marquee behavior="scroll" direction="down" scrollamount="2" height="100" width="350"><p>START Lorem ipsum dolor sit amet END</p></marquee>

        </div>

        <div class="original">
            <h2>Without jQuery Progressive Enhancement</h2>
            <small>Note: scrollamount has been increased to match speed</small>
            <pre><code>&lt;marquee behavior="scroll" scrollamount="3" direction="left" width="350"&gt;</code></pre>
            <marquee behavior="scroll" scrollamount="3" direction="left" width="350"><p>START Lorem ipsum dolor sit amet END</p></marquee>
            <pre><code>&lt;marquee scrollamount="6" behavior="alternate" direction="right" width="350"&gt;</code></pre>
            <marquee scrollamount="6" behavior="alternate" direction="right" width="350"><p>START Lorem ipsum dolor sit amet END</p></marquee>
            <pre><code>&lt;marquee loop="3" scrollamount="3" behavior="slide" direction="right" width="350"&gt;</code></pre>
            <marquee loop="1" behavior="slide" direction="right" width="350"><p>START Lorem ipsum dolor sit amet END</p></marquee>

            <pre><code>&lt;marquee behavior="scroll" direction="down" height="100" width="350"&gt;</code></pre>
            <marquee behavior="scroll" direction="down" height="100" width="350"><p>START Lorem ipsum dolor sit amet END</p></marquee>
        </div>
    </div>
  </body>
</html>





