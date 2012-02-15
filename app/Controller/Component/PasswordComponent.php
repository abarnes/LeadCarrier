<?php
class PasswordComponent extends Component {
/**
 * Generate and return a random string
 *
 * The default string returned is 8 alphanumeric characters.
 *
 * The type of string returned can be changed with the "seeds" parameter.
 * Four types are - by default - available: alpha, numeric, alphanum and hexidec. 
 *
 * If the "seeds" parameter does not match one of the above, then the string
 * supplied is used.
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     2.1.0
 * @link        http://aidanlister.com/repos/v/function.str_rand.php
 * @param       int     $length  Length of string to be generated
 * @param       string  $seeds   Seeds string should be generated from
 */
	var $name = 'Password';
	var $components = array('Auth');
	
	function __generateToken() {
		$random = $this->__randomPassword(10).time();
		$token = $this->Auth->password($random);
		return $token;
	}
	
	function __randomPassword($length = 11, $seeds = 'alphanum') {
	    // Possible seeds
	    $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
	    $seedings['numeric'] = '0123456789';
	    $seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
	    $seedings['hexidec'] = '0123456789abcdef';

	    // Choose seed
	    if (isset($seedings[$seeds]))
	    {
	        $seeds = $seedings[$seeds];
	    }

	    // Seed generator
	    list($usec, $sec) = explode(' ', microtime());
	    $seed = (float) $sec + ((float) $usec * 100000);
	    mt_srand($seed);

	    // Generate
	    $str = '';
	    $seeds_count = strlen($seeds);

	    for ($i = 0; $length > $i; $i++)
	    {
	        $str .= $seeds{mt_rand(0, $seeds_count - 1)};
	    }

	    return $str;
	}
}
?>