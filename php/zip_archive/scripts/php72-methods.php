<?php

function archiveZipFile(string $outputFilePath, SplFileObject $file, $method, string $password): bool
{
    $zip = new \ZipArchive();
    if ($zip->open($outputFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
        return false;
    }

    $zip->setPassword($password);
    if (!$zip->addFile($file->getPathname(), $file->getFilename())) {
        return false;
    }

    $zip->setEncryptionName($file->getFilename(), $method);

    if (!$zip->close()) {
        return false;
    }

    return true;
}

$directory = dirname(__FILE__) . '/output';
if (!file_exists($directory)) {
    mkdir($directory);
}

$methods = [\ZipArchive::EM_AES_128, \ZipArchive::EM_AES_192, \ZipArchive::EM_AES_256];

foreach($methods as $method) {
$file = new SplFileObject("{$directory}/example72-{$method}.txt", 'w');
$file->fwrite(str_repeat('x', 256));

$result = archiveZipFile("{$directory}/example72-{$method}.zip", $file, $method, 'password');

echo sprintf("method: %d => %s\n", $method, $result ? 'Success' : 'Failed');
}