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
            echo sprintf("%s の確率: %4.3f%%\n", $name, ($count / $this->summation) * 100);
        }
    }

    public function weightedRandomSelect(): string {
        $random = random_int(0, $this->summation - 1);

        foreach ($this->cumulative as $key => $max) {
            if ($random < $max) {
                return "{$key} (random: {$random})";
            }
        }

        // フォールバック（通常到達しない）
        return "エラー";
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
