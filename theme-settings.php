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

  // Work-around for a core bug affecting admin themes.
  // @see https://drupal.org/node/943212
  if (isset($form_id)) {
    return;
  }

  // Create vertical tabs for all Robertson Bootstrap related settings.
  $form['robertson_bootstrap'] = array(
    '#type'     => 'vertical_tabs',
    '#attached' => array(
      'js'      => array(drupal_get_path('theme', 'bootstrap') . '/js/bootstrap.admin.js'),
    ),
    '#prefix'   => '<h2><small>' . t('Robertson Bootstrap Settings') . '</small></h2>',
    '#weight'   => -20,
  );

  // Add our own vertical tab to base bootstrap settings
  $form['themedev'] = array(
    '#type'  => 'fieldset',
    '#title' => t('Development'),
    '#group' => 'robertson_bootstrap',
  );

  $form['themedev']['themedev_1'] = array(
    '#type'        => 'fieldset',
    '#title'       => t('Theme Registry Development'),
    '#collapsible' => TRUE,
    '#collapsed'   => TRUE,
  );
   // Development Mode Settings (see settings[rebuild_registry] in .info)
  $form['themedev']['themedev_1']['rebuild_registry'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Rebuild theme registry on every page.'),
    '#default_value' => theme_get_setting('rebuild_registry'),
    '#description'   => t('During theme development, it can be very useful to continuously <a href="https://drupal.org/node/173880#theme-registry">rebuild the theme registry</a>. <br /> <div class="alert alert-warning messages warning"><b>WARNING</b>: this is a huge performance penalty and must be turned off on production websites.</div>'),
  );
  
  $form['themedev']['body_id_0'] = array(
    '#type'        => 'fieldset',
    '#title'       => t('Unique Body ID'),
    '#collapsible' => TRUE,
    '#collapsed'   => TRUE,
  );
  $form['themedev']['body_id_0']['body_id'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Unique Body ID'),
    '#default_value' => theme_get_setting('body_id'),
    '#description'   => t('For multi-site/multi-tenent configuration. Set a unique body id class value.'),
  );
}
