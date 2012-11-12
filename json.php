<?php

if(isset($_GET["user"])) { 
	$user = $_GET["user"];
	} else {
	$user = "";
	}

if(isset($_GET["end"])) { 
	$end = $_GET["end"];
	} else {
	$end = 50;
	}

if(isset($_GET["start"])) { 
	$start = $_GET["start"];
	} else {
	$start = 1;
	}

if(isset($_GET["page"])) { 
	$page = $_GET["page"];
//	$start = $page * ($start + $end);
//	$end = ($start + $end);
	
	} else {
	$page = 1;
	}

$files2 = array();
$dir    = "/data/uploads/$user";

// Check if this is an images folder
if ( file_exists("$dir/cronlist.txt") ) {
	// it is, so let's get all the images
	$file_handle = fopen("$dir/cronlist.txt", "r");
	while (!feof($file_handle)) {
	   $line = fgets($file_handle);
	   if ( $line != "" ) {
	   	array_push($files2,$line);
	   }
	}
	fclose($file_handle);
	// let's get this for reference. 
	$maxnum = count($files2);
	// OK, if it's images, they may page through them. Let's offset for page number
	if ( $page > 1 ) {
		$start = $start + ($end * ($page-1));
	}
	// To satisfy the next error.
	// make sure we're not at then end yet.
	$alldone = 0;
	if ( $start > $maxnum ) {
		//	$start = $maxnum - 20;
		//	$start = 1;
		$alldone = 1;
	}
	// And let's reset to a sane beginning if bad data comes in.
	if ( $start < 1 ) {
		$start = 1;
	}
	// OK, if they asked for more than we have, only give them what we have.
	if ( $start + $end > $maxnum ) {
		$end = $maxnum - $start;
	}
	// don't write anything if this is the end
	if( $alldone != 1 ) {   // not all done
		// get us into the right area
		$files3 = array_slice($files2,$start,$end);
		// write it all out
		echo "{\"images\": [";
		$firstone=false;
		foreach($files3 as $pic) {
			if ( $firstone == true ) { echo ", "; }
			$pic = rtrim($pic, "\r\t\n");
			echo "{ \"name\": \"$pic\", \"url\": \"/uploads/$user/$pic\", \"thumb\": \"/uploads_t/$user/$pic\", \"title\": \"$pic\" }";
			$firstone = true;
		}
		echo "] }";
	} // all done
} // end of if file exists
else { // else is a dir of users or cameras
	if (is_dir($dir) && ($page == 1)) {
		if ($dh = opendir($dir)) {
					echo "{ \"users\": [ ";
			$firstone=false;
        		while ((($file = readdir($dh)) !== false )) {
				if ( ($file != '.') && ($file != '..') ) {
					if ( $firstone == true ) { echo ", "; }
					if ( $user == "" ) {	
						echo "{ \"user\": \"$file\", \"url\": \"$file\", \"thumb\": \"/uploads_t/$file/profile.jpg\" }";
					} else { 
						echo "{ \"user\": \"$file\", \"url\": \"$user/$file\", \"thumb\": \"/uploads_t/$user/$file/profile.jpg\" }";
					}
					$firstone = true;
				}
        		}
        	closedir($dh);
					echo " ] } ";
    		}
	$isdir=1;
	$start=0;
	} else {
	echo "The image list is broken. Please try again later.";
	}
}

?>
