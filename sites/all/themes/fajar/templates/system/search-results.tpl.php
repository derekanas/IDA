<?php

/**
 * @file
 * Default theme implementation for displaying search results.
 *
 * This template collects each invocation of theme_search_result(). This and
 * the child template are dependent to one another sharing the markup for
 * definition lists.
 *
 * Note that modules may implement their own search type and theme function
 * completely bypassing this template.
 *
 * Available variables:
 * - $search_results: All results as it is rendered through
 *   search-result.tpl.php
 * - $module: The machine-readable name of the module (tab) being searched, such
 *   as "node" or "user".
 *
 *
 * @see template_preprocess_search_results()
 *
 * @ingroup themeable
 */
?>

<script type="text/javascript">
 $('#search-form').remove(); 
 $('.alert').remove();
</script>
<?php if ($search_results): ?> 
  <div style="width:100%;"> 
  
  <h3 class="results-for" style="padding-bottom:20px;text-transform:none !important;"><?php print t('Results for:'); ?> <span class="result-name" style="color:#d96c2c;text-transform:none !important;"><?php echo arg(2); ?></span></h3>
  <div class="search-sorting" style="position: absolute;right: 15px;top: 104px;">  
  <select id="sortoptions">
  <option value="saab">Relevance</option>
  <option value="volvo" <?php if(isset($_GET['orderby']) && $_GET['orderby']=='volvo'){echo "selected=selected";} ?>>Latest Post</option>
  
  </select>
  </div>
  
  </div>
<?php 
if(isset($_GET['page'])){
	$start=($_GET['page']*10)+1;
}else{
	$start=1;
}
?>
  <ol class="search-results <?php print $module; ?>-results"  start="<?php echo $start; ?>">
    <?php print $search_results; ?>
  </ol>
  <?php print $pager; ?>
<?php else : ?>
  <h2><?php print t('Your search yielded no results');?></h2>
  <?php print search_help('search#noresults', drupal_help_arg()); ?>
<?php endif; ?>
<script>
jQuery.redirect = function(url, params) {

    url = url || window.location.href || '';
    url =  url.match(/\?/) ? url : url + '?';

    for ( var key in params ) {
        var re = RegExp( ';?' + key + '=?[^&;]*', 'g' );
        url = url.replace( re, '');
        url += '&' + key + '=' + params[key]; 
    }  
    // cleanup url 
    url = url.replace(/[;&]$/, '');
    url = url.replace(/\?[;&]/, '?'); 
    url = url.replace(/[;&]{2}/g, '&');
    // $(location).attr('href', url);
    window.location.replace( url ); 
};
$('#sortoptions').change(function(){ 
   $.redirect( location.href, { orderby : $(this).val() })
})
</script>