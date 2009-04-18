<?php
/**
 * Three Two One
 * @package pluggable
 * @author Vishnu Gopal
 * @pluggable_hook before_welcome_message @with in_vish_three_two_one
 */

/**
 * Just prints a preface to the Hello World message
 * @return string Three... Two... One... 
 */
function in_vish_three_two_one() {
  echo "Three... Two... One...\n";
}

