<?php
/**
 * Pluggable
 * @package pluggable
 * @author Vishnu Gopal
 */

require_once('utils.php');

/**
 * Reads in the plugins/ directory and caches the @hook PHPDoc directive
 * @param options A list of options to configure pluggable
 * @return NULL 
 */
function pluggable_init($options = array()) {
  global $pluggable_cache;
  $pluggable_cache = array();
  
  $current_directory = getcwd();
  
  chdir(non_null_of(array_safe_get($options, "plugin_path"), "plugins"));
  $files = glob("*.php");
  
  foreach($files as $file) {
    $file_contents = file_get_contents($file);
    /* Grep for @hook */
    $matches = array();
    preg_match_all("/@pluggable_hook (.*?) @with (.*)/", $file_contents, $matches);
    print_r($matches);
    foreach($matches[1] as $key => $match) {
      $hook = trim($match);
      $with = trim($matches[2][$key]);
      array_safe_make($pluggable_cache[$hook]);
      array_push(
        $pluggable_cache[$hook], 
        array(
          'file_path' => realpath($file), 
          'function_name' => $with
        )
      );
    }
  }
}

function pluggable_serve($hook) {
  global $pluggable_cache;
}




