<?php

function mysettings_form($form_state) {

	$form = array();
	$my_settings = variable_get('mysettings');

  // $form['ticker_text'] = array(
  //   '#type' => 'textarea',
  //   '#title' => t('Change the Email Text'),
  //   '#default_value' => $my_settings['ticker_text'],
  // );

  // start of the mark up only i will hide the ticker_text 

	$form['separator_3'] = array(
		'#markup' => '<hr /><br/>'
	);

	$form['test'] = array(
		'#markup' => '
		<base target="_blank"></base>
		<h2>Slider Section</h2>

		<p>Edit Slider <a href="/node/50/edit?destination=admin/content">Click Here</a> </p>
		<p>Add Image on Slider <a href="/node/add/slide-show">Click Here</a> </p>  
		

		<hr/>
		<h2>What We Do Section</h2> 
		<p>Edit What We Do
		<a href="/admin/structure/block/manage/block/13/configure?destination=node/175">Click Here</a></p> 
		<hr/>	



		<h2>Add Events on Whats Happening</h2> 
		<p>Add events please <a href="/node/add/events">Click Here</a></p>  
		<p>Edit events please <a href="/admin/content">Click here</a> and sort by type where "events" </p>
		<hr/>



		<h2>What To Learn Section</h2>

		<p>Add new article please <a href="/node/add/repository-with-description">Click Here</a> </p>

		<p>Edit Articles please <a href="/admin/content">Click here</a> and sort by type where "Newsletter"</p>

		<p>Add new newsletter please <a href="/node/add/newsletter"> Click here </a> </p>

		<p>Edit Youtube Api <a href="/node/146/edit"> Click here </a> </p>


		<hr/>


		<h2> Who we are Section </h2>

		<p>Edit Block of Who We Are Section <a href="/admin/structure/block/manage/block/15/configure?destination=node/175">Click here</a> </p>
		<p>Add Case Studies Slider <a href="/node/add/highlights-homepage">Click here</a></p>
		<p>Edit Case Studies Slider <a href="/admin/content">Click here</a> and sort by type where "highlights_homepage"</p>

		<hr/> 

		<h2>Contact Section</h2>

		<p>Edit Contact please <a href="/admin/structure/block/manage/block/16/configure?destination=node/175">Click here</a></p>
		<p>Edit Map Location<a href="/admin/config/content/locationmap">Click here</a></p>

		<hr/> 

		<h2>Footer Section</h2>
		<p>Edit Footer Section <a href="/admin/structure/block/manage/block/10/configure?destination=node/175">Click here</a></p>

		<hr/>




	 	<h2>How Agencies Can Engage Us</h2>
	 	<p>Edit the page through <a href="/node/213/edit">Click Here</a></p>

	 	<hr/>


	 	<h2>IP Whitelisting</h2>
	 	<p>To Manage the Whitelisting, please <a href="/admin/config/people/restrict_ip">Click Here</a></p>


	 	<hr/>


	 	<h2>To View IP Whitelisting Webform Results</h2>
	 	<p>Please <a href="/node/214/webform-results">Click Here</a></p>

	 	<hr/>



	  <h2>Edit Google Analytics</h2>
	  <p>To Edit Google Analytics and put the Web Property ID Please <a href="/admin/config/system/googleanalytics">Click Here</a> </p>

	  <hr/>



		' 
	);


	// $form['submit'] = array(
	// 	'#type' => 'submit',
	// 	'#value' => t('Submit'),
	// );
	

	return $form;
 	


}


function  mysettings_form_submit($form, &$form_state) {

	$my_settings  = array(
		'ticker_text' => $form_state['values']['ticker_text'],
	);

	variable_set('mysettings', $my_settings);
	drupal_set_message(t('Your configuration has been saved.'));

}




?> 