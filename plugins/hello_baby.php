<?php
/**
 * Hello Baby
 * @package pluggable
 * @author Vishnu Gopal
 * @pluggable_hook replace_welcome_message @with org_vish_in_hello_baby
 */
 

/**
 * Replaces the message that we print
 * @return string Hello Baby!
 * Notice the reverse FQDN notation, this is recommended to prevent name collisions
 */
function org_vish_in_hello_baby(&$message) {
  $message = "Hello Baby!";
}