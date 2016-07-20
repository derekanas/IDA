<?php global $base_url; ?>

<div id="wrapper">
    
    <?php if($page['preload']): ?>
        <?php print render($page['preload']); ?>
    <?php endif; ?>
    <?php if($page['share_sec']): ?>
        <?php print render($page['share_sec']); ?>
    <?php endif; ?>
    <!-- BEGIN HOME SECTION -->
    <section class="home section" id="home" style="height:0px !important;">
        <div id="home-slides">
            <?php if($page['header']): ?>
              <?php print render($page['header']); ?>
            <?php endif; ?>           
            <nav class="navbar navbar-default stickey-nav" role="navigation">
                
            <div class="container">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                <?php
                global $user;
                if (user_is_logged_in()) {
                    ?> <div class="login" style="display:none !important">
                <a href="/user/logout">Log-out</a>
                 </div>

                <?php
                }
                else { ?>
                        <div class="login" style="display:none !important">
                          <a href="/user/">Log-in</a> |
                           <a href="/user/register">Register</a>
                        </div>
                <?php
                }
                ?>

                    <div class="navbar-header">     
                  <div class="search-new-mobile" style="display:none;">
                   <span class="fa fa-search"></span>
                   <?php print $search_box; ?> 
                   </div>
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-default">
                            <span class="sr-only"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand navbar-to-top" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
                        
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-default">
                        <?php if (!empty($primary_nav)): ?>
                            <?php print render($primary_nav); ?>
                        <?php endif; ?>
                    <div class="search-new" style="display:block;">
                    <span class="fa fa-search"></span>
                    <?php print $search_box; ?>
                  </div>

                    </div><!-- /.navbar-collapse -->
                    <!-- <a href="#." id="share-btn" class="rss"><i class="icon icon-search"></i></a> -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>
    </section>
    <!-- END SHARE SECTION -->


    <div class="clearfix"></div>
    <?php //print $messages; ?>
    <?php print render($page['content']); ?>
    <!-- BEGIN FOOTER -->
    <footer class="sub-page-footer bg-default">
        <div class="container">
             <?php if (!empty($page['footer'])): ?>
                <?php print render($page['footer']); ?>
            <?php endif; ?>            
        </div>
    </footer>
    <!-- END FOOTER -->
     <a class="back-to-top to-top" id="back-to-top" href="#"><i class="fa fa-angle-up"></i></a>
</div>




<script>

    (function () {
        "use strict";

        // You can also use "$(window).load(function() {"
        jQuery(function () {

            // active class in menu
            jQuery('body').scrollspy({target: '.navbar'});

            //video bg
            jQuery('video, object').maximage('maxcover');

            //Hide show play/pause buttons
            jQuery('#play-btn').click(function (e) {
                jQuery(this).hide();
                jQuery('#pause-btn').show();
            });

            jQuery('#pause-btn').click(function (e) {
                jQuery(this).hide();
                jQuery('#play-btn').show();
            });

            //RESPONSIVE TABS
            jQuery('#horizontalTab').easyResponsiveTabs({
                type: 'default', //Types: default, vertical, accordion           
                width: 'auto', //auto or any width like 600px
                fit: true, // 100% fit in a container
                closed: 'accordion', // Start closed if in accordion view
            });


    })(jQuery);
});

</script>

<script type="text/javascript">
$(function () {


            $(document).ready(function () {

                $(".accordion-body").on("shown", function (evt) {
                    setIcon(evt.target, true);
                });

                $(".accordion-body").on("hidden", function (evt) {
                    setIcon(evt.target, false);
                });

                $(".accordion-body").collapse("hide");
                $("#collapse-faq-1").collapse("show");


            });

            $('.accordion-toggle').click(function (event) {


                var $this = $(this);

                // It will reset Icons and never misses anyone
                $('.accordion-toggle').not(this).children('i').removeClass('fa-close').addClass('plus-icon');

                if ($this.children('i').hasClass('plus-icon')) {
                    
                    $this.children('i').removeClass('plus-icon').addClass('fa-close');
                    
                } else {
                    
                    $this.children('i').removeClass('fa-close').addClass('plus-icon');
                    
                }
            });
            $(function () {

                var active = true;

                $('#collapse-init').click(function () {
                    if (active) {
                        active = false;
                        $('.panel-collapse').collapse('show');
                        $('.panel-title').attr('data-toggle', '');
                        $(this).text('Enable accordion behavior');
                    } else {
                        active = true;
                        $('.panel-collapse').collapse('hide');
                        $('.panel-title').attr('data-toggle', 'collapse');
                        $(this).text('Disable accordion behavior');
                    }
                });

                $('#accordion').on('show.bs.collapse', function () {
                    if (active) $('#accordion .in').collapse('hide');
                });

            });


        });

</script>



<script type="text/javascript">


$(document).on('click','.navbar-collapse.in',function(e) {
    if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
        $(this).collapse('hide');
    }
});


</script>


<script src="http://idacoedev.wph.com.sg:8181/sites/all/themes/fajar/js/jquery.textarea-expander.js"></script>