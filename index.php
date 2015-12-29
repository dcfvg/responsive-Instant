<?php
  error_reporting(E_ALL & ~E_NOTICE);
  $sets = glob("content/*-*/");
  $res = [];



  if(isset($_GET['set'])){
    if($_GET['set'] !== 'list'){
     $res = genGrid("content/*-".preg_replace("/[^A-Za-z0-9 ]/", '', $_GET['set']).'/');

    }else {
      $res['list'] = "<h1>responsive instant</h1><hr/>";
      foreach ($sets as $setId => $set){
        $name = substr(basename($set),3,200);
        $imgs = glob($sets[$setId]."*.jpg");

        $res['list'] .= '<p class="col-sm-2"><a href="?set='.$name.'" ><img class="img-responsive"src="'.$imgs[5].'">'.$name.'</a><p>';
      }
    }

  }else{
    $res = genGrid('content/*-shining/');
  }

  function genGrid($set){

    $images = glob($set."*.jpg");
    $step   = 1;

    foreach ($images as $id => $image) {
        $res['css'] .= "@media (min-width: ".(350+($id*$step))."px) {body{background-image: url('$image');}}";
        $res['preload'] .= '<img src="'.$image.'">';
    }

    $res['preview'] = $images[0];

    return $res;
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>wait loading & resize window</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/screen.css">
    <style type="text/css">
    body {
      height:100%;
      background:  url('<?php echo $res['preview'];?>') no-repeat;
      background-size:cover;
    }
    <?php echo $res['css'] ?>
    </style>
  </head>
  <body>
    <div id="list"><?php echo  $res['list'] ?></div>
    <div id="preloader"><?php echo $res['preload'] ?></div>
    <div id="help"><a href="?set=list">?</a></div>
  </body>
</html>
