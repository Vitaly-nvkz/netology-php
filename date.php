<?php

$mounth = "";
$years = "";
$workday = true;
$countdayoff = 0;

echo "Введите месяц: " . PHP_EOL;
$mounth = fgets(STDIN);

echo "Введите год: " . PHP_EOL;

$years = fgets(STDIN);

$countdays = cal_days_in_month(CAL_GREGORIAN, $mounth, $years); // 31


for ($i = 1; $i <= $countdays; $i++) {

    $timestamp = mktime(0, 0, 0, $mounth, $i, $years);
    $dt = DateTimeImmutable::createFromTimeStamp($timestamp);
    $dtjul = juliantojd($mounth, $i, $years);
    $dtdayoff = jddayofweek($dtjul, 0);


    if ($dtdayoff === 6 || $dtdayoff === 0 ||  $workday === false) {
        $workday = false;
        $countdayoff ++;
        $day = $dt->format('Y-m-d');
        echo "\033[32m Отдыхаем \033[0m" . "\033[32m $day \033[0m" . PHP_EOL;
        if ($countdayoff >= 2){
            $workday = true;;
        }
    }
    else if($countdayoff >= 2 || $workday === true) {
        $countdayoff = 0;
        $workday = false;
        $day = $dt->format('Y-m-d');
        echo "\033[31m Работаем \033[0m" . "\033[31m $day \033[0m" . PHP_EOL;
    }

}

