<?php

// Задание 1: Напишите код (функцию, класс), которая проверяет простое число или нет
// На вход - число, выход - да/нет

require_once "function.php";

try {
    echo is_prime(11);
} catch (Exception $e) {
    echo 'Exception: ', $e->getMessage(), PHP_EOL;
} catch (Error $e) {
    echo "Ошибка: ", $e->getMessage(), PHP_EOL;
}


// Задание 2: Есть счет, в котором указана сумма с НДС, есть дата счета и все прочие атрибуты.
// Напишите класс, в нем метод - в который на вход поступает информация о счете, на выходе - стоимость без НДС (страна - Российская Федерация)

require_once "Account.php";

$amount = '{
    "sum": 120000.99,
    "vat_rate": 20,
    "data": "2022-03-04 00:00:00",
    "attribute1": "value",
    "attribute2": "value"
}';

try {
    echo (new Account)->getAmountWithoutNDS($amount);
} catch (Exception $e) {
    echo 'Exception: ', $e->getMessage(), PHP_EOL;
} catch (Error $e) {
    echo "Ошибка: ", $e->getMessage(), PHP_EOL;
}
