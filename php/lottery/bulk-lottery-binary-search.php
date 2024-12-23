<?php
declare(strict_types=1);

// ノードを表すクラス
class WeightedNode
{
    public string $value;
    public int $weight; // ノードの重み
    public int $subtreeWeight; // 部分木の総重み
    public ?WeightedNode $left;
    public ?WeightedNode $right;

    public function __construct(string $value, int $weight)
    {
        $this->value = $value;
        $this->weight = $weight;
        $this->subtreeWeight = $weight;
        $this->left = null;
        $this->right = null;
    }
}

// 重み付け二分探索木クラス
class WeightedBinarySearchTree
{
    private ?WeightedNode $root;

    public function __construct()
    {
        $this->root = null;
    }

    // 値を挿入するメソッド
    public function insert(string $value, int $weight): void
    {
        $this->root = $this->insertNode($this->root, $value, $weight);
    }

    private function insertNode(?WeightedNode $node, string $value, int $weight): WeightedNode
    {
        if ($node === null) {
            return new WeightedNode($value, $weight);
        }

        if ($value < $node->value) {
            $node->left = $this->insertNode($node->left, $value, $weight);
        } elseif ($value > $node->value) {
            $node->right = $this->insertNode($node->right, $value, $weight);
        }

        // 部分木の重みを更新
        $node->subtreeWeight = $node->weight + $this->getSubtreeWeight($node->left) + $this->getSubtreeWeight($node->right);

        return $node;
    }

    private function getSubtreeWeight(?WeightedNode $node): int
    {
        return $node ? $node->subtreeWeight : 0;
    }

    // 重みに基づいて乱択するメソッド
    public function weightedRandomSelect(): ?string
    {
        if ($this->root === null) {
            return null;
        }

        return $this->selectNode($this->root);
    }

    private function selectNode(WeightedNode $node): string
    {
        $leftWeight = $this->getSubtreeWeight($node->left);
        $randomWeight = random_int(1, $node->subtreeWeight);

        if ($randomWeight <= $leftWeight) {
            // 左部分木にある
            return $this->selectNode($node->left);
        } elseif ($randomWeight <= $leftWeight + $node->weight) {
            // 現在のノードを選択
            return $node->value;
        } else {
            // 右部分木にある
            return $this->selectNode($node->right);
        }
    }
}

$samples = [
    '1等' => 1,
    '2等' => 5,
    '3等' => 20,
    'はずれ' => 74,
];
$tree = new WeightedBinarySearchTree();
foreach($samples as $key => $value) {
    $tree->insert($key, $value);
}

for ($try = 0; $try < 10; $try++) {
    $results = [];

    $start = microtime(true);
    $count = 1000000;
    for($i = 0; $i < $count; $i++) {
        $lottery =  $tree->weightedRandomSelect();
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
