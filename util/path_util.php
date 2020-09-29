<?php
	// Find out the app root path from any file path
	function get_relative_root_path($file_path) {
		$path_parts    = explode(DS, dirname($file_path));
		
		// Remove 1st element (Usually the Drive name, like C:\)
		array_shift($path_parts);

		$config_file   = dirname(__FILE__) . DS . "config_dev.json";
		$json_obj      = json_decode(file_get_contents($config_file), true);
		$root_dir      = $json_obj["app_info"]["root_dir"];
		$relative_path = "";

		// Need to search for root from end of path, not beginning.
		$path_parts = array_reverse($path_parts);
		
		foreach($path_parts as $part) {
			if(!strcmp($part, $root_dir)) {
				break;
			} else {	
				$relative_path = ".." . DS . $relative_path;
			}
		}

		return $relative_path;
	}
?>