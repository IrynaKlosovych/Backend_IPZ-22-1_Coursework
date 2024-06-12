<?php

function searchFile(string $filename, array $directories): ?string
{
    foreach ($directories as $directory) {
        $absolutePath = realpath($directory);
        $files = scandir($absolutePath);
        if ($files !== false) {
            if (in_array($filename, $files)) {
                $relativePath = substr($absolutePath, strlen($_SERVER['DOCUMENT_ROOT']));
                $relativePath = str_replace('\\', '/', $relativePath);
                return $relativePath . "/" . $filename;
            }
        } else {
            return null;
        }
    }
    return null;
}





