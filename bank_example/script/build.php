<?php

$parentDirectory = realpath(__DIR__.'/../../');

const BANK_NAME = 'bank_example';
const PLUGIN_NAME = 'payment-plugin';

/**
 * Merge two folders into a destination folder.
 *
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
    } else {
        // Clear existing contents of $destinationFolder
        clearDirectory($destinationFolder);
    }

    copyFolderContents($sourceFolder1, $destinationFolder);
    copyFolderContents($sourceFolder2, $destinationFolder);
}

/**
 * Recursively clear the contents of a directory.
 *
 * @param  string  $directory
 *
 * @return void
 */
function clearDirectory(string $directory): void {
    $files = glob($directory . '/*');
    foreach ($files as $file) {
        is_dir($file) ? clearDirectory($file) : unlink($file);
    }
}

/**
 * Recursively copy the contents of one folder to another.
 *
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
                // Create subdirectory in the destination if it doesn't exist
                if (!is_dir($destFile)) {
                    mkdir($destFile, 0777, true);
                }

                copyFolderContents($sourceFile, $destFile);
            } else {
                copy($sourceFile, $destFile);
            }
        }
    }

    closedir($dir);
}

/**
 * Create a zip archive from a source folder.
 *
 * @param  string  $sourceFolder
 * @param  string  $zipFilename
 *
 * @return bool
 */
function createZipArchive(
  string $sourceFolder,
  string $zipFilename
): bool {
    // Check if the zip file already exists and delete it
    if (file_exists($zipFilename)) {
        unlink($zipFilename);
    }

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
$zipFilename = $parentDirectory.'/'.BANK_NAME.'/'.BANK_NAME.'-'.PLUGIN_NAME.'.zip';

mergeFolders(
  $coreDir,
  $bankFuncDir,
  $buildFolder
);

createZipArchive($buildFolder, $zipFilename);
//test
//22
?>
