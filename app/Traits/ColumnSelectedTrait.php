<?php

namespace App\Traits;

trait ColumnSelectedTrait
{
    /**
     * Return an array of columns to query
     *
     * @param [object] $request
     * @return array
     */
    public function columnSelected($request)
    {
        return $request->has('columns') ? explode(',', $request->input('columns')) : [];
    }
}
