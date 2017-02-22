<?php

require_once __DIR__.'/vendor/autoload.php';

$simpleCalculator = new \Vadim\UnitExamples\SimpleCalculator();
echo $simpleCalculator->add(1, 2);
