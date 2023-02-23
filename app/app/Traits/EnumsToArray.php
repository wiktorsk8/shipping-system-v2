<?php

namespace App\Traits;

trait EnumsToArray{
    public static function toArray(){
        foreach(self::cases() as $case){
            $array[$case->name] = $case->value;
        }
        return $array;
    }
}