<?php
/**
 * @file
 * template-settings.php
 *
 * The Theme Settings file for this theme, exposes settings values to admin gui
 */

/**
* Standard Header
*/

/**
* Implements hook_form_FORM_ID_alter().
*/
function robertson_bootstrap_form_system_theme_settings_alter(&$form, $form_state, $form_id = NULL) {
  
  // Add our own vertical tab to base bootstrap settings
  $form['robertson_customizations'] = array(
    '#type' => 'fieldset',
    '#title' => t('Robertson Specific Customizations'),
    '#group' => 'bootstrap',
  );  
  $form['robertson_customizations']['themedev'] = array(
    '#type' => 'fieldset',
    '#title' => t('Theme development settings'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  // Development Mode Settings (see settings[rebuild_registry] in .info)
  $form['robertson_customizations']['themedev']['rebuild_registry'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Rebuild theme registry on every page.'),
    '#default_value' => theme_get_setting('rebuild_registry'),
    '#description'   => t('During theme development, it can be very useful to continuously <a href="https://drupal.org/node/173880#theme-registry">rebuild the theme registry</a>. <br /> <div class="alert alert-warning messages warning"><b>WARNING</b>: this is a huge performance penalty and must be turned off on production websites.</div>'),
  );
/**  $form['robertson']['themedev']['siteid'] = array(
    '#type' => 'textfield',
    '#title' => t('Site ID body class.'),
   	'#description' => t('In order to have different styles of Robertson Bootstrap theme in a multisite/multi-theme environment you may find usefull to choose an "ID" and customize the look of each site/theme in custom-style.css file.'),
    '#default_value' => theme_get_setting('siteid'),
    '#size' => 10,
	);
*/
}