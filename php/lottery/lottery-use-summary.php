<?php
declare(strict_types=1);

class CumulativeSummary {
    private array $samples = [];
    private int $summation = 0;
    function __construct(array $samples) {
        $this->samples = $samples;
        $this->summation = array_sum($this->samples);

        $lots = [];
        foreach ($this->samples as $name => $count) {
            echo sprintf("%s の確率: %4.3f%%\n", $name, ($count / $this->summation) * 100);
        }
    }

    public function weightedRandomSelect(): string
    {
        $random = random_int(0, $this->summation);
        // どれにも該当しない場合一番最後の要素になる
        $hit = array_key_last($this->samples);
        foreach ($this->samples as $key => $max) {
            if ($random < $max) {
                $hit = $key;
                break;
            }
        }

        return "{$hit} ({$random})";
    }
}

$samples = [
    '1等' => 1,
    '2等' => 5,
    '3等' => 20,
    'はずれ' => 74,
];

$cs = new CumulativeSummary($samples);
echo $cs->weightedRandomSelect() . PHP_EOL;
