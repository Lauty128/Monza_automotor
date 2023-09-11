<?php

namespace Util;

function formaterOptions(array $options):array | null
{
    if(count($options) == 0){ return null; }

    $newOptions = [];

    foreach($options as $key => $value){
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

    if(count($newOptions) == 0){ return null; }
    return $newOptions;
}