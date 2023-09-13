<?php

#Namespace
namespace Util;


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
    $orderType = [
        'M-ASC' => 'ORDER BY v.model ASC',
        'M-DESC' => 'ORDER BY v.model DESC'
        // 'P-ASC' => 'ORDER BY v.price ASC',
        // 'P-DESC' => 'ORDER BY v.price DESC',
    ];

    if(!isset($orderType[$option])){ return ''; }
    return $orderType[$option];
}

function get_pagination(int $offset ,int $limit) : string
{
    return 'LIMIT '.$limit.' OFFSET '.$offset;
}
