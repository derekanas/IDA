<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
$site_frontpage = $GLOBALS['base_url'];
$my_settings = variable_get('mysettings');
$ticker = $my_settings['ticker_text'];

?>

<!-- BEGIN HOME SECTION -->

<section class="home section">
  <div id="home-slides">
    <?php

if ($page['header']): ?>
    <?php
	print render($page['header']); ?>
    <?php
endif; ?>
    <nav class="navbar navbar-default stickey-nav" role="navigation">
      <div class="container">
        <div class="container"> 
          <!-- Brand and toggle get grouped for better mobile display -->
          
          <div class="navbar-header">
          <div class="search-new-mobile" style="display:none;"> <span class="fa fa-search"></span>
              <?php print $search_box; ?>
            </div>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-default"> <span class="sr-only"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand" href="<?php
print $base_path; ?>"  title="<?php
print t('Home'); ?>"><img src="<?php
print $logo; ?>" alt="<?php
print t('Home'); ?>"  /></a> </div>
          <!-- last time is this  --> 
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="navbar-default">
            <?php

if (!empty($primary_nav)): ?>
            <?php
	print render($primary_nav); ?>
            <?php
endif; ?>
            <div class="search-new" style="display:block;"> <span class="fa fa-search"></span>
              <?php
print $search_box; ?>
            </div>
          </div>
          <!-- /.navbar-collapse --> 
        </div>
        <!-- /.container-fluid --> 
      </div>
      <!-- start of navigation 2 --> 
      
      <!-- start of page header -->
      <?php

if (!empty($title)): ?>
      <div class="page-header">
        <div class="container page-header-height"> <!-- last time its 145px --> 
          <div style="float:left; width:80%;">
            <h1>
              <?php
	print $title; ?>
            </h1>
          </div>
          <!-- start of tagging -->
          <ul class="nav navbar-nav cl-effect-5 second-navbar tags-desktop" style="margin-left:0px !important;color:#1a1a1a;padding-top:0px;font-weight:bold;width:80%;">
            <?php
	$tags = $node->field_page_tags;
	
	if (is_array($tags["und"])) {
		$relatedTags = '';
		$relatedTags = array();
		foreach($tags["und"] as $tag) {
			
			array_push($relatedTags, $tag["tid"]);
?>
            <a href="/tags/<?php
			echo strtolower(str_replace(" ", "_", $tag["taxonomy_term"]->name)); ?>">
            <li style="margin-right:5px;padding:5px 10px; background-color:#dfa513 !important;color: #1a1a1a;font-size:10px;border-radius: 5px;">
              <?php
			echo $tag["taxonomy_term"]->name; ?>
            </li>
            </a>
            <?php
		}
	}

?>
          </ul>
          
          <!-- /.navbar-collapse -->
          <?php
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $mailText =  $ticker;
?>
          
          <!-- end of tagging -->
          
          <div class="circle-menu"> 
            <!-- <span class="subscribe"><a href="/content/subscription"  data-toggle="tooltip" title="Subscribe"><i> <img src="/sites/default/files/subscribe_icon.png"></i></a></span> --> 
            <span class="text-increase">&nbsp; <a style="" href="javascript:void(0);" data-toggle="tooltip" title="Text Increase" class="changer" id="text_resize_increase"><i><img  src="/sites/default/files/font_large.svg"></i></a></span> <span class="text-decrease">&nbsp; <a style="" href="javascript:void(0);" data-toggle="tooltip" title="Text Decrease" class="changer" id="text_resize_decrease"><i><img  src="/sites/default/files/font_small.svg"></i></a></span> <span class="print-icon">&nbsp; <a style="" href="#" onclick="PrintFunction()" data-toggle="tooltip" title="Print"><img  src="/sites/default/files/print.svg"></a></span> <span class="mail-icon">&nbsp; <a style="" href="mailto:?subject=Here's a useful article!&body=<?php echo $mailText; echo" "; echo $actual_link; ?>" data-toggle="tooltip" title="Mail"><img src="/sites/default/files/sharing.svg"></a></span> </div>
          
          <!-- start of the sub pages -->
          
          <div id="navbar-default" style="padding:0px !important">
            <ul class="nav navbar-nav cl-effect-5 second-navbar" style="padding:0px !Important;margin-left:0px !important">
              <?php

	// First check that the $node variable is not empty (prevents errors on pages that don't have the $node variable e.g. pages created with Views)

	if (!empty($node)):

		// call the field from the node

		$fieldExample = field_get_items('node', $node, 'field_subpages');

		// now check if there is anything in the variable $fieldExample

		if ($fieldExample):

			// $fieldExample will be an array, so to figure out what element from the array you can initially use print_r ($fieldExample);
			// In the case of a single line text field, you can print that array element using the code below (where [0] is the first row of the array)

			print $fieldExample[0]['value'];
		endif;
	endif;
	if (arg(1) == 114) {
		echo "<li><a href='#upcoming'>UPCOMING EVENTS</a></li><li><a href='#past'>PAST EVENTS</a></li>";
	}




?>
            </ul>
          </div>
          
          <!-- start of mobile tags -->
          
          <div class="dropdown tag-mobile" style="float:left;width:100%;display:none;">
            <button class="btn btn-default dropdown-toggle" style="width:100%;background-color:#dfa513;border:none;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span style="float:left;color:#1a1a1a;font-weight:bold;font-size:14px;">Tags</span> <span class="caret" style="float:right;color:#1a1a1a;margin-top:5px;width:10px;height:10px;"></span>
            <div class="clearfix"></div>
            </button>
            <ul class="dropdown-menu" style="background-color:#dfa513;" aria-labelledby="dropdownMenu1">
              <?php
  $tags = $node->field_page_tags;
  if (is_array($tags["und"])) {
    $relatedTags = '';
	$relatedTags = array();
    foreach($tags["und"] as $tag) {
      
      array_push($relatedTags, $tag["tid"]);
?>
              <li> <a href="/tags/<?php
      echo strtolower(str_replace(" ", "_", $tag["taxonomy_term"]->name)); ?>">
                <?php
      echo $tag["taxonomy_term"]->name; ?>
                </a> </li>
              <?php
    }
  }
else {
?>
              <style>
.tag-mobile{
display:none !important;
}
</style>
              <?php } ?>
            </ul>
          </div>
          
          <!-- end of mobile tags --> 
          
          <script>
function PrintFunction() {

		jQuery("body").append("<div id='printablecontent'>"+jQuery('#printable').html()+"</div>");

/*           var divToPrint = document.getElementById('printable');
		   var popupWin = window.open('', '_blank', 'width=300,height=300'); 
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print();window.close();">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
*/
        var disp_setting = "toolbar=yes,location=no,directories=no,menubar=no,";
        disp_setting += "scrollbars=yes,width=700,height=600,left=100,top=25";
        var docprint = window.open("about:blank", "_blank", disp_setting);

        docprint.document.open();

        docprint.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">');
        docprint.document.write('<html xmlns="http://www.w3.org/1999/xhtml"><head><title></title><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />');

        docprint.document.write('</head><body onload="window.print()" style="background-color:white;background:none;"><div class="printPreview"><div id="header_area">');
        docprint.document.write('<div onclick="javascript:window.print();" class="printFriendly"><a href="#">Print this page</a></div>');
        docprint.document.write('</div>');
        if (jQuery('#printablecontent').html() != null) {
            var myArray = [];
            var i = 0;

            jQuery('#printablecontent').find('a').each(function () {
                if (jQuery(this).children().length == 0) {
                    myArray.push(jQuery(this).text());
                    jQuery(this).replaceWith(" " + jQuery(this).text() + " ");
                }
            });
			jQuery('#printablecontent ul.tabs--primary.nav.nav-tabs').remove();
			
            jQuery('#printablecontent').find('img').each(function () {
                if (jQuery(this).children().length == 0) {
                    myArray.push(jQuery(this).remove());
                    jQuery(this).append(" (" + jQuery(this).attr('href') + ")");
                }
            });
			jQuery('#printablecontent').find('li.comment_forbidden').each(function () {
                    myArray.push(jQuery(this).remove());
            });
			jQuery('#printablecontent').find('.field-name-field-feature-on-hompage').each(function () {
                    myArray.push(jQuery(this).remove());
            });
            docprint.document.write(jQuery('#printablecontent').html());
            jQuery('#printablecontent').find('a').each(function () {
                if (jQuery(this).children().length == 0) {
                    jQuery(this).text(myArray[i]);
                    i++;
                }
            });
			
        }
        docprint.document.write('</div></div></body></html>');

        docprint.document.close();
        docprint.focus();

}
</script> 
          
          <!-- end of the subpages -->
<!--           <div class="go-back" style="display:block;height:36px;padding-top:7px;float: left;
    width: 80%; color:#1a1a1a;"> <a href="javascript:history.go(-1)">Back to previous</a> </div> -->
          <?php
	if ($_GET['q'] != 'filedepotview') {
?>
          <!--<div class="go-back" style="display:none;height:36px;padding-top:7px;"> <a href="javascript:history.go(-1)">Back to previous</a> </div> -->
          <?php
	} ?>
        </div>
      </div>
      <!-- end of page-header -->
      
      <?php
endif; ?>
      
      <!-- end of page header --> 
      
      <!-- end of navigation 2 --> 
    </nav>
  </div>
  <!-- end of home slides --> 
  
</section>
<div class="main-container container" id="printable">
  <header role="banner" id="page-header">
    <?php

if (!empty($site_slogan)): ?>
    <p class="lead">
      <?php
	print $site_slogan; ?>
    </p>
    <?php
endif; ?>
  </header>
  <!-- /#page-header -->
  
  <div class="row">
    <?php

if (!empty($page['sidebar_first'])): ?>
    <aside class="col-md-4" role="complementary">
      <?php
	print render($page['sidebar_first']); ?>
    </aside>
    <!-- /#sidebar-first -->
    <?php
endif; ?>
    <section<?php
print $content_column_class; ?><?php
echo "id='small-padding'"; ?>>
      <?php

if (!empty($page['highlighted'])): ?>
      <div class="highlighted jumbotron">
        <?php
	print render($page['highlighted']); ?>
      </div>
      <?php
endif; ?>
      <?php
$contType=node_type_get_name($node);
if (!empty($breadcrumb)):
if (arg(0) == 'search') {
 ?>
      <div class="breadcrumb"><a href="<?php echo $site_frontpage ?>" class="active-trail">Home</a> » Search</div>
      <?php
 }
else if($contType=='Events') {
	?>
    <div class="breadcrumb"><a class="active-trail" href="<?php echo $site_frontpage ?>">Home</a> » <a class="active-trail" href="<?php echo $site_frontpage ?>/content/whats-happening-0">What's Happening</a> » <?php echo drupal_get_title(); ?></div>
    <?php
}else{
	print $breadcrumb;
}

endif; ?>
      <a id="main-content"></a>
      <?php
print render($title_prefix); ?>
      <?php
print render($title_suffix); ?>
      <?php
print $messages; ?>
      <?php

if (!empty($tabs)): ?>
      <?php
	print render($tabs); ?>
      <?php
endif; ?>
      <?php

if (!empty($page['help'])): ?>
      <?php
	print render($page['help']); ?>
      <?php
endif; ?>
      <?php

if (!empty($action_links)): ?>
      <ul class="action-links">
        <?php
	print render($action_links); ?>
      </ul>
      <?php
endif; ?>
      <?php

if (isset($page['content']["system_main"]["nodes"][arg(1) ]["body"]["#object"]->field_event_image["und"][0]["fid"])) { ?>
        <div class="featuredImage" style="margin:20px 0;">
          <?php
	$fid = $page['content']["system_main"]["nodes"][arg(1) ]["body"]["#object"]->field_event_image["und"][0]["fid"];
	$file = file_load($fid);
	$image = image_load($file->uri);
	$content = array(
		'file' => array(
			'#theme' => 'image_style',
			'#style_name' => 'large',
			'#path' => $image->source,
			'#width' => $image->info['width'],
			'#height' => $image->info['height'],
		) ,
	);
	echo drupal_render($content);
?>
        </div>
        <?php
} ?>
      <?php
print render($page['content']); ?>
    </section>
    <?php

if (!empty($page['sidebar_second'])): ?>
    <aside class="col-md-4" role="complementary">
      <?php
	print render($page['sidebar_second']); ?>
    </aside>
    <!-- /#sidebar-second -->
    <?php
endif; ?>
    <?php

if ($_GET['q'] == 'filedepotview' || $_GET['q'] == 'repository-new') {
?>
    <div class="youtubevideos">
      <ul  id="results" >
      </ul>
    </div>
    <script type="text/javascript">
            var channelName = 'IDASingapore';
            var vidWidth = 525;
            var vidHeight = 300;
            var vidResults = 10;
            $(document).ready(function() {
                $.get(
                    "https://www.googleapis.com/youtube/v3/channels", {
                        part: 'contentDetails',
                        forUsername: channelName,
                        key: 'AIzaSyAxdeL5HQUYvS7g9m1_1TEmluHPZvGTsqY'
                    },
                    function(data) {
                        $.each(data.items, function(i, item) {
                            console.log(item);
                            pid = item.contentDetails.relatedPlaylists.uploads;
                            getVids(pid);
                        })
                    }
                );
            
                function getVids(pid) {
                    $.get(
                        "https://www.googleapis.com/youtube/v3/playlistItems", {
                            part: 'snippet',
                            maxResults: vidResults,
                            playlistId: pid,
                            key: 'AIzaSyAxdeL5HQUYvS7g9m1_1TEmluHPZvGTsqY'
                        },
                        function(data) {
                            var output = "";
                            $.each(data.items, function(i, item) {
                                console.log(item);
                                videoTitle = item.snippet.title;
                                videoId = item.snippet.resourceId.videoId;

                                // <iframe height="'+vidHeight+'" width="'+vidWidth+'" src=\"//www.youtube.com/embed/'+videoId+'\"></iframe>
                                // videoTitle

                                output = '<li>' + '<iframe height="' + vidHeight + '" width="' + vidWidth + '" src=\"//www.youtube.com/embed/' + videoId + '\"></iframe>' + '</li>'; //Append to results listStyle Type
                                $("#results").append(output);
            
                            })
                        }
                    );
                }
            });
            </script>
    <?php
}

?>
  </div>
</div>
<?php

if (is_array($relatedTags) && count($relatedTags) > 0) {
	$finalRelatedTags = array();
	
	foreach($relatedTags as $eachTag) {
		$arrayRe = taxonomy_select_nodes($eachTag);
		
		foreach($arrayRe as $eachItem) {
			if (!in_array($eachItem, $finalRelatedTags)) {
				array_push($finalRelatedTags, $eachItem);
			}
		}
	}


	if (count($finalRelatedTags) > 0) {
		$relatedArticles = "<div class='related-container'><hr><p><span style='font-size:18px;font-weight:bold;color:#1a1a1a !important;'>Related Articles</span></p><ul>";
		foreach($finalRelatedTags as $eachnode) {
			$node2 = node_load($eachnode);
			$relatedArticles.= "<li class='related-items'><a href='/node/" . $eachnode . "'>" . $node2->title . "</a></li>";
		}

		$relatedArticles.= "</ul></div>";
		
?>
<script>
    $(document).ready(function(e) {
        $(".node .content > .field:first-child > .field-items").append("<?php
		echo $relatedArticles; ?>");
    });
    </script>
<?php
	}

?>
<?php
} ?>
<footer class="sub-page-footer bg-default">
  <?php
print render($page['footer']); ?>
</footer>
<a class="back-to-top to-top" id="back-to-top" href="#"><i class="fa fa-angle-up"></i></a> 
<script src="/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
<script src="/sites/all/themes/fajar/js/jquery.steps.js" type="text/javascript"></script>
<script type="text/javascript">

$("#example-manipulation").steps({
    headerTag: "h3",
    bodyTag: "section",
    enableAllSteps: true,
    enablePagination: false
});

</script>
<link href="/colorbox/popup/colorbox.css" type="text/css" rel="stylesheet" />
<style>
#navbar-default > .nav.navbar-nav.cl-effect-5.second-navbar li > a:focus{
 	color:#1A1A1A;    
}
#navbar-default > .nav.navbar-nav.cl-effect-5.second-navbar li.active > a {
  color: #e97425 !important;
  transition: all 0.2s ease-in-out 0s;
}
</style>
<script>

    $('.navbar-lower').affix({
  offset: {top: 50}
  });
  var topMenu = $("#navbar-default > .nav.navbar-nav.cl-effect-5.second-navbar"),
    topMenuHeight = topMenu.outerHeight()+150,

    // All list items

    menuItems = topMenu.find("a"),

    // Anchors corresponding to menu items

    scrollItems = menuItems.map(function(){
      var item = $($(this).attr("href"));
      if (item.length) { return item; }
    });


// Bind to scroll

$(window).scroll(function(){

   // Get container scroll position

   var fromTop = $(this).scrollTop()+topMenuHeight+150;


   // Get id of current scroll item

   var cur = scrollItems.map(function(){
     if ($(this).offset().top < fromTop)
       return this;
   });

   // Get the id of the current element

   cur = cur[cur.length-1];
   var id = cur && cur.length ? cur[0].id : "";

   // Set/remove active class

   menuItems
     .parent().removeClass("active")
     .end().filter("[href=#"+id+"]").parent().addClass("active");
});
  $(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	  var tid=target.attr('id');//target.attr('id','anchorid');
		var offset=document.getElementById(tid).offsetTop;
      if (target.length) {
		if(offset==424)
			offset=624;
        $('html,body').animate({
          scrollTop: offset+100//target.offset().top-100
        }, 1000);
		//target.attr('id','');
        return false;
      }
    }
  });
});

</script> 
<script>


$(function(){
    
    $(".field-name-field-related-events-picture .field-items .field-item img").each(function(){
			var imgsrc=$(this).attr('src');
            $(this).wrap("<a href=\""+imgsrc+"\" class=\"colorbox\"></a>");
    });
	
});

$(document).ready(function(e) {
    $(".colorbox").colorbox({rel:'colorbox'});
});
</script> 
<script>

    (function () {
        "use strict";


        // You can also use "$(window).load(function() {"

        jQuery(function () {


            // active class in menu

            jQuery('body').scrollspy({target: '.navbar'});


            // video bg

            jQuery('video, object').maximage('maxcover');


            // Hide show play/pause buttons

            jQuery('#play-btn').click(function (e) {
                jQuery(this).hide();
                jQuery('#pause-btn').show();
            });

            jQuery('#pause-btn').click(function (e) {
                jQuery(this).hide();
                jQuery('#play-btn').show();
            });


        });

    })(jQuery);
</script> 
<script type="text/javascript">


$(document).on('click','.navbar-collapse.in',function(e) {
    if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
        $(this).collapse('hide');
    }
});



</script>
<style>
.field-name-field-page-tags.field-type-taxonomy-term-reference,.page-taxonomy.page-taxonomy-term.page-taxonomy-term- .region.region-header,.field-name-field-feature-on-hompage{display:none;} .page-taxonomy.page-taxonomy-term.page-taxonomy-term- .main-container.container{/*padding-top:100px !important;*/}
.field-name-field-related-events-picture .field-items .field-item {  float: left;margin-bottom: 20px;margin-right: 20px;width: 23%;}
.field-name-field-related-events-picture .field-items .field-item img{max-width:100%;}
#simple-subscription-form .btn.btn-default.form-submit {  border: 0 none;  margin-top: 20px;  outline: 0 none;}
#colorbox{border-radius:16px;}
#colorbox div {  background: rgba(0, 0, 0, 0) none repeat scroll 0 0 !important;}
#colorbox #cboxClose,#colorbox #cboxCurrent{display:none !important;}
#cboxContent > button#cboxNext {  left: auto !important;  right: 0 !important; }

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" type="text/javascript"></script> 
<script src="/sites/all/modules/text_resize/text_resize.js" type="text/javascript"></script>