<?php
declare(strict_types=1);

class CumulativeArray {

    private array $lots = [];

    function __construct(array $samples)
    {
        $lots = [];
        foreach ($samples as $key => $weight) {
            $lots = array_merge($lots, array_fill(0, $weight, $key));
        }

        $this->lots = $lots;
    }

    public function weightedRandomSelect(): string
    {
        $random = random_int(0, count($this->lots) - 1);

        return $this->lots[$random];
    }
}


$samples = [
    '1等' => 1,
    '2等' => 5,
    '3等' => 20,
    'はずれ' => 74,
];

$ca = new CumulativeArray($samples);

for ($try = 0; $try < 10; $try++) {
    $results = [];

    $start = microtime(true);
    $count = 1000000;
    for($i = 0; $i < $count; $i++) {
        $lottery =  $ca->weightedRandomSelect();
        if (!isset($results[$lottery])) {
            $results[$lottery] = 0;
        }
        $results[$lottery]++;
    }

    echo sprintf("%4.4f\tms\n", (microtime(true) - $start) * 1000);

    foreach (array_keys($samples) as $key) {
        echo sprintf("%s\t%d\t%4.2f\t%%\n", $key, $results[$key], $results[$key] / $count * 100);
    }
}
