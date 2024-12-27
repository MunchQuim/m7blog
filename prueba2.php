<?php
$age = 25;
$age_2 = '25';
$age_3 = "25";
$n = '<br>';
$result = $age + $age_2;
$result2 = $age_2 + $age_3;
$result3 = $age + $age_3;

print_r($result.$n);
print_r($result2.$n);
print_r($result3.$n);
// observa como suma letras y numeros
?>