/* ---------------------------------------------------------------------- */
        /*  Sort by dropdown values change on select of filter type
        /* ---------------------------------------------------------------------- */
            function checkFilterTypeSelection(){
                if(!$('#edit-sort-order').hasClass('namingdone')){
                    $('#edit-sort-order').addClass('namingdone');
                    if($('#edit-sort-by').val()=='timestamp'){
                        $('#edit-sort-order').html('<option value="ASC" selected="selected">Please Select</option><option value="ASC">Oldest</option><option value="DESC">Latest</option>');
                    }else if($('#edit-sort-by').val()=='filesize'){
                        $('#edit-sort-order').html('<option value="ASC" selected="selected">Please Select</option><option value="DESC">Largest</option><option value="ASC">Smallest</option>');
                    }else if($('#edit-sort-by').val()=='filename'){
                        $('#edit-sort-order').html('<option value="ASC" selected="selected">Please Select</option><option value="ASC">Ascending</option><option value="DESC">Descending</option>');
                    }
                }
            }
            $(document).ready(function(e) {
                setInterval(function(){checkFilterTypeSelection();}, 100);    
            });
			
/* ------------------------------------------------------------------------ */
/* BEGIN USE STRICT *///
/* ------------------------------------------------------------------------ */

(function ($) {
    "use strict";

    /* ------------------------------------------------------------------------ */
    /* LOADER *///
    /* ------------------------------------------------------------------------  */

    jQuery(window).load(function () { // makes sure the whole site is loaded
        jQuery('#status').fadeOut(); // will first fade out the loading animation
        jQuery('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
        jQuery('body').delay(350).css({'overflow': 'visible'});        
        if ($("#youtube_0").length > 0) {
            callPlayer("youtube_0", "pauseVideo");
        }       
    });

    jQuery(document).ready(function() {
		
        /* ---------------------------------------------------------------------- */
        /*  magnific-popup
        /* ---------------------------------------------------------------------- */

        try {
            // Example with multiple objects
            $('.zoom').magnificPopup({
                type: 'image',
                image: {
            titleSrc: function(item) {          
                return $(item.el).attr('data-title');          
            },
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
          },            
                gallery:{enabled:true}
            });

        } catch(err) {

        }

        /* ---------------------------------------------------------------------- */
        /*  isotope
        /* ---------------------------------------------------------------------- */
        var winDow = $(window);
        // Needed variables
        var $container=$('#isotope-container');
        var $filter=$('#filter');
        winDow.load(function() {
            var selector = $filter.find('a.active').attr('data-filter');
            try {
                $('#our-work .item-caption').each(function() {
                    $('#our-work .item-caption').css('height', $(this).find('.item-image').height() + 'px');
                });
                $container.isotope({ 
                    filter  : selector,
                    animationOptions: {
                        duration: 750,
                        easing  : 'linear',
                        queue   : false,
                    }
                });
            } catch(err) {
            }       
        });
        winDow.bind('resize', function(){           

            var selector = $filter.find('a.active').attr('data-filter');

            try {
                $('#our-work .item-caption').each(function() {
                    $('#our-work .item-caption').css('height', $(this).find('.item-image').height() + 'px');
                });
                $container.isotope({ 
                    filter  : selector,
                    animationOptions: {
                        duration: 750,
                        easing  : 'linear',
                        queue   : false,
                    }
                });
            } catch(err) {
            }
            return false;
        });             

        /* ------------------------------------------------------------------------ */
        /* STICKY NAVIGATION *///
        /* ------------------------------------------------------------------------ */

        $(window).scroll(function () {
            var windowTop = Math.max($('body').scrollTop(), $('html').scrollTop());
            var home_height = $('.home, .sub-page-banner').outerHeight();
            $('nav.navbar-default').each(function (index) {
                if ($(window).scrollTop() < home_height) {
                    
                }
                if (windowTop > ($(this).position().top - 0))
                {
                    $('nav.navbar-default').removeClass('stickey-nav');
                    $('nav.navbar-default:eq(' + index + ')').addClass('stickey-nav');
                }
            });
        });



        /* ------------------------------------------------------------------------ */
        /* SMALL HEADER *///
        /* ------------------------------------------------------------------------ */

        $(window).scroll(function () {
            var scroll = jQuery(window).scrollTop();
            if (scroll >= 500) {
                $("body").addClass("classic-stickey");
            }
            else {
                $("body").removeClass("classic-stickey");
            }
        });

        /* ------------------------------------------------------------------------ */
        /* BACK TO TOP 
         /* ------------------------------------------------------------------------ */

        $(window).scroll(function () {
            if ($(window).scrollTop() > 200) {
                $("#back-to-top").addClass('to-top');
            } else {
                $("#back-to-top").removeClass('to-top');
            }
        });

        $('#back-to-top, .back-to-top, .navbar-to-top').click(function () {
            $('html, body').animate({scrollTop: 0}, '800');
            return false;
        });

        /* ------------------------------------------------------------------------ */
        /* MENU SMOOTH SCROLLING *///
        /* ------------------------------------------------------------------------ */

        jQuery('.scroll').each(function () {
            var $this = jQuery(this),
                target = this.hash;
            var hash = window.location.hash;
            if (hash == target || (hash == '' && target == '#home' && jQuery('body').hasClass('front') && jQuery('body').hasClass('not-front'))) {                
                jQuery(this).parent().addClass('active');
            }
            if (jQuery(target).length > 0) {
                jQuery(this).click(function (e) {                    
                    e.preventDefault();
                    if ($this.length > 0) {
                        if ($this.attr('href') == '#') {
                            // Do nothing   
                        } else {
                            jQuery('html, body').animate({
                                scrollTop: (jQuery(target).offset().top) - 90
                            }, 1000);
                            jQuery(this).parent().parent().find('li.active').removeClass('active');
                            jQuery(this).parent().addClass('active');
                        }
                    }
                });
            }            
        });

        /* ------------------------------------------------------------------------ */
        /* ALL COMMON CODES *///
        /* ------------------------------------------------------------------------ */

        // You can also use "$(window).load(function() {"
        jQuery(function () {

            //NICE SCROLL
            // var nice = jQuery("html").niceScroll();  // You can make The document page (body) Touchenable.....{touchbehavior:true}

            //PARALLAX
            jQuery.stellar({
                horizontalScrolling: false,
                verticalOffset: 0
            });

            //FULL PAGE
            if (jQuery('body').hasClass('front')) {
                jQuery.fn.fullpage({
                    'verticalCentered': false
                });
            }            

            //FULL SCREEN VIDEO
            var $allVideos = jQuery("iframe[src^='http://player.vimeo.com'], iframe[src^='http://www.youtube.com']"), /*, object, embed*/
                    jQueryfluidEl = jQuery("figure");

            $allVideos.each(function () {

                jQuery(this)
                        // jQuery .data does not work on object/embed elements
                        .attr('data-aspectRatio', this.height / this.width)
                        .removeAttr('height')
                        .removeAttr('width');

            });

            jQuery(window).resize(function () {

                var newWidth = jQueryfluidEl.width();
                $allVideos.each(function () {

                    var jQueryel = jQuery(this);
                    jQueryel
                            .width(newWidth)
                            .height(newWidth * jQueryel.attr('data-aspectRatio'));

                });
                if ($('.line-last').length > 0) {
                    var position =  $('.line-last').position().top;
                    var height_parent =  $('.line-last').parent().height();
                    var padding_bottom = height_parent - position - 1;
                    $('.wrap-line').css('padding-bottom', padding_bottom);
                }                

            }).resize();

            // SEE ON GOOGLE MAP BUTTON
            // jQuery('#see-on-google').click(function (e) {
            //     jQuery('.map .overlay-fajar').fadeOut(1000);
            //     jQuery('.map .contact-info-widget').fadeOut(1000);
            //     jQuery('.map .heading').fadeOut(1000);
            //     jQuery('.map .contact-form-widget').fadeOut(1000);
            //     jQuery('#back-to-map-overlay').fadeIn(0);
            //     jQuery('#back-to-map-overlay').css('display', 'table');
            // });
            // jQuery('#back-to-map-overlay').click(function (e) {
            //     jQuery('.map .overlay-fajar').fadeIn(1000);
            //     jQuery('.map .contact-info-widget').fadeIn(1000);
            //     jQuery('.map .heading').fadeIn(1000);
            //     jQuery('.map .contact-form-widget').fadeIn(1000);
            //     jQuery('#back-to-map-overlay').fadeOut(0);
            // });

            //SHARE OPEN
            jQuery('#share-btn').click(function (e) {
                jQuery('#share-sec').fadeIn(1000);
            });

            //SHARE CLOSE
            jQuery('#share-sec-close, .share-sec .overlay-fajar').click(function (e) {
                jQuery('#share-sec').fadeOut(1000);
            });

            //MAP POPUP
            // jQuery('#map-address-popup-btn').click(function (e) {
            //     jQuery('.map-address-popup').fadeToggle(1000);
            //     jQuery('#map-address-popup-btn i').toggleClass('fa-plus fa-minus');
            // });

            //SHOW/Hide HIDDEN CONTENT
            jQuery('#show-hidden-content').click(function (e) {
                jQuery('#hidden-content').fadeToggle(1000);
            });
            jQuery('#show-hidden-content.down-arrow').click(function (e) {
                jQuery('#show-hidden-content i').toggleClass('icon-arrow-down6');
                jQuery('#show-hidden-content i').toggleClass('icon-arrow-up6');
            });

            //SLIDE-UP MENU ON MOBILE
            if (screen.width < 990) {
                jQuery('#navbar-default li a.scroll').click(function (e) {
                    jQuery('.navbar-collapse').removeClass('in');
                });
            }
        });
        if ($('.line-last').length > 0) {
            var position =  $('.line-last').position().top;
            var height_parent =  $('.line-last').parent().height();
            var padding_bottom = height_parent - position - 1;
            $('.wrap-line').css('padding-bottom', padding_bottom);
        }
        $('.user-experience .carousel-inner .item .icon-big').each(function(i, obj) {
            var icon =  $(this).html();
            var html_icon = '<div class="icon-small">'+icon+'</div>'
            $('.user-experience .carousel-indicators li[data-slide-to="'+i+'"]').html(html_icon);
        });
        
        $('.testimonials .testimonial .img_thumb').each(function(i, obj) {
            var img_thumb  = $(this).html();
            var html_img = img_thumb+'<span class="overlay-fajar"></span><i class="fa fa-quote-left"></i>';
            
            $('.testimonials .carousel-indicators li[data-slide-to="'+i+'"]').html(html_img);
            $(this).remove();
        });
        
        // $('.front #blog .view-content').addClass('blog-timeline')
        //                         .prepend('<div class="line"></div>');
                        
        // $('#blog .views-row-even .blog-thumb').each(function(i, obj){
        //     var blog_thumb = $(this).html();
        //     $(this).parents('.blog-post-timeline').prepend('<div class="blog-thumb">'+blog_thumb+'</div>')
        //                                           .removeClass('right-thumb')
        //                                           .addClass('left-thumb');
        //     $(this).remove();
            
        // });
        
    });    

})(jQuery);













/* ------------------------------------------------------------------------ */
/* JavaScript Code For Video Must be Outside From jQuery Function *///
/* ------------------------------------------------------------------------ */


function playVid()
{
    callPlayer("youtube_0", "playVideo");
    jQuery('.overlay-fajar').css('background', 'none');
}

function pauseVid()
{
    callPlayer("youtube_0", "pauseVideo");
}


//form submit
function checkmail(input)
{
    var pattern1 = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (pattern1.test(input)) {
        return true;
    } else {
        return false;
    }
}
function proceed() {
    var fName = document.getElementById("fName");
    var lastName = document.getElementById("lastName");
    var email = document.getElementById("email");
    var subject = document.getElementById("subject");
    var msg = document.getElementById("message");
    var errors = "";

    if (fName.value == "")
    {
        fName.className = 'error';
        return false;
    }

    else if (lastName.value == "")
    {
        lastName.className = 'error';
        return false;
    }

    else if (email.value == "")
    {
        email.className = 'error';
        return false;
    }
    else if (checkmail(email.value) == false)
    {
        alert('Please provide a valid email address.');
        return false;

    }

    else if (subject.value == "")
    {
        subject.className = 'error';
        return false;
    }
    else if (msg.value == "")
    {
        msg.className = 'error';
        return false;
    }
    else
    {
        $.ajax({
            type: "POST",
            url: "process.php",
            data: $("#contact_form").serialize(),
            success: function (msg)
            {
                //alert(msg);
                if (msg == 'success') {
                    $('#contact_form').fadeOut(1000);
                    $('#contact_message').fadeIn(2000);
                    document.getElementById("contact_message").innerHTML = "Your email has been sent.";
                    return true;
                } else {

                    $('#contact_form').fadeOut(500);
                    $('#contact_message').fadeIn(2000);
                    document.getElementById("contact_message").innerHTML = "Your email has been sent.";
                    return true;
                }
            }
        });
    }
}




/* ------------------------------------------------------------------------ */
/* END JavaScript Code For Video *///
/* ------------------------------------------------------------------------ */
 
 /**
 * @author       Rob W <gwnRob@gmail.com>
 * @website      http://stackoverflow.com/a/7513356/938089
 * @version      20131010
 * @description  Executes function on a framed YouTube video (see website link)
 *               For a full list of possible functions, see:
 *               https://developers.google.com/youtube/js_api_reference
 * @param String frame_id The id of (the div containing) the frame
 * @param String func     Desired function to call, eg. "playVideo"
 *        (Function)      Function to call when the player is ready.
 * @param Array  args     (optional) List of arguments to pass to function func*/
function callPlayer(frame_id, func, args) {
  if (window.jQuery && frame_id instanceof jQuery) frame_id = frame_id.get(0).id;
  var iframe = document.getElementById(frame_id);
  if (iframe && iframe.tagName.toUpperCase() != 'IFRAME') {
      iframe = iframe.getElementsByTagName('iframe')[0];
  }

  // When the player is not ready yet, add the event to a queue
  // Each frame_id is associated with an own queue.
  // Each queue has three possible states:
  //  undefined = uninitialised / array = queue / 0 = ready
  if (!callPlayer.queue) callPlayer.queue = {};
  var queue = callPlayer.queue[frame_id],
      domReady = document.readyState == 'complete';

  if (domReady && !iframe) {
      // DOM is ready and iframe does not exist. Log a message
      window.console && console.log('callPlayer: Frame not found; id=' + frame_id);
      if (queue) clearInterval(queue.poller);
  } else if (func === 'listening') {
      // Sending the "listener" message to the frame, to request status updates
      if (iframe && iframe.contentWindow) {
          func = '{"event":"listening","id":' + JSON.stringify(''+frame_id) + '}';
          iframe.contentWindow.postMessage(func, '*');
      }
  } else if (!domReady ||
             iframe && (!iframe.contentWindow || queue && !queue.ready) ||
             (!queue || !queue.ready) && typeof func === 'function') {
      if (!queue) queue = callPlayer.queue[frame_id] = [];
      queue.push([func, args]);
      if (!('poller' in queue)) {
          // keep polling until the document and frame is ready
          queue.poller = setInterval(function() {
              callPlayer(frame_id, 'listening');
          }, 250);
          // Add a global "message" event listener, to catch status updates:
          messageEvent(1, function runOnceReady(e) {
              if (!iframe) {
                  iframe = document.getElementById(frame_id);
                  if (!iframe) return;
                  if (iframe.tagName.toUpperCase() != 'IFRAME') {
                      iframe = iframe.getElementsByTagName('iframe')[0];
                      if (!iframe) return;
                  }
              }
              if (e.source === iframe.contentWindow) {
                  // Assume that the player is ready if we receive a
                  // message from the iframe
                  clearInterval(queue.poller);
                  queue.ready = true;
                  messageEvent(0, runOnceReady);
                  // .. and release the queue:
                  while (tmp = queue.shift()) {
                      callPlayer(frame_id, tmp[0], tmp[1]);
                  }
              }
          }, false);
      }
  } else if (iframe && iframe.contentWindow) {
      // When a function is supplied, just call it (like "onYouTubePlayerReady")
      if (func.call) return func();
      // Frame exists, send message
      iframe.contentWindow.postMessage(JSON.stringify({
          "event": "command",
          "func": func,
          "args": args || [],
          "id": frame_id
      }), "*");
  }
  /* IE8 does not support addEventListener... */
  function messageEvent(add, listener) {
      var w3 = add ? window.addEventListener : window.removeEventListener;
      w3 ?
          w3('message', listener, !1)
      :
          (add ? window.attachEvent : window.detachEvent)('onmessage', listener);
  }
}