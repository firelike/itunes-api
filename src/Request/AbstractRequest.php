<?php
namespace Firelike\ITunes\Request;


abstract class AbstractRequest
{

    const SORT_ORDER_ASC = 'ASC';
    const SORT_ORDER_DESC = 'DESC';

    public function toArray()
    {
        return [];
    }
}