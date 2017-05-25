<?php
/**
 * @file
 * template.php
 *
 * The primary PHP file for the Robertson Bootstrap theme.
 */

/**
* Standard Header
*/
 
/**
* Auto-rebuild the theme registry during theme development.
*/
if (theme_get_setting('rebuild_registry') && !defined('MAINTENANCE_MODE')) {
  // Rebuild .info data.
  system_rebuild_theme_data();
  // Rebuild theme registry.
  drupal_theme_rebuild();
}

/**
 * HTML preprocessing
 */
function robertson_bootstrap_preprocess_html(&$vars) {
  global $theme_key, $user;

// Add variables and paths needed for HTML5 and responsive support.
  $vars['base_path'] = base_path();
  $vars['path_to_robertson_bootstrap'] = drupal_get_path('theme', 'robertson_bootstrap');

// Attributes for html element.
  $vars['html_attributes_array'] = array(
    'lang' => $vars['language']->language,
    'dir' => $vars['language']->dir,
  );

// Add to array of helpful body classes
  $vars['classes_array'][] = ($vars['is_admin']) ? 'admin' : 'not-admin';                                     // Page user is admin
  if (isset($vars['node'])) {
    $vars['classes_array'][] = ($vars['node']) ? 'full-node' : '';                                            // Full node
    $vars['classes_array'][] = (($vars['node']->type == 'forum') || (arg(0) == 'forum')) ? 'forum' : '';      // Forum page
  }
  else {
    $vars['classes_array'][] = (arg(0) == 'forum') ? 'forum' : '';                                            // Forum page
  }
  if (module_exists('panels') && function_exists('panels_get_current_page_display')) {                        // Panels page
    $vars['classes_array'][] = (panels_get_current_page_display()) ? 'panels' : '';
  }

// Add unique classes for each page and website section
  if (!$vars['is_front']) {
    $path = drupal_get_path_alias(check_plain($_GET['q']));
    list($section, ) = explode('/', $path, 2);
    $vars['classes_array'][] = ('section-' . $section);
    $vars['classes_array'][] = ('page-' . check_plain($path));
  }

  // Add a unique page id
  $vars['body_id'] = 'pid-' . strtolower(preg_replace('/[^a-zA-Z0-9-]+/', '-', drupal_get_path_alias(check_plain($_GET['q']))));

/**
 * COMMENTING OUT ALL THESE CUSTOM SETTINGS FOR NOW, CAN UN DO THEM IN TIME
 *
// Build array of additional body classes and retrieve custom theme settings
if(theme_get_setting('bgimg')) {
  $vars['classes_array'][] = 'bimg';
}
$bgcol = theme_get_setting('bgcol');
  if ($bgcol == '0'){ 
	  $vars['classes_array'][] = 'bi0';
  }
  if ($bgcol == '1'){ 
	  $vars['classes_array'][] = 'bi1';
  }
  if ($bgcol == '2'){ 
	  $vars['classes_array'][] = 'bi2';
  }
  if ($bgcol == '3'){ 
	  $vars['classes_array'][] = 'bi3';
  }
  if ($bgcol == '4'){ 
	  $vars['classes_array'][] = 'bi4';
  }
  if ($bgcol == '5'){ 
	  $vars['classes_array'][] = 'bi5';
  }
$bgpoz = theme_get_setting('bgpoz');
  if ($bgpoz == '0'){ 
	  $vars['classes_array'][] = 'bgs';
  }
  if ($bgpoz == '1'){ 
	  $vars['classes_array'][] = 'bgf';
  }
$sncol = theme_get_setting('sncol');
  if ($sncol == '0'){ 
	  $vars['classes_array'][] = 'sn0';
  }
  if ($sncol == '1'){ 
	  $vars['classes_array'][] = 'sn1';
  }
  if ($sncol == '2'){ 
	  $vars['classes_array'][] = 'sn2';
  }
  if ($sncol == '3'){ 
	  $vars['classes_array'][] = 'sn3';
  }
  if ($sncol == '4'){ 
	  $vars['classes_array'][] = 'sn4';
  }
  if ($sncol == '5'){ 
	  $vars['classes_array'][] = 'sn5';
  }
$ntcol = theme_get_setting('ntcol');
  if ($ntcol == '0'){ 
	  $vars['classes_array'][] = 'nt0';
  }
  if ($ntcol == '1'){ 
	  $vars['classes_array'][] = 'nt1';
  }
  if ($ntcol == '2'){ 
	  $vars['classes_array'][] = 'nt2';
  }
  if ($ntcol == '3'){ 
	  $vars['classes_array'][] = 'nt3';
  }
  if ($ntcol == '4'){ 
	  $vars['classes_array'][] = 'nt4';
  }
  if ($ntcol == '5'){ 
	  $vars['classes_array'][] = 'nt5';
  }
$fbcol = theme_get_setting('fbcol');
  if ($fbcol == '0'){ 
	  $vars['classes_array'][] = 'fb0';
  }
  if ($fbcol == '1'){ 
	  $vars['classes_array'][] = 'fb1';
  }
  if ($fbcol == '2'){ 
	  $vars['classes_array'][] = 'fb2';
  }
  if ($fbcol == '3'){ 
	  $vars['classes_array'][] = 'fb3';
  }
  if ($fbcol == '4'){ 
	  $vars['classes_array'][] = 'fb4';
  }
  if ($fbcol == '5'){ 
	  $vars['classes_array'][] = 'fb5';
  }
  if ($fbcol == '6'){ 
	  $vars['classes_array'][] = 'fb6';
  }
  if ($fbcol == '7'){ 
	  $vars['classes_array'][] = 'fb7';
  }
  if ($fbcol == '8'){ 
	  $vars['classes_array'][] = 'fb8';
  }
  if ($fbcol == '9'){ 
	  $vars['classes_array'][] = 'fb9';
  }
$mbcol = theme_get_setting('mbcol');
  if ($mbcol == '0'){ 
	  $vars['classes_array'][] = 'mb0';
  }
  if ($mbcol == '1'){ 
	  $vars['classes_array'][] = 'mb1';
  }
  if ($mbcol == '2'){ 
	  $vars['classes_array'][] = 'mb2';
  }
  if ($mbcol == '3'){ 
	  $vars['classes_array'][] = 'mb3';
  }
  if ($mbcol == '4'){ 
	  $vars['classes_array'][] = 'mb4';
  }
  if ($mbcol == '5'){ 
	  $vars['classes_array'][] = 'mb5';
  }
  if ($mbcol == '6'){ 
	  $vars['classes_array'][] = 'mb6';
  }
  if ($mbcol == '7'){ 
	  $vars['classes_array'][] = 'mb7';
  }
  if ($mbcol == '8'){ 
	  $vars['classes_array'][] = 'mb8';
  }
  if ($mbcol == '9'){ 
	  $vars['classes_array'][] = 'mb9';
  }
$lbcol = theme_get_setting('lbcol');
  if ($lbcol == '0'){ 
	  $vars['classes_array'][] = 'lb0';
  }
  if ($lbcol == '1'){ 
	  $vars['classes_array'][] = 'lb1';
  }
  if ($lbcol == '2'){ 
	  $vars['classes_array'][] = 'lb2';
  }
  if ($lbcol == '3'){ 
	  $vars['classes_array'][] = 'lb3';
  }
  if ($lbcol == '4'){ 
	  $vars['classes_array'][] = 'lb4';
  }
  if ($lbcol == '5'){ 
	  $vars['classes_array'][] = 'lb5';
  }
  if ($lbcol == '6'){ 
	  $vars['classes_array'][] = 'lb6';
  }
  if ($lbcol == '7'){ 
	  $vars['classes_array'][] = 'lb7';
  }
  if ($lbcol == '8'){ 
	  $vars['classes_array'][] = 'lb8';
  }
  if ($lbcol == '9'){ 
	  $vars['classes_array'][] = 'lb9';
  }
$mrcol = theme_get_setting('mrcol');
  if ($mrcol == '0'){ 
	  $vars['classes_array'][] = 'mr0';
  }
  if ($mrcol == '1'){ 
	  $vars['classes_array'][] = 'mr1';
  }
  if ($mrcol == '2'){ 
	  $vars['classes_array'][] = 'mr2';
  }
  if ($mrcol == '3'){ 
	  $vars['classes_array'][] = 'mr3';
  }
  if ($mrcol == '4'){ 
	  $vars['classes_array'][] = 'mr4';
  }
  if ($mrcol == '5'){ 
	  $vars['classes_array'][] = 'mr5';
  }
  if ($mrcol == '6'){ 
	  $vars['classes_array'][] = 'mr6';
  }
  if ($mrcol == '7'){ 
	  $vars['classes_array'][] = 'mr7';
  }
  if ($mrcol == '8'){ 
	  $vars['classes_array'][] = 'mr8';
  }
  if ($mrcol == '9'){ 
	  $vars['classes_array'][] = 'mr9';
  }
$trcol = theme_get_setting('trcol');
  if ($trcol == '0'){ 
	  $vars['classes_array'][] = 'tr0';
  }
  if ($trcol == '1'){ 
	  $vars['classes_array'][] = 'tr1';
  }
  if ($trcol == '2'){ 
	  $vars['classes_array'][] = 'tr2';
  }
  if ($trcol == '3'){ 
	  $vars['classes_array'][] = 'tr3';
  }
  if ($trcol == '4'){ 
	  $vars['classes_array'][] = 'tr4';
  }
  if ($trcol == '5'){ 
	  $vars['classes_array'][] = 'tr5';
  }
$btcol = theme_get_setting('btcol');
  if ($btcol == '0'){ 
	  $vars['classes_array'][] = 'bt0';
  }
  if ($btcol == '1'){ 
	  $vars['classes_array'][] = 'bt1';
  }
  if ($btcol == '2'){ 
	  $vars['classes_array'][] = 'bt2';
  }
  if ($btcol == '3'){ 
	  $vars['classes_array'][] = 'bt3';
  }
  if ($btcol == '4'){ 
	  $vars['classes_array'][] = 'bt4';
  }
  if ($btcol == '5'){ 
	  $vars['classes_array'][] = 'bt5';
  }
  if ($btcol == '6'){ 
	  $vars['classes_array'][] = 'bt6';
  }

$navpos = theme_get_setting('navpos');
  if ($navpos == '0'){
    $vars['classes_array'][] = 'ml';
  }
  if ($navpos == '1'){
    $vars['classes_array'][] = 'mc';
  }
  if ($navpos == '2'){
    $vars['classes_array'][] = 'mr';
  }
$fntsize = theme_get_setting('fntsize');
  if ($fntsize == '0'){
	  $vars['classes_array'][] = 'fs0';
  }
  if ($fntsize == '1'){
	  $vars['classes_array'][] = 'fs1';
  }
  if ($fntsize == '2'){
	  $vars['classes_array'][] = 'fs2';
  }

if (theme_get_setting('grid_responsive') == 1 ){
$mob = theme_get_setting('mobile_blocks');
  if ($mob == '1'){
	  $vars['classes_array'][] = 'nb1';
  }
  if ($mob == '2'){
	  $vars['classes_array'][] = 'nb1 nbl';
  }
  if ($mob == '3'){
	  $vars['classes_array'][] = 'nb1 nb2';
  }
  if ($mob == '4'){
	  $vars['classes_array'][] = 'nb1 nb2 nbl';
  }
  if ($mob == '5'){
	  $vars['classes_array'][] = 'nb1 nb2 nbl nbr';
  }
}

if(theme_get_setting('blockicons')) {
    $vars['classes_array'][] = 'bicons';
}
if(theme_get_setting('pageicons')) {
    $vars['classes_array'][] = 'pi';
}
if(theme_get_setting('roundcorners')) {
  $vars['classes_array'][] = 'rnd';
}


// Add language and site ID classes
  $vars['classes_array'][] = ($vars['language']->language) ? 'lg-'. $vars['language']->language : '';        // Page has lang-x
  $siteid = check_plain(theme_get_setting('siteid'));
  $vars['classes_array'][] = $siteid;

  $vars['classes_array'] = array_filter($vars['classes_array']);                // Remove empty elements

  drupal_add_css(drupal_get_path('theme','abc').'/css/style.css', array('group' => CSS_THEME, 'every_page' => TRUE, 'weight' => 3));
  drupal_add_css(drupal_get_path('theme','abc').'/_custom/custom-style.css', array('group' => CSS_THEME, 'every_page' => TRUE, 'weight' => 5));
  drupal_add_css(drupal_get_path('theme','abc').'/css/print.css', array('group' => CSS_THEME, 'media' => 'print', 'every_page' => TRUE, 'weight' => 6));
*/
}
