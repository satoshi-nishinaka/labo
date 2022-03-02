# テスト駆動開発とともに Go を学ぶ

- [Hello, World - テスト駆動開発で GO 言語を学びましょう](https://andmorefine.gitbook.io/learn-go-with-tests/go-fundamentals/hello-world)

## Qiita

- https://qiita.com/satoshi-nishinaka/private/11e8831c15ec07b097d0

## 準備

### インストール

```bash
$ brew install go
```

### 初期化

```bash
$ mkdir -p ~/go/src ~/go/pkg ~/go/bin
$ export GOPATH=$HOME/go
$ export PATH=$PATH:$GOPATH/bin
$ go mod init [GOPATHで最初のスラッシュを除去した状態]
```

## ビルド
```bash
$ go build
```

## Go のテストコマンド

###

```bash
$ go test
```

### サンプル関数も含めて実行

```bash
$ go test -v
```

### ベンチマーク計測

```bash
$  go test -bench=.
```

### カバレッジ計測

```bash
$ go test -cover
```

## その他
### エラーチェックをしてくれるLinterのインストール

```bash
$ go get -u github.com/kisielk/errcheck
```

###　errcheckの実行方法
対象のコードが存在するディレクトリで実行
```bash
$ errcheck .
```


----

### 現在の場所
次はここから
https://andmorefine.gitbook.io/learn-go-with-tests/build-an-application/json#memi