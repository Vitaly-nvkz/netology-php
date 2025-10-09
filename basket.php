<?php
const OPERATION_EXIT = 0;
const OPERATION_ADD = 1;
const OPERATION_DELETE = 2;
const OPERATION_PRINT = 3;

$operations = [
    OPERATION_EXIT => OPERATION_EXIT . '. Завершить программу.',
    OPERATION_ADD => OPERATION_ADD . '. Добавить товар в список покупок.',
    OPERATION_DELETE => OPERATION_DELETE . '. Удалить товар из списка покупок.',
    OPERATION_PRINT => OPERATION_PRINT . '. Отобразить список покупок.',
];

$items = [];

function getoperationNumber(array $operations):int{

    for ($i = 0; $i < 1;) {
        echo 'Выберите операцию для выполнения: ' . PHP_EOL;
        $operationNumber = trim(fgets(STDIN));
        $operationNumber = intval($operationNumber);

        if (!array_key_exists($operationNumber, $operations)) {
            system('cls');
            echo '!!! Неизвестный номер операции, повторите попытку.' . PHP_EOL;
        }
        else {
            return $operationNumber;
            $i++;
        }
    }
}

function getMenuOperations (array $operations, array $items){

    // Проверить, есть ли товары в списке? Если нет, то не отображать пункт про удаление товаров
    if (count($items)) {
        echo implode(PHP_EOL, $operations) . PHP_EOL . '> ';
    }
    else{
        unset($operations[2]);
        echo implode(PHP_EOL, $operations) . PHP_EOL . '> ';
    }

}

function operationAdd(array &$items){

    echo "Введение название товара для добавления в список: \n> ";
    $itemName = trim(fgets(STDIN));
    $items[] = $itemName;

}

function operationDell(array &$items) {

    if (count($items)){

        echo 'Текущий список покупок:' . PHP_EOL;
        echo 'Список покупок: ' . PHP_EOL;
        echo implode("\n", $items) . "\n";

        echo 'Введение название товара для удаления из списка:' . PHP_EOL . '> ';
        $itemName = trim(fgets(STDIN));

        if (in_array($itemName, $items, true) !== false) {
            while (($key = array_search($itemName, $items, true)) !== false) {
                unset($items[$key]);
            }
        }

    }
    else{
        echo "У вас нет товаров в корзине, выберите другую операцию: " . PHP_EOL;
    }
}

function operationPrint(array $items){

    echo 'Ваш список покупок: ' . PHP_EOL;
    echo implode(PHP_EOL, $items) . PHP_EOL;
    echo 'Всего ' . count($items) . ' позиций. '. PHP_EOL;
    echo 'Нажмите enter для продолжения';
    fgets(STDIN);

}

do {
//    system('clear');
    system('cls'); // windows

    if (count($items)) {
        echo 'Ваш список покупок: ' . PHP_EOL;
        echo implode("\n", $items) . "\n";
    } else {
        echo 'Ваш список покупок пуст.' . PHP_EOL;
    }

    getMenuOperations($operations, $items) . PHP_EOL;

    $operationNumber = getoperationNumber($operations) . PHP_EOL;
    $operationNumber = intval($operationNumber);

    echo 'Выбрана операция: ' . $operations[$operationNumber] . PHP_EOL;

    switch ($operationNumber) {
        case OPERATION_ADD:
            operationAdd($items);
            break;

        case OPERATION_DELETE:
            // Проверить, есть ли товары в списке? Если нет, то сказать об этом и попросить ввести другую операцию
            operationDell($items);
            break;

        case OPERATION_PRINT:

            operationPrint($items);
            break;
    }

}
while ($operationNumber > 0);
