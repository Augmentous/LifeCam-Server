<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Jacob Life</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="viewport" content="width=device-width,initial-scale=1">

	<!-- This code totally ripped from http://breefield.com/bm-timelapse/sunsets ; It was all open source though.. I think .. so yeah. Thanks. We really appreciate the guide -->
    <!-- CSS concatenated and minified via ant build script-->
    <link rel="stylesheet" href="/css/style.css">
    <!-- end CSS-->

    <script src="/js/modernizr-2.0.6.min.js"></script>
    <script>
    //    var root = '/bm-timelapse/';
    </script>
</head>
<body>
<!-- <div id="header">
    <div class="content">
        <div id="time-output"></div>
    </div>
</div> -->
<div id="container"><ul id="photos" class="clearfix">

<?php

if(isset($_GET["end"])) { 
	$end = $_GET["end"];
	} else {
	$end = 20;
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



$dir    = '/home/jacob/eyefi1';
$files1 = scandir($dir,1);
// print_r($files1);
$files2 = scandir($dir . "/" . $files1[0],1);
// print_r($files2);
$maxnum = count($files2) - 2;
if ( $page > 1 ) {
//	$start = (($start + $end)*($page-1))-1;
	$start = $start + ($end * ($page-1));
}
if ( $start > $maxnum ) {
//	$start = $maxnum - 20;
//	$start = 1;
	$alldone = 1;
}
if ( $start < 1 ) {
	$start = 1;
}
if ( $start + $end > $maxnum ) {
	$end = $maxnum - $start;
}
if( $alldone != 1 ) {   // not all done
$files3 = array_slice($files2,$start,$end);
// print_r($files3);
if ( !is_dir($dir . "/" . $files1[0] . "/thumbs")) {
	mkdir($dir . "/" . $files1[0] . "/thumbs");
	echo "dir didnt exist, making it";
}

// print_r($files2);
foreach($files3 as $pic) {
	$picparts = explode(".", $pic);
//	echo $pic;
//	print_r($picparts);
	if ( !file_exists($dir . "/" . $files1[0] . "/thumbs/" . $picparts[0] . "_t.jpg")) {
		make_thumb($dir . "/" . $files1[0] . "/" . $pic, $dir . "/" . $files1[0] . "/thumbs/" . $picparts[0] . "_t.jpg", 300);
//		echo "thumb didnt exist. making it.";
	}
?>

	<li class="">
            <a id="<?php echo $pic; ?>" class="open" rel="timelapse" href="<?php echo "http://jjrosent.zrg.cc/eyefi1/$files1[0]/$pic"; ?>" title="<?php echo $pic; ?>">
                <div class="info">
                    <?php echo $pic; ?>                </div>
                <img src="<?php echo "http://jjrosent.zrg.cc/eyefi1/$files1[0]/thumbs/$picparts[0]_t.jpg"; ?>" class="thumb"/>
                <img src="/images/fill.gif" class="fill"/>
            </a>
        </li>


<?php
	// echo "<a href=\"http://jjrosent.zrg.cc/eyefi1/$files1[0]/$pic\"><img src=\"http://jjrosent.zrg.cc/eyefi1/$files1[0]/thumbs/$picparts[0]_t.jpg\"></a>";
}
} // all done
?>

        </ul>

    <a href="/view.php?start=<?php echo $start;?>&end=<?php echo $end; ?>&page=2" class="next-page">Next</a>
    </div><!-- end container -->    <script src="/js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/js/jquery-1.6.2.min.js"><\/script>')</script>

    <!-- Add fancyBox -->
    <script type="text/javascript" src="/js/jquery.easing-1.3.pack.js"></script>
    <link rel="stylesheet" href="/css/jquery.fancybox.css" type="text/css" media="screen" />
    <script type="text/javascript" src="/js/jquery.fancybox.pack.js"></script>

    <!-- Infinite scroll -->
    <script type="text/javascript" src="/js/jquery.infinitescroll.min.js"></script>

    <!-- scripts concatenated and minified via ant build script-->
    <script defer src="/js/plugins.js"></script>
    <script defer src="/js/script.js"></script>
    <!-- end scripts-->


    <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
    <![endif]-->
  
<BR><BR><BR><BR>









<?php

// <a href="/bm-timelapse/sunsets:page=1" class="next-page">Next</a>

function make_thumb($src, $dest, $desired_width) {

  /* read the source image */
  $source_image = imagecreatefromjpeg($src);
  $width = imagesx($source_image);
  $height = imagesy($source_image);
  
  /* find the "desired height" of this thumbnail, relative to the desired width  */
  $desired_height = floor($height * ($desired_width / $width));
  
  /* create a new, "virtual" image */
  $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
  
  /* copy source image at a resized size */
  imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
  
  /* create the physical thumbnail image to its destination */
  imagejpeg($virtual_image, $dest);
}

/*
if ($handle = opendir('/home/jacob/eyefi1')) {
    echo "Directory handle: $handle\n";
    echo "Entries:\n";

    /* This is the correct way to loop over the directory. 
    while (false !== ($entry = readdir($handle))) {
        echo "$entry\n";
    }

    /* This is the WRONG way to loop over the directory. 
    while ($entry = readdir($handle)) {
        echo "$entry\n";
    }

    closedir($handle);
}
*/

?>
</body></html>
