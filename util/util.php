<?php
	define("DS", DIRECTORY_SEPARATOR);

	include 'string_util.php';
	include 'path_util.php';

	$default_locale = "en_US";
	date_default_timezone_set("America/Los_Angeles");

	function print_header($file) {
		$path = get_relative_root_path($file);
		println('<h1 id="logo-text"><a href="' . $path . '"index.php">Spencer<span>Bartz</span></a></h1>');
		println('<h2 id="slogan">Portfolio Website</h2>');
		println('<div id="header-links">');
		println('<p> <a href="' . $path . 'index.php">Home</a> | <a href="' . $path . 'contact' . DS . 'contactresume.php">Contact / Resume');
		println('</div>');
	}

	function print_page_dec($file) {
		$path = get_relative_root_path($file);
		println('<link rel="stylesheet" href="' . $path . 'css' . DS . 'BluePigment.css" type="text/css" />');
		println('<link rel="shortcut icon" href="' . $path . 'images' . DS . 'favicon.ico" />');
		println('<script type="text/javascript" src="' . $path . 'js' . DS . 'jquery-1.11.2.min.js"></script>');
		println('<script type="text/javascript" src="' . $path . 'js' . DS . 'util.js"></script>');
	}

	//Print the navigation bar at the top of the page with links to all project categories
	//depending on the location of $file - The file that invoked this function
	function print_nav($file) {
		$DS = DIRECTORY_SEPARATOR;
		//Parallel Arrays to hold user names and internal names
		$fileNames = array("index.php", "js" . $DS . "jsindex.php", "php" .  $DS . "phpindex.php", "applications" . $DS . "applicationindex.php", "python" . $DS . "pyindex.php",  "c" . $DS . "cindex.php");
		$dispNames = array("Home", "JavaScript", "PHP", "Java", "Python", "C");

		$path = get_relative_root_path($file);
		$parts = explode($DS, $file);

		$thisFile = $parts[count($parts) - 1];
		println('<ul>');

		for ($i = 0; $i < count($fileNames); $i++) {
			//Just get the file name, not the folder it might be in
			$fileName = explode($DS, $fileNames[$i]);
			$fileName = $fileName[count($fileName) - 1];
			$li = "<li>";

			//We want to highlight the menu item associated with the current page
			if (strcmp($thisFile, $fileName) == 0)
				$li = '<li id="current">';

			println($li . '<a href="' . $path  . $fileNames[$i] . '">');
			println($dispNames[$i]);
			println('</a></li>');
		}

		println('</ul> ');
	}

	//Print a form allowing the user to search pages
	function print_search_box($file) {
		$path = get_relative_root_path($file);
		println('<div id="close-button" onclick="deactivateSearch();">Close [X]</div>');
		println("<h3>" . "Search spencerbartz.com" . "</h3>");
		println('<form id="searchform" action="' . $path . 'search/searchresult.php" class="searchform" method="post">');
		println("<p>");
		println('<input id="searchquery" name="search_query" class="textbox" type="text" onfocus="activateSearch()" onblur=""/>');
		println('<input name="search" class="button" value="Search" type="submit" />');
		println("</p>");
		println("</form>");
	}

	//For building links from folder names that are stored in
	//unix-safe formats (i.e. all lowercase with underscores instead of spaces. "my_project" -> "My Project")
	//Receives: String - Text (a folder name)
	//Returns: String - Final text to be displayed as link
	function format_link($link_text) {
		//replace underscores with spaces
		$link_text = str_replace("_", " ", $link_text);

		//capitalize the first letter of each word
		$pieces = explode(" ", $link_text);

		for ($i = 0; $i < count($pieces); $i++)
			$pieces[$i] = strtoupper($pieces[$i][0]) . substr($pieces[$i], 1);

		return implode(" ", $pieces);
	}

	/**
	 * print_project_links()
	 * DESCRIPTION: Prints out a table with links and information about each project.
	 * TODO: Replace w/ template.
	 */
	function print_project_links() {
		$dir = ".";
		if (is_dir($dir)) {
			// Try to open directory corresponding to current page (jsindex.php, phpindex.php etc.)
			if ($dh = opendir($dir)) {

				// Print header for table that will hold list of projects in directory
				println('<table>');
				println('<tr>');
				println('<th class="first">Last Updated</th>');
				println('<th>Link</th>');
				println('<th>Description</th>');
				println('</tr>');

				$rowSwitch = 0;
				$ignoreDirs = array(".", "..", "server", "assets", "source");

				// Loop through the projects in this directory (which are stored in directories themselves)
				while (($file = readdir($dh)) !== false) {
					$lastUpdated = "7/29/2020"; // Just in case ?

					// Grab hold of dir, which is not our current dir, any of the ignore dirs above, or is a backup
					if (is_dir($file) && !in_array($file, $ignoreDirs) && !ends_with($file, "_bak")) {
						// Search for file named desc.txt in this project's dir
						$lastUpdated = date("m/d/Y", filemtime($file . "/index.php"));
						$desc = fopen($file . "/desc.txt", "r");
						$descText = "";

						// If we find desc.txt file, read contents and display in table
						if ($desc) {
							while (($buffer = fgets($desc, 4096)) !== false) {
								$descText .= $buffer;
							}

							if (!feof($desc)) {
								$descText = "No description available";
							}

							fclose($desc);
						} else {
							$desc = "No description available";
						}

						//Output a row in the table
						if ($rowSwitch % 2 == 0)
							echo '<tr class="row-a">';
						else
							echo '<tr class="row-b">';

						// Change CSS color (TODO: There is a way to do this in bootstrap)
						$rowSwitch++;

						echo '<td class="first">' . $lastUpdated . '</td>';
						echo '<td><a  href ="' . $file . '/index.php"><strong>' .  format_link($file) . '</strong></a></td>';
						echo '<td>' .  $descText . '</td>';
						echo '</tr>';
					}
				}
				echo '</table>';
				closedir($dh);
			}
		}
	}

	function print_footer($file) {
		println('<!-- footer-columns ends -->');
		println('</div>');
		println('<div id="footer-bottom">');
		println('<p>');
		println('| <a href="http://www.spencerbartz.com">' . _('Home') . '</a> |');
		println('</p>');
		println('<p> &copy; ' . date("Y") . ' <strong>' . "Spencer Bartz" . '</strong> | ');
		println('CSS layout by: <a href="http://www.styleshout.com/">styleshout</a> |');
		println('<a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> |');
		println('</p>');
		println('<p>');
		println('XHTML validated by: <br/><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>');
		println('</p>');
	}

	function last_updated($filename) {
		if (file_exists($filename))
			println("Last updated: " . date("F d, Y H:i:s", filemtime($filename)) . " PST");
	}

	function create_thumbnail($imgFile, $tnPath, $thumbWidth = 100) {
		$info = pathinfo($imgFile);

		if (strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg') {
			$img = imagecreatefromjpeg($imgFile);
			$width = imagesx($img);
			$height = imagesy($img);

			// calculate thumbnail size
			$new_width = $thumbWidth;
			$new_height = floor($height * ($thumbWidth / $width));

			// create a new temporary image
			$tmp_img = imagecreatetruecolor($new_width, $new_height);

			// copy and resize old image into new image
			imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

			// save thumbnail into a file
			imagejpeg($tmp_img, $tnPath . basename($imgFile, ".jpg") . "-tn.jpg");
		} else if (strtolower($info['extension']) == 'gif') {
			$img = imagecreatefromgif($imgFile);
			$width = imagesx($img);
			$height = imagesy($img);

			// calculate thumbnail size
			$new_width = $thumbWidth;
			$new_height = floor($height * ($thumbWidth / $width));

			// create a new temporary image
			$tmp_img = imagecreatetruecolor($new_width, $new_height);

			// copy and resize old image into new image
			imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

			// save thumbnail into a file
			imagegif($tmp_img, $tnPath . basename($imgFile, ".gif") . "-tn.gif");
		} else if (strtolower($info['extension']) == 'png') {
			$img = imagecreatefrompng($imgFile);
			$width = imagesx($img);
			$height = imagesy($img);

			// calculate thumbnail size
			$new_width = $thumbWidth;
			$new_height = floor($height * ($thumbWidth / $width));

			// create a new temporary image
			$tmp_img = imagecreatetruecolor($new_width, $new_height);

			// copy and resize old image into new image
			imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

			// save thumbnail into a file
			imagepng($tmp_img, $tnPath . basename($imgFile, ".png") . "-tn.png");
		}
	}

	function delete_directory($dir) {
		if (!file_exists($dir))
			return true;

		if (!is_dir($dir))
			return unlink($dir);

		foreach (scandir($dir) as $item) {
			if ($item == '.' || $item == '..')
				continue;

			if (!delete_directory($dir . DIRECTORY_SEPARATOR . $item))
				return false;
		}

		return rmdir($dir);
	}

	// This has been hacked
	function generate_bot_check() {
		$operands  = array(rand(1, 10), rand(1, 8), rand(1, 10));
		$challenge = $operands[0] . " * " . $operands[1] . " - " . $operands[2] . " = ";
		$result    = $operands[0] * $operands[1] - $operands[2];
		return array($challenge, $result);
	}

	// Debug Functions
	function alert($str) {
		echo '<script type="text/javascript">alert("' . $str . '");</script>';
	}

	function console_log($str) {
		echo 'console.log("' . $str . '");';
	}
?>