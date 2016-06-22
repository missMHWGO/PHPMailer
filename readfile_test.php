<?php
//header("Content-type: text/html; charset=utf-8");

function GetContent($filename){
      $content = "";
      // if(file_exists($path)){
      //     $content = file_get_contents($path);//file_get_contents()可以读取html文件，但不能读取txt文件
      // }else{
      //   echo 'can\'t read fail';
      // }      
      // return $content;    

      $fp = fopen($filename,"r") or die("Unable to open file!");
      $content = fread($fp,filesize($filename));
      fclose($fp);
      return $content;
}

$txt = GetContent('essay.txt');
echo $txt;