<?php
require_once('pluggable.php');
pluggable_init();

function hello() {
  pluggable_serve("before_welcome_message");
  $message = pluggable_serve("replace_welcome_message");
  echo non_null_of($message, "Hello World");  
}

hello();