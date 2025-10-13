<?php
class Directories {
    public function createDirectoryAndFile($directoryName, $fileContent) {
        $baseDir = 'directories/';
        $newDirPath = $baseDir . $directoryName;
        
        if (is_dir($newDirPath)) {
            return ['status' => 'error', 'message' => 'A directory already exists with that name.'];
        }

        if (!mkdir($newDirPath, 0777, true)) {
            return ['status' => 'error', 'message' => 'Could not create the directory.'];
        }

        $filePath = $newDirPath . '/readme.txt';

        if (file_put_contents($filePath, $fileContent) === false) {
            return ['status' => 'error', 'message' => 'Could not create the file.'];
        }

        return ['status' => 'success', 'message' => $filePath];
    }
}
