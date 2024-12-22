<?php
declare(strict_types=1);

$samples = [
    '1等' => 1,
    '2等' => 5,
    '3等' => 20,
    'はずれ' => 74,
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