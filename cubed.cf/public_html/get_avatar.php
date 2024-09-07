<?php
if ($_GET['id'] == '46') {
    $asa = 'https://media.discordapp.net/attachments/815319277925957672/937160130896724009/image-removebg-preview_77.png';
} elseif ($_GET['id'] == '2') {
    $asa = '/img/philosophy.png';
} elseif ($_GET['id'] == '3') {
    $asa = '/img/janx.png';
} elseif ($_GET['id'] == '47') {
    $asa = 'https://tr.rbxcdn.com/c40cbfe6c483de28e2a01f9fac53b1b0/352/352/Avatar/Png';
} elseif ($_GET['id'] == '4') {
    //$asa = 'https://i.pinimg.com/originals/85/02/a6/8502a6e4b7f0774c0ee9a17a8920a616.png';
    //$asa = 'https://i.pinimg.com/originals/fd/cd/cc/fdcdcc8096b22360dc75f9338706e64b.png';
    $asa = '/img/Katrina.png';                            
} else {
    $asa = '/img/Default.png';
}
header('Location: '.$asa);
?>