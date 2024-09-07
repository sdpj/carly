<?
while ($repeat < 10) {
$repeat = $repeat + 1;
while($length < 1064)
{
$randnum = rand(1,9);
$randlet2 = rand(1,6);
$randbot = rand(1,2);
$length = $length + 1;
if($randbot == 1)
{
echo $randnum;
}
if($randbot == 2)
{
if($randlet2 == 1)
{
echo 'A';
}
if($randlet2 == 2)
{
echo 'B';
}
if($randlet2 == 3)
{
echo 'C';
}
if($randlet2 == 4)
{
echo 'D';
}
if($randlet2 == 5)
{
echo 'E';
}
if($randlet2 == 6)
{
echo 'F';
}
}
}
echo "<br />";
}


?>