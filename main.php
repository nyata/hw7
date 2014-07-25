<?php
  $url = $_SERVER["REQUEST_URI"];
  if(!empty($_GET["message"])) {
    $get = $_GET["message"];
  } elseif($_GET["pos"]) {
    $get = $_GET["pos"];
  }

  if(preg_match('/convert/', $url)) {
    $flg = true;
    $result = convert($get);
  } elseif(preg_match('/show/', $url)) {
    $flg = true;
    $result = show($get, "convert?message=");
  } elseif(preg_match('/getword/', $url)) {
    $flg = true;
    $result = getword($get);
  } elseif(preg_match('/madlib/', $url)) {
    $flg = true;
    $result = madlib();
  } else {
    $flg = false;
    echo "<ul>";
    echo "<li>/convert?message=hogehoge</li>";
    echo "<li>/show?message=hogehoge</li>";
    echo "<li>/getword?pos=color</li>";
    echo "<li>/madlib</li>";
    echo "</ul>";
  }
  if($flg) {
    echo htmlspecialchars($result, ENT_QUOTES);
  }
  
  function convert($get) {
    $ar = str_split($get);
    $j = 0;
    $result = "";
    for($i = count($ar); $i >= 0; $i--) {
       //echo htmlspecialchars($ar[$i], ENT_QUOTES);
       $result .= $ar[$i];
    }
    return $result;
  }

  function show($get, $seg) {
    $url = array(
      "http://step-homework-hnoda.appspot.com/",
      "http://step-test-krispop.appspot.com/",
      "http://ivory-haven-645.appspot.com/",
      "http://1-dot-alert-imprint-645.appspot.com/",
      "http://ceremonial-tea-645.appspot.com/",
      "http://second-strand-645.appspot.com/",
      "http://1.nyatagi.appspot.com/",
      "http://1-dot-kaisuke5-roy7.appspot.com/hw7/",
      "http://1-dot-s1200029.appspot.com/testproject/",
      "http://yuki-stephw7.appspot.com/",
      "http://1-dot-anmi0513.appspot.com/myapp/",
      "http://1-dot-stephomework7.appspot.com/",
      "http://1-dot-stepnaomaki.appspot.com/stepweek7",
      "http://1-dot-step-homework-fumiko.appspot.com/",
      "http://1-dot-teeeest0701.appspot.com/",
      "http://1-dot-step-homework-kitade.appspot.com/",
      "http://misaki-step-hw7.appspot.com/",
      "http://nozomi-step-hw7.appspot.com/",
      "http://1-dot-step-homework-nana-serizawa.appspot.com/",
      "http://1.stephomework7rk.appspot.com/",
    );
    $rand = rand(0, count($url)-1);

    if(@file_get_contents($url[$rand].$seg.$get)) {
      $file = @file_get_contents($url[$rand].$seg.$get);
    } else {
      $file = convert($get);
    }
    //var_dump($url[$rand]);
    //var_dump($file);
    return $file;
  }

  function getword($get) {
    $word = array(
      "red" => "apple",
      "yellow" => "lemon",
      "orange" => "carrot",
      "light-green" => "leaf",
      "green" => "green pepper",
      "light-blue" => "sky",
      "blue" => "sea",
      "purple" => "eggplant",
      "brown" => "bear",
      "gray" => "mouse",
      "black" => "avocado"
    );
    if(!empty($word[$get])) {
      $result = $word[$get];
    } else {
      $key = array_rand($word);
      $result = $word[$key];
    }
    return $result;
  }
  
  function madlib() {
    $message = array(
      array("", " plays", " the trombone", " with ", ""),
      array("", " who has no", " has no wings."),
      array("The man met a ", "", " who has the ", ""),
    );
    $word = array("red","apple","yellow","lemon","orange","carrot",
    "light-green" ,"leaf","green","green pepper","light-blue","sky",
    "blue","sea","purple","eggplant","brown","bear","gray","mouse",
    "black","avocado"
    );
    $rand = rand(0, count($message)-1);
    $result = "";
    foreach($message[$rand] as $val) {
      if(empty($val)) {
        $rand2 = rand(0, count($word)-1);
        $val = show($word[$rand2], 'getword?pos=');
        if(empty($val)) {
          $val = $word[$rand2];
        }
      }
      $result .= $val;
    }
    return $result;
  }
