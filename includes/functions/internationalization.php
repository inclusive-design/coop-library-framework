<?php
/**
 * Internationalization functionality.
 *
 * @package LearningCommonsFramework
 */

namespace LearningCommonsFramework\Internationalization;

/**
 * Default setup routine
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_filter( 'pll_copy_post_metas', $n( 'copy_post_metas' ) );
}

/**
 * Determine which post meta should be synchronized between translations.
 *
 * @param array $metas The array of metadata keys to synchronize.
 */
function copy_post_metas( $metas ) {
	$unset = [
		// Link will differ for the translated version.
		'lc_resource_permanent_link',
		// Translator will be specific to the translated version.
		'lc_resource_translator',
	];
	foreach ( $metas as $key => $value ) {
		if ( in_array( $value, $unset, true ) ) {
			unset( $metas[ $key ] );
		}
	}
	return $metas;
}

/**
 * Load a list of countries in the current locale.
 *
 * @param string $locale The current locale, for example en_US.
 *
 * @return array $countries An associative array of countries.
 */
function get_country_list( $locale = 'en_US' ) {
	$countries = include_once LEARNING_COMMONS_FRAMEWORK_PATH . 'vendor/umpirsky/country-list/data/' . $locale . '/country.php';
	return $countries;
}

/**
 * Load a list of languages in the current locale.
 *
 * @param string $locale The current locale, for example en_US.
 *
 * @return array $languages An associative array of languages.
 */
function get_language_list( $locale = 'en_US' ) {
	$languages = include_once LEARNING_COMMONS_FRAMEWORK_PATH . 'vendor/umpirsky/language-list/data/' . $locale . '/language.php';
	return $languages;
}
