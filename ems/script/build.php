<?php

function mergeFolders($sourceFolder1, $sourceFolder2, $destinationFolder)
{
    if (!is_dir($sourceFolder1) || !is_dir($sourceFolder2)) {
        die("Source folders do not exist.");
    }

    if (!is_dir($destinationFolder)) {
        mkdir($destinationFolder, 0777, true);
    }

    copyFolderContents($sourceFolder1, $destinationFolder);
    copyFolderContents($sourceFolder2, $destinationFolder);
}

function copyFolderContents($source, $destination)
{
    $dir = opendir($source);

    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            $sourceFile = $source . '/' . $file;
            $destFile = $destination . '/' . $file;

            if (is_dir($sourceFile)) {
                copyFolderContents($sourceFile, $destFile);
            } else {
                copy($sourceFile, $destFile);
            }
        }
    }

    closedir($dir);
}

function createZipArchive($sourceFolder, $zipFilename)
{
    $zip = new ZipArchive();
    if ($zip->open($zipFilename, ZipArchive::CREATE) === true) {
        $files = new RecursiveIteratorIterator(
          new RecursiveDirectoryIterator($sourceFolder),
          RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($sourceFolder) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();
        return true;
    } else {
        return false;
    }
}

$parentDirectory = realpath(__DIR__ . '/../');
$buildFolder = __DIR__ . '/build';

mergeFolders($parentDirectory . '/core', $parentDirectory . '/bank_func', $buildFolder);

createZipArchive($buildFolder, $parentDirectory . '/ems-plugin.zip');

?>
