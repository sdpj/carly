<?php
function filterBadWords($str){

 // words to filter
 $badwords=array( "fuck", "shit", "cock", "penis", "cum", "sex", "cumshot", "f u c k", "squirt", "intercourse", "feck", "fek", "shite", "cok", "p3n1s", "pen1s", "vagina", "shithole", "bldn", "brick luke deez nuts", "brick-luke deez nuts", "RHASPODY IS THE KING LOSERS, BOW TO ME BITCH", " RHASPODY IS THE KING LOSERS, BOW TO ME BITCH");

 // replace filtered words with
 $replacements=array( "<contentdeleted style=\"color:red;\">[Content Deleted]</contentdeleted>" );

 for($i=0;$i < sizeof($badwords);$i++){
  srand((double)microtime()*1000000); 
  $rand_key = (rand()%sizeof($replacements));
  $str=eregi_replace($badwords[$i], $replacements[$rand_key], $str);
 }
 return $str;
}
?>