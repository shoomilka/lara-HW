<?php

$date = new DateTime('10:33 AM');
$date->add(DateInterval::createFromDateString("1 hour"));
echo $date->format('H:i A') . "\n";