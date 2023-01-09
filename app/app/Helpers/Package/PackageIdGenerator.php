<?php

namespace App\Helpers\Package;

date_default_timezone_set('CET');                          // set date timezone

class PackageIdGenerator
{
    public static function generate(int $id, string $name)
    {    
        $attributes = [$id, $name];                         // convert arguments into array

        $time = str_replace(":", "", date("H:i:s"));        // sanitize date 
        $rand = rand(1000, 9999);                          

        $result = 0;                                        // converted attributes result
        foreach ($attributes as $index) {
            if (is_int($index)) {
                $result += $index;
            } else if(is_string($index)){
                for ($i = 0; $i < 3; $i++) {
                    $result += ord($index[$i]);             // convert string into ASCII code
                }
            }
        }

        $output = $rand.$result.$time;                      // merged number

        return (int)$output;
    }
}
