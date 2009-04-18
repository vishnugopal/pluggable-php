<?php
/**
 * Utils
 * @package pluggable
 * @author Vishnu Gopal
 */
 
/**
 * Returns the first non null value in passed arguments.
 * @param variable any argument
 * @return value 
 */
function non_null_of() {
  for ($i = 0;$i < func_num_args();$i++) {
    if(func_get_arg($i))
      return func_get_arg($i);
  }
  return false;
}

function array_safe_get($array, $key) {
  if(array_key_exists($key, $array)) {
    return $array[$key];
  } else {
    return NULL;
  }
}

function array_safe_make(&$variable) {
  if(is_array($variable)) {
    return;
  } else {
    $variable = array();
    return;
  }
}
