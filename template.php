<?php
/**
 * @file
 * template.php
 *
 * The primary PHP file for this theme.
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