<?php

#Namespace
namespace Util;

$orderType = [
    'M_ASC' => [
        "type" => 'ASC',
        "field" => 'v.model'
    ],
    'M_DESC' => [
        "type" => 'DESC',
        "field" => 'v.model'
    ],
    'P_ASC' => [
        "type" => 'ASC',
        "field" => 'price'
    ],
    'P_DESC' => [
        "type" => 'DESC',
        "field" => 'price'
    ],
];


#   @var array $options =
#           $word : string
#           $mark : int
#           $fuel : string
#           $type : string
#
#   @return string
function get_where(array $options) : string
{
    $where = '';

    if(count($options) > 0){ $index = 0; }

    foreach ($options as $option) {
            # If this position is equal to 0(zero), then a 'WHERE' is added
            if($index == 0){ $where .= "WHERE "; }
            
            $where .= $option['table']." ".$option['equal']." ".$option['value'];
            
            # If this position isn't the last, then an 'AND' is added
            if($index < (count($options) - 1)){ $where .= " AND "; }
            
            # Index is equal to index + 1
            $index++;
    }

    //var_dump($where);
    //exit();
    return $where;
}   

function get_join(array $options){

}

function get_order(string $option) : string
{
    return 'ORDER BY '.$option["field"].' '.$option["type"];
}

function get_pagination(int $offset ,int $limit) : string
{
    return 'LIMIT '.$limit.' OFFSET '.$offset;
}
