<?php

namespace Util;

function formaterOptions(array $options):array | null
{
    # If not exist elements in the array, a null is returned
    if(count($options) == 0){ return null; }

    # Create an empty array
    $newOptions = [];

    foreach($options as $key => $value){
        # This can only recognize 4 parameters and each one has its own structure to store
        switch ($key){
            case 'word':
                $newOptions[$key] = [
                    'table' => "CONCAT(m.mark,' ',v.version)",
                    'value' => "'%".$value."%'",
                    'equal' => 'COLLATE utf8mb4_unicode_ci LIKE'
                ];
            break;
            case 'type':
                $newOptions[$key] = [
                    'table' => 'v.type',
                    'value' => "'".$value."'",
                    'equal' => 'COLLATE utf8mb4_unicode_ci ='
                ];
            break;
            case 'fuel':
                $newOptions[$key] = [
                    'table' => 'v.fuel',
                    'value' => "'".$value."'",
                    'equal' => 'COLLATE utf8mb4_unicode_ci ='
                ];
            break;
            case 'mark':
                $newOptions[$key] = [
                    'table' => 'm.id_mark',
                    'value' => $value,
                    'equal' => '='
                ];
            break;
        }
    }

    # if exists elements in the array $options, but none match with the switch, then a null is returned
    if(count($newOptions) == 0){ return null; }

    # else, the new array is returned
    return $newOptions;
}