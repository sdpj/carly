<?php
function filterBadWords($str){

 // words to filter
 $badwords=array( "fuck", "shit", "cock", "penis", "cum", "sex", "cumshot", "f u c k", "squirt", "intercourse", "feck", "fek", "shite", "cok", "p3n1s", "pen1s", "vagina", "shithole" );

 // replace filtered words with
 $replacements=array( "[ Content Deleted ]" );

 for($i=0;$i < sizeof($badwords);$i++){
  srand((double)microtime()*1000000); 
  $rand_key = (rand()%sizeof($replacements));
  $str=eregi_replace($badwords[$i], $replacements[$rand_key], $str);
 }
 return $str;
}
?>