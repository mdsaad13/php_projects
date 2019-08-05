<?php
$part1 = mt_rand(5000,5999);
$part2 = mt_rand(111111111111,999999999999);
$card_num =$part1.$part2;

function count_digit($number) 
{
    return strlen($number);
} 
$number_of_digits = count_digit($card_num);

$num1 = substr($card_num, 0, 4);
$num2 = substr($card_num, 4, 4);
$num3 = substr($card_num, 8, 4);
$num4 = substr($card_num, 12, 4);

$dis_last = substr($card_num, 10, 6);

?>
<html>
<h1>Card Number = <span style="color:red;font-weight:bold;"> <?= $card_num ?> </span></h1>
<h1>Number of digits = <span style="color:green;"> <?= $number_of_digits ?> </span></h1>
<h1>Display last 6 digits = **********<span style="color:green;"><?= $dis_last?> </span></h1>
<h1>Break in 4 parts = <span style="color:green;"> <?= $num1?> - <?= $num2?> - <?= $num3?> - <?= $num4?> </span></h1>

</html>