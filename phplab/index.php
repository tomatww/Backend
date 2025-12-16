<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('./app/OilList.php');
require_once('./app/TypeList.php');
require_once('./app/PurposeList.php');
$a=new PurposeList();
$a->readFromCSV('data/purpose.csv');
$a->add(['name'=>'Для догляду за тілом']);
$a->display();
$a->writeToCSV('data/purpose.csv');
$a=new TypeList();
$a->readFromCSV('data/types.csv');
$a->add(['name'=>'Мінеральні олії']);
$a->display();
$a->writeToCSV('data/types.csv');
$a=new OilList();
$a->readFromCSV('data/oils.csv');
$a->add(['commonName'=>'Лавандова ефірна',
    'oilType'=>'Ефірні олії',
    'purpose'=>'універсальні засоби',
    'properties'=>'{"Бренд":"AromaLife", "Інгрідієнти":"лаванда","Об\'єм":"30 мл", "Країна":"Франція", "Ціна":"399.50"}'
]);
$a->display();
$a->writeToCSV('data/oils.csv');
