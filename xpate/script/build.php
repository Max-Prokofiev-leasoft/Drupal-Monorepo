<?php

$parentDirectory = realpath(__DIR__.'/../../');

const PLUGIN_NAME = 'cool-plugin-for-xpate.v0.1';

// BANK_NAME is name of bank folder
const BANK_NAME = 'xpate';

/**
 * @param  string  $sourceFolder1
 * @param  string  $sourceFolder2
 * @param  string  $destinationFolder
 *
 * @return void
 */
function mergeFolders(
  string $sourceFolder1,
  string $sourceFolder2,
  string $destinationFolder
): void {
    if (!is_dir($sourceFolder1) || !is_dir($sourceFolder2)) {
        die("Source folders do not exist.");
    }

    if (!is_dir($destinationFolder)) {
        mkdir($destinationFolder, 0777, true);
    }

    copyFolderContents($sourceFolder1, $destinationFolder);
    copyFolderContents($sourceFolder2, $destinationFolder);
}

/**
 * @param  string  $source
 * @param  string  $destination
 *
 * @return void
 */
function copyFolderContents(
  string $source,
  string $destination
): void {
    $dir = opendir($source);

    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            $sourceFile = $source.'/'.$file;
            $destFile = $destination.'/'.$file;

            if (is_dir($sourceFile)) {
                copyFolderContents($sourceFile, $destFile);
            } else {
                copy($sourceFile, $destFile);
            }
        }
    }

    closedir($dir);
}

/**
 * @param  string  $sourceFolder
 * @param  string  $zipFilename
 *
 * @return bool
 */
function createZipArchive(
  string $sourceFolder,
  string $zipFilename
): bool {
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

$buildFolder = __DIR__.'/build';
$coreDir = $parentDirectory.'/core';
$bankFuncDir = $parentDirectory.'/'.BANK_NAME.'/bank_func';
$zipFilename = $parentDirectory.'/'.BANK_NAME.'/'.PLUGIN_NAME.'.zip';

mergeFolders(
  $coreDir,
  $bankFuncDir,
  $buildFolder
);

createZipArchive($buildFolder, $zipFilename);

?>