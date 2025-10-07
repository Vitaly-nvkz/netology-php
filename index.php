<?php
echo 'Введите ваше Имя: ';
$name = mb_strtolower(fgets(STDIN));

echo 'Введите вашу Фамилию: ';
$surname = mb_strtolower(fgets(STDIN));

echo 'Введите ваше Отчество: ';
$lastname = mb_strtolower(fgets(STDIN));

$fullname = mb_ucfirst($surname) .' '. mb_ucfirst($name) .' '. mb_ucfirst($lastname);

$fio = mb_ucfirst(mb_substr($name, 0, 1)) . mb_ucfirst(mb_substr($surname, 0, 1)) . mb_ucfirst(mb_substr($lastname, 0, 1));

$surnameAndInitials = mb_ucfirst($surname) . ' ' . mb_ucfirst(mb_substr($name, 0, 1)) . '.' . mb_ucfirst(mb_substr($lastname, 0, 1)) . '.';

fwrite(STDOUT, $fullname);
fwrite(STDOUT, $fio);
fwrite(STDOUT, $surnameAndInitials);