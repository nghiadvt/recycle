<?php

namespace App\Traits;

trait ResultPaginateTrait
{
    /**
     * Return a customized [object] when using paginate"
     *
     * @param [array] $data
     * @return [object] {data[array], total_item[integer], total_page[integer], current_page[integer]}
     */
    public function resultCustomizePaginate($data = [])
    {
        return [
            'total_page' => $data['last_page'],
            'data' => $data['data'],
            'total_item' => $data['total'],
            'current_page' => $data['current_page'],
        ];
    }
}
