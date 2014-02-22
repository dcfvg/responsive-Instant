<?php
$images = glob("assets/*.jpg");
$step   = 1;
foreach ($images as $id => $image) {
    $css .= "@media (min-width: ".(350+($id*$step))."px) {body{background-image: url('$image');}}";
    $preload .= '<img src="'.$image.'">';
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>wait loading & resize window</title>
    <meta charset="utf-8">
    <style type="text/css">
      body {
        height:100%;
        background:  url(<?php echo $images[0];?>) no-repeat black;
        background-size:cover;
      }
      <?php echo $css ?>
      div#preloader {
    		position: absolute;
    		left: -9999px;
    		top:  -9999px;
    	}
    	div#preloader img {
    		display: block;
    	}
    </style>
  </head>
  <body>
    <div id="preloader"><?php echo $preload ?></div>
  </body>
</html>