<?php

if(isset($_GET['url'])){
    $url = $_GET['url'];
    show($url);
}
else if($_POST['url']){
    $url = $_POST['url'];
    show($url);
}
else{
    echo "<form action=\"index.php\" method=\"post\">";
    echo "<div>";
      echo "<label>填写url</label>";
      echo "<input type=\"text\" name=\"url\">";
    echo "</div>"."<button type=\"submit\">提交</button>";
  echo "</form>";
}

function show($url){
    $url = $url;
    if(substr($url,4 == !"http")){
        $array = explode("/",$url);
        //var_dump($array);
        $host = $array[0];
    }
    else{
        $host = parse_url($url)['host'];
        echo $host;
    }
    $userAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true) ;
    curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
    $result = curl_exec($curl);
    $rep = "href=\"http://thz.hege.tech/index.php?url=".$host."/";
    echo $rep;
    // $result = str_replace("http://","http://cs.miuier.com/index.php?url=",$result);
    // $result = str_replace("https://","http://cs.miuier.com/index.php?url=",$result);
    $result = str_replace("href=\"",$rep,$result);
    echo $result;
}