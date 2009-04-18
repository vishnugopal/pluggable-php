<?php
/**
 * Htmlize
 * @package pluggable
 * @author Vishnu Gopal
 * @pluggable_hook replace_welcome_message @with org_vish_in_htmlize
 */
 
/**
 * Replaces the message that we print with an HTML version.
 * @return string Hello Baby!
 * Notice the reverse FQDN notation, this is recommended to prevent name collisions
 * We use call by reference to pass in (and modify) values to return them
 */
function org_vish_in_htmlize(&$message) {
  $message = "<b>" . $message . "</b>";
}