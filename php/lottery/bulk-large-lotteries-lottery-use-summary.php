<?php
declare(strict_types=1);

class CumulativeSummary {
    private array $samples = [];
    private array $cumulative = [];
    private int $summation = 0;

    public function __construct(array $samples) {
        $this->samples = $samples;
        $this->summation = array_sum($this->samples);

        $cumulative = 0;
        foreach ($this->samples as $name => $count) {
            $cumulative += $count;
            $this->cumulative[$name] = $cumulative;
            // echo sprintf("%s の確率: %4.3f%%\n", $name, ($count / $this->summation) * 100);
        }
    }

    public function weightedRandomSelect(): string {
        $random = random_int(0, $this->summation - 1);

        foreach ($this->cumulative as $key => $max) {
            if ($random < $max) {
                return $key;
            }
        }

        // フォールバック（通常到達しない）
        return "エラー";
    }
}

function positiveInteger(int $max): array
{
    $list = [];
    for($i = 1; $i <= $max; $i++) {
        $list["{$i}等"] = $i;
    }

    return $list;
}

$samples = positiveInteger(5000);
echo "配列セット完了\n";

$cs = new CumulativeSummary($samples);
echo "インスタンス生成\n";

for ($try = 0; $try < 10; $try++) {
    $results = [];

    $start = microtime(true);
    $count = 1000000;
    for($i = 0; $i < $count; $i++) {
        $lottery =  $cs->weightedRandomSelect();
        if (!isset($results[$lottery])) {
            $results[$lottery] = 0;
        }
        $results[$lottery]++;
    }

    echo sprintf("%4.4f\tms\n", (microtime(true) - $start) * 1000);

    // foreach (array_keys($samples) as $key) {
    //     echo sprintf("%s\t%d\t%4.2f\t%%\n", $key, $results[$key], $results[$key] / $count * 100);
    // }
    unset($results);
}
