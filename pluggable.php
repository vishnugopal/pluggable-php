<?php
/**
 * Pluggable
 * @package pluggable
 * @author Vishnu Gopal
 */

require_once('utils.php');

class PluggableException extends Exception { }


/**
 * Reads in the plugins/ directory and caches the @hook PHPDoc directive
 * @param options A list of options to configure pluggable
 * @return NULL 
 * @global pluggable_cache A global cache of pluggable hooks
 */
function pluggable_init($options = array()) {
  global $pluggable_cache;
  $pluggable_cache = array();
  
  /* Cache the options so we can reload later */
  $pluggable_cache['_options'] = $options;
  
  $current_directory = getcwd();
  $plugins_path = pluggable_plugin_path($options);
  chdir($plugins_path);
  $files = glob("*.php");
    
  foreach($files as $file) {
    $file_contents = file_get_contents($file);
    
    /* Grep for @hook */
    $matches = array();
    preg_match_all("/@pluggable_hook (.*?) @with (.*)/", $file_contents, $matches);

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
  
  chdir($current_directory);
}

/**
 * Reloads the pluggable cache from cached options
 * @return NULL 
 */
function pluggable_reload() {
  $options = $pluggable_cache['_options'];
  pluggable_init($options);
}

/**
 * Serves (loads and calls) a hook from registered plugins
 * @param hook the hook to call
 * @param hook_argument An argument to pass to the hook
 * @param options A list of options to configure serve
 * @return NULL 
 * @global pluggable_cache A global cache of pluggable hooks
 * To return a value, just pass in a hook argument by reference
 * Note, hook arguments can be an array - this is how we send and return multiple values 
 */
function pluggable_serve($hook, &$hook_argument = NULL, $options = array()) {
  global $pluggable_cache;

  if(array_key_exists($hook, $pluggable_cache)) {
    $entries = $pluggable_cache[$hook];
    foreach($entries as $entry) {
      $file_path = $entry['file_path'];
      $function_name = $entry['function_name'];
      require_once($file_path);
      eval($function_name . '($hook_argument);');
    }
  } else {
    if(array_safe_get($options, "throw_exception")) {
      throw new PluggableException("Cannot serve this hook, there are no handlers attached!");
    } else {
      return NULL;
    }
  }
  
}



/**
 * Returns the plugins path
 * @param options A list of options to configure serve
 * @return string The plugin path (usually "plugins") 
 */
function pluggable_plugin_path($options) {
  return non_null_of(array_safe_get($options, "plugins_path"), "plugins");
}


