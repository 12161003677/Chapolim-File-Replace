<?php
namespace App;
class Chapolim
{
    static function get_dir_contents($dir, &$results = array())
    {
        if (is_file($dir)) {
            $results[] = $dir;
            return $results;
        }
        $files = scandir($dir);
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (is_file($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                Chapolim::get_dir_contents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }

    static function file_replace($search, $replace, $dir):void
    {
        foreach(Chapolim::get_dir_contents($dir) as $file){
            if(is_file($file)){
                if(file_put_contents($file, str_replace($search, $replace, file_get_contents($file)))){
                    echo "\n\t - $file File changed successfully";
                }
            }
        }
        return;
    }
}