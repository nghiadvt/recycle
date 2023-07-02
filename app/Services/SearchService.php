<?php

namespace App\Services;

use App\Models\Area;

class SearchService
{
    /**
     * Method searchPlace
     *
     * @param string $query
     *
     * @return object
     */
    private function searchPlace(string $query): object
    {
        // Get all record with $query [limit defautl 10 record]
        return Area::where(function ($q) use ($query) {
            $q->where('address', 'like', '%' . $query . '%')
                ->orWhere('zip_no', 'like', '%' . $query . '%');
        })
            ->active()
            ->limit(config('define.limit.default'))
            ->select(Area::COLUMNS)
            ->get();
    }

    /**
     * Method search areas
     *
     * @param string $query
     *
     * @return object
     */
    private function searchArea(string $query): object
    {
        // Call method searchPlace to get all record with $query [limit defautl 10 record]
        $areas = $this->searchPlace($query);

        // Retrieve the first 10 records if no matching records are found.
        if ($areas->count() === 0) {
            $areas = Area::active()
                ->select(Area::COLUMNS)
                ->limit(config('define.limit.default'))
                ->get();
        }

        return $areas;
    }

    /**
     * Search by q with type
     *
     * @param array $data [q:string, type:string]
     *
     * @return mixed
     */
    public function getData($data): mixed
    {
        $query = '';
        if (array_key_exists('q', $data)) {
            if ($data['q']) {
                $query = $data['q'];
            }
        }
        $type = $data['type'];

        switch ($type) {
            case 'place':
                return $this->searchPlace($query);
            case 'area':
                return $this->searchArea($query);
            default:
                return null;
        }
    }
}
