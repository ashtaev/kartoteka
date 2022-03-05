<?php

require_once "Auction.php";

//Задание 1: Найдите ошибки в файле в приложении

print_r(Auction::xmlValidate('test.xml'));


//Напишите код (на PHP) выдающий массив данных:
//   - Должник: id, тип, имя
//   - Список лотов: по каждому - номер, стоимость, описание.

$au = new Auction('test.xml');
print_r($au->getBankruptInfo());
print_r($au->getAuctionLots());
