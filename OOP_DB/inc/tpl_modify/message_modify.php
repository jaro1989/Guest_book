<?php

$messages = new Storage(2);

$paginator = new Messanger($messages->getData(), (isset($_GET['page']) ? $_GET['page'] : 1), (isset($_GET['mesNum']) ? $_GET['mesNum'] : 5));
$paginator->setShowFirstAndLast(false);
// You can overwrite the default seperator
$paginator->setMainSeperator(' | ');





