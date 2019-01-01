<?php

# Adding a Gravity Form form submission page
# Author: Hans Swolfs
# Website: https://hansswolfs.be
# Version: 1.0
# Let's rock & roll

# add the filter to create the review page.
# the default filter is gform_review_page. 
# You can specify the form you want to apply this filter for by adding the ID of the form in the end; e.g. gform_review_page_2
# Mostly you want to do this or else you'll get a review page for every form on the site.
# The code used in this tutorial is the actual code used on the link provided in the blog post on https://hansswolfs.be/hoe-maak-je-een-samenvattingspagina-in-gravity-forms

add_filter( 'gform_review_page_2', 'hs_add_review_page', 10, 5 );

# A filter is followed by the function that needs to be executed

function hs_add_review_page( $review_page, $form, $entry ) {
	 
	# Enable the review page
	$review_page['is_enabled'] = true;
	
  # First thing to do is put the form's fields in variables for easier handling afterwards
  # So far I haven't found a loop to handle this but my PHP skills don't go that far
  # Tip also is to give the variables a clear name. I chose for this set up:
  # f = field, cp/d1/d2 the different sections on the form and then the field identifier
  # the :1.3, :3, ... are the field shortcodes. You can get them by entering the needed fields on a GF form's confirmation page.
	
	# On the first page of the form, general data is collected about the person filling in the application.
	# Depending on how many persons they choose, the next page is formed and there the application's names and other details are filled in.
  
	$f_cp_voornaam = GFCommon::replace_variables( '{:1.3}', $form, $entry );
	$f_cp_achternaam = GFCommon::replace_variables( '{:1.6}', $form, $entry );
	$f_cp_email = GFCommon::replace_variables( '{:3}', $form, $entry );
	$f_cp_telefoon = GFCommon::replace_variables( '{:4}', $form, $entry );
	$f_cp_adres = GFCommon::replace_variables( '{:5}', $form, $entry );
	$f_cp_postcode = GFCommon::replace_variables( '{:45}', $form, $entry );
	$f_cp_plaats = GFCommon::replace_variables( '{:46}', $form, $entry );
	$f_cp_sportkamp = GFCommon::replace_variables( '{:47}', $form, $entry );
	$f_cp_picknick = GFCommon::replace_variables( '{:49}', $form, $entry );
	$f_cp_aantalpersonen = GFCommon::replace_variables( '{:16}', $form, $entry );
	$f_cp_pppersoon = GFCommon::replace_variables( '{:50}', $form, $entry );
	$f_cp_totaal = GFCommon::replace_variables( '{:52}', $form, $entry );

	$f_d1_voornaam = GFCommon::replace_variables( '{:18.3}', $form, $entry );
	$f_d1_achternaam = GFCommon::replace_variables( '{:18.6}', $form, $entry );
	$f_d1_geslacht = GFCommon::replace_variables( '{:21}', $form, $entry );
	$f_d1_geboortedatum = GFCommon::replace_variables( '{:22}', $form, $entry );

	$f_d2_voornaam = GFCommon::replace_variables( '{:20.3}', $form, $entry );
	$f_d2_achternaam = GFCommon::replace_variables( '{:20.6}', $form, $entry );
	$f_d2_geslacht = GFCommon::replace_variables( '{:23}', $form, $entry );
	$f_d2_geboortedatum = GFCommon::replace_variables( '{:24}', $form, $entry );

	$f_d3_voornaam = GFCommon::replace_variables( '{:26.3}', $form, $entry );
	$f_d3_achternaam = GFCommon::replace_variables( '{:26.6}', $form, $entry );
	$f_d3_geslacht = GFCommon::replace_variables( '{:27}', $form, $entry );
	$f_d3_geboortedatum = GFCommon::replace_variables( '{:28}', $form, $entry );

	$f_d4_voornaam = GFCommon::replace_variables( '{:30.3}', $form, $entry );
	$f_d4_achternaam = GFCommon::replace_variables( '{:30.6}', $form, $entry );
	$f_d4_geslacht = GFCommon::replace_variables( '{:31}', $form, $entry );
	$f_d4_geboortedatum = GFCommon::replace_variables( '{:32}', $form, $entry );

	$f_d5_voornaam = GFCommon::replace_variables( '{:37.3}', $form, $entry );
	$f_d5_achternaam = GFCommon::replace_variables( '{:37.6}', $form, $entry );
	$f_d5_geslacht = GFCommon::replace_variables( '{:38}', $form, $entry );
	$f_d5_geboortedatum = GFCommon::replace_variables( '{:39}', $form, $entry );

	$f_d6_voornaam = GFCommon::replace_variables( '{:41.3}', $form, $entry );
	$f_d6_achternaam = GFCommon::replace_variables( '{:41.6}', $form, $entry );
	$f_d6_geslacht = GFCommon::replace_variables( '{:42}', $form, $entry );
	$f_d6_geboortedatum = GFCommon::replace_variables( '{:44}', $form, $entry );
	
	# After you collected all the fields in variables, it's time to create the output of the page with all necessary divs and css-classes.
	# In the end, they need to be merged into 1 variable that's outputted by the function.
	# As you can see, you can use all kinds of PHP functions (like the strpos function) to make sure all the necessary data is displayed.

	$o_cp = '<div class="o-cp o-block"><h2>Contactpersoon</h2><p><span class="o-titel">Naam: </span>' . $f_cp_voornaam . ' ' . $f_cp_achternaam .
	'<br /><span class="o-titel">Email: </span>' . $f_cp_email .
	'<br /><span class="o-titel">Telefoon: </span>' . $f_cp_telefoon .
	'<br /><span class="o-titel">Adres: </span>' . $f_cp_adres .
	'<br /><span class="o-titel">Plaats: </span>' . $f_cp_postcode . ' ' . $f_cp_plaats .
	'<br /><span class="o-titel">Sportkamp: </span>' . $f_cp_sportkamp;
	if (strpos( $f_cp_sportkamp, 'Adventure') !== false ) {
		$o_cp = $o_cp .'<br /><span class="o-titel">Picknick: </span>' . $f_cp_picknick;
	}
	$o_cp = $o_cp .'<br /><span class="o-titel">Aantal personen: </span>' . $f_cp_aantalpersonen .
	'<br /><span class="o-titel">Prijs per persoon: </span>' . $f_cp_pppersoon .
	'<br /><span class="o-titel">Totaal te betalen: </span>' . $f_cp_totaal . '</p>' .
	'<p><input type=\'button\' id=\'gform_previous_button_2_53\' class=\'gform_previous_button button\' value=\'Contactpersoon aanpassen\'  onclick=\'jQuery("#gform_target_page_number_2").val("1");  jQuery("#gform_2").trigger("submit",[true]); \' onkeypress=\'if( event.keyCode == 13 ){ jQuery("#gform_target_page_number_2").val("1");  jQuery("#gform_2").trigger("submit",[true]); } \' />' .
	
	'</div>';

	$o_deelnemers = '<div class="o-cp o-block"><h2>Deelnemers</h2>' . 
	'<p><span class="o-titel">Naam: </span>' . $f_d1_voornaam . ' ' . $f_d1_achternaam .
	'<br /><span class="o-titel">Geslacht: </span>' . $f_d1_geslacht .
	'<br /><span class="o-titel">Geboortedatum: </span>' . $f_d1_geboortedatum . '</p>';

	if ($f_cp_aantalpersonen > 1) {
		$o_deelnemers = $o_deelnemers .  
		'<p><span class="o-titel">Naam: </span>' . $f_d2_voornaam . ' ' . $f_d2_achternaam .
		'<br /><span class="o-titel">Geslacht: </span>' . $f_d2_geslacht .
		'<br /><span class="o-titel">Geboortedatum: </span>' . $f_d2_geboortedatum . '</p>';	} 
	if ($f_cp_aantalpersonen > 2) {
		$o_deelnemers = $o_deelnemers .  
		'<p><span class="o-titel">Naam: </span>' . $f_d3_voornaam . ' ' . $f_d3_achternaam .
		'<br /><span class="o-titel">Geslacht: </span>' . $f_d3_geslacht .
		'<br /><span class="o-titel">Geboortedatum: </span>' . $f_d3_geboortedatum . '</p>'; }
	if ($f_cp_aantalpersonen > 3) {
		$o_deelnemers = $o_deelnemers .  
		'<p><span class="o-titel">Naam: </span>' . $f_d3_voornaam . ' ' . $f_d3_achternaam .
		'<br /><span class="o-titel">Geslacht: </span>' . $f_d3_geslacht .
		'<br /><span class="o-titel">Geboortedatum: </span>' . $f_d3_geboortedatum . '</p>'; }
	if ($f_cp_aantalpersonen > 4) {
		$o_deelnemers = $o_deelnemers .  
		'<p><span class="o-titel">Naam: </span>' . $f_d4_voornaam . ' ' . $f_d4_achternaam .
		'<br /><span class="o-titel">Geslacht: </span>' . $f_d4_geslacht .
		'<br /><span class="o-titel">Geboortedatum: </span>' . $f_d4_geboortedatum . '</p>'; }
	if ($f_cp_aantalpersonen > 5) {
		$o_deelnemers = $o_deelnemers .  
		'<p><span class="o-titel">Naam: </span>' . $f_d5_voornaam . ' ' . $f_d5_achternaam .
		'<br /><span class="o-titel">Geslacht: </span>' . $f_d5_geslacht .
		'<br /><span class="o-titel">Geboortedatum: </span>' . $f_d5_geboortedatum . '</p>'; }
	if ($f_cp_aantalpersonen >= 6) {
		$o_deelnemers = $o_deelnemers .  
		'<p><span class="o-titel">Naam: </span>' . $f_d6_voornaam . ' ' . $f_d6_achternaam .
		'<br /><span class="o-titel">Geslacht: </span>' . $f_d6_geslacht .
		'<br /><span class="o-titel">Geboortedatum: </span>' . $f_d6_geboortedatum . '</p>'; }
	
	$o_deelnemers = $o_deelnemers . '<p><input type=\'button\' id=\'gform_previous_button_2_53\' class=\'gform_previous_button button\' value=\'Deelnemers aanpassen\'  onclick=\'jQuery("#gform_target_page_number_2").val("2");  jQuery("#gform_2").trigger("submit",[true]); \' onkeypress=\'if( event.keyCode == 13 ){ jQuery("#gform_target_page_number_2").val("2");  jQuery("#gform_2").trigger("submit",[true]); } \' />' . '</div>';
	
	# The above code that defines the input button, is retrieved from the form itself and makes a shortcut button to one of the relevant pages on the form.
	
	# Eventually you need to populate the review page. Combine all the variables you filled earlier into 1 single variable that's returned.
	$review_page['content'] = $o_cp . $o_deelnemers;
 
	return $review_page;
	}
