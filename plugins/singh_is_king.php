<?php
/**
 * Singh is King
 * @package pluggable
 * @author Vishnu Gopal
 * @pluggable_hook before_welcome_message @with in_vish_singh_is_king
 */

/**
 * Just prints a preface to the Hello World message
 * @return string Singh is King
 * Notice the plugin three_two_one is also using the same hook.
 * Plugins are called in unspecified order.
 */
function in_vish_singh_is_king() {
  echo "Singh is King!\n";
}

