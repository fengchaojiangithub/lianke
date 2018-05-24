<?php
header("Content-Type: text/html;charset=utf-8");
     function jishuantime($time){

          

          $newtime = time();
          $time=$newtime-$time;

          $htime=3600;
          $day  =24*$htime;

          $itime=60;

          $times=ceil($time/$htime);
          $itmes=ceil($time/$itime);
          if($itmes>=60){

            if($times>=24){
              $times=ceil($time/$day);
              return $times."天前";              
            }else{
              return $times."小时前";
            }

          }else if($itmes<1){

            return "刚刚";
          }else{

            return $itmes."分钟前";
          }

     }