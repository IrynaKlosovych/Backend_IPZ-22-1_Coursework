<?php

function searchFile(string $filename, array $directories): ?string
{
    foreach ($directories as $directory) {
        $absolutePath = realpath($directory);
        $files = scandir($absolutePath);
        if ($files !== false) {
            if (in_array($filename, $files)) {
                return $directory . "/". $filename;
            }
        } else {
            return null;
        }
    }
    return null;
}





