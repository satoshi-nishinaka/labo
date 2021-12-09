<?php

function archiveZipFile(string $outputFilePath, SplFileObject $file, string $password): bool
{
    $zip = new ZipArchive();
    if ($zip->open($outputFilePath, ZipArchive::CREATE | ZIPARCHIVE::OVERWRITE) !== true) {
        return false;
    }

    if (!$zip->addFile($file->getPathname(), $file->getFilename())) {
        return false;
    }

    if (!$zip->close()) {
        return false;
    }

  // NOTE: パスワードを設定できるのはPHP7.2以降なのでzipコマンドで代用する
  // https://www.php.net/manual/ja/ziparchive.setencryptionname.php
    exec("zip -jP {$password} {$outputFilePath} {$file->getPathname()}");

    return true;
}

$directory = dirname(__FILE__) . '/output';
if (!file_exists($directory)) {
    mkdir($directory);
}

$file = new SplFileObject("{$directory}/example71.txt", 'w');
$file->fwrite(str_repeat('x', 256));

$result = archiveZipFile("{$directory}/example71.zip", $file, 'password');

echo $result ? 'Success' : 'Failed';
