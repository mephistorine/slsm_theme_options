/**
 * Created by stylesam on 4/26/2017.
 */

jQuery(document).ready(function($){

	if ( slsmThemeObj.slsm_theme_options_body ){
		$('body').css('background-color', slsmThemeObj.slsm_theme_options_body);
	}

	if ( slsmThemeObj.slsm_theme_options_header ){
		$('header').css('background-color', slsmThemeObj.slsm_theme_options_header );
	}

});