<?php
declare(strict_types=1);

$samples = [
    '1等' => 10,
    '2等' => 30,
    '3等' => 100,
    '4等' => 500,
    '5等' => 1000,
    'はずれ' => 100000,
];

$summation = array_sum($samples);

$lots = [];
foreach ($samples as $name => $count) {
    echo sprintf("%s の確率: %4.3f%%\n", $name, ($count / $summation) * 100);
    $lots = array_merge($lots, array_fill(0, $count, $name));
}

$random = random_int(0, count($lots) - 1);

echo ">> {$lots[$random]}\n";
?>