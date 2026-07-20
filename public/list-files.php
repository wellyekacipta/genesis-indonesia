<?php

header('Content-Type: text/plain');

echo "=== FILE LIST IN STORAGE/APP/PUBLIC ===\n\n";

$dir = __DIR__ . '/../storage/app/public';

function listFolderFiles($dir){
    $ffs = scandir($dir);

    echo "Directory: " . realpath($dir) . "\n";
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
            $path = $dir.'/'.$ff;
            if(is_dir($path)) {
                echo " [Folder] $ff\n";
                listFolderFiles($path);
            } else {
                echo "   - $ff (" . filesize($path) . " bytes)\n";
            }
        }
    }
}

if (is_dir($dir)) {
    listFolderFiles($dir);
} else {
    echo "Directory does not exist!\n";
}
