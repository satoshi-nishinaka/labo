<?php

function archiveZipFile(string $outputFilePath, SplFileObject $file, string $password): bool
{
    $zip = new \ZipArchive();
    if ($zip->open($outputFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
        return false;
    }

    $zip->setPassword($password);
    if (!$zip->addFile($file->getPathname(), $file->getFilename())) {
        return false;
    }

    $zip->setEncryptionName($file->getFilename(), \ZipArchive::EM_AES_256);

    if (!$zip->close()) {
        return false;
    }

    return true;
}

$directory = dirname(__FILE__) . '/output';
if (!file_exists($directory)) {
    mkdir($directory);
}

$file = new SplFileObject("{$directory}/example72-failed.txt", 'w');
$file->fwrite(str_repeat('x', 256));

$result = archiveZipFile("{$directory}/example72-failed.zip", $file, 'password');

echo $result ? 'Success' : 'Failed';
