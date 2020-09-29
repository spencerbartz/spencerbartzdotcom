<?php
	/********************* STRING HELPER FUNCTIONS *********************/
	
	/**
	 * starts_with()
	 * DESCRIPTION: Determine if the String "haystack" begins with the String "needle"
	 * Surprisingly this still isn't even included as of PHP 7.3
	 */
	function starts_with($haystack, $needle) {
		return $needle === "" || strpos($haystack, $needle) === 0;
	}

	/**
	 * ends_with()
	 * DESCRIPTION: Determine if the String "haystack" ends with the String "needle"
	 * Surprisingly this still isn't even included as of PHP 7.3
	 */
	function ends_with($haystack, $needle) {
		return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
	}

	/**
	 * println()
	 * DESCRIPTION: Prints line of text to console. Set 2nd argument to true if printing in HTML.
	 */
	function println($text, $webmode = FALSE) {
		$text .= $webmode ? "<br/>" : PHP_EOL;
		echo $text;
	}
?>