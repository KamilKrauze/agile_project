<?php 
/*source code: https://www.quora.com/How-can-I-count-page-visit-of-each-user-in-PHP?share=1*/
 $counter_file = "count.txt"; 
/* create counter file if doesn't exists */ 
 if(!file_exists($counter_file)){ 
 $f = fopen($counter_file, "w"); 
 fwrite($f,"0"); 
 fclose($f); 
 } 
/* get current value of counter */ 
 $f = fopen($counter_file, "r"); 
 $count = fread($f, filesize($counter_file)); 
 fclose($f); 
 $count++; 
 $f = fopen($counter_file, "w"); 
 fwrite($f, $count); 
 fclose($f); 
//optional statement to print counter value 
 print("Counter :".$count); 
?>