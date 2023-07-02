<?php

namespace App\Services;

use App\Models\ServiceGarbage;
use App\Models\GarbageType;

class InformationService
{
    /**
     * Use recursion to create a garbage tree.
     *
     * @param array $serviceGarbages
     * @param int $parent_id
     *
     * @return array
     */
    function gabageTree(object|array $serviceGarbages, int $parent_id = null): array
    {
        $garbageTree = [];
        foreach ($serviceGarbages as $serviceGarbage) {
            if ($serviceGarbage->parent_id == $parent_id) {
                $serviceGarbage->children = $this->gabageTree($serviceGarbages, $serviceGarbage->id);
                $garbageTree[] = $serviceGarbage;
            }
        }
        return $garbageTree;
    }

    /**
     * Method getScheduleWithArea
     *
     * @return array
     */
    public function getCategoryServiceGarbages(): array
    {
        // Call gabageTree() to create garbageTree
        $serviceGarbages = ServiceGarbage::select(ServiceGarbage::COLUMNS_SERVICE_GARBAGES)
            ->active()
            ->get();

        return $this->gabageTree($serviceGarbages);
    }

    /**
     * Method getServiceGarbages get garbageServices sorted by name
     *
     * @return object
     */
    public function getServiceGarbages(): object
    {
        $serviceGarbages = ServiceGarbage::select(ServiceGarbage::COLUMNS_SERVICE_GARBAGES)
            ->active()
            ->orderby('name', 'asc')
            ->get();

        //filter out records at the last level according to their parent_id.
        return $serviceGarbages->filter(function ($item) use ($serviceGarbages) {
            return !$serviceGarbages->contains('parent_id', $item['id']);
        })->values();
    }

    /**
     * Method get a item ServiceGarbage with $id
     *
     * @param int $id
     *
     * @return object
     */
    public function getServiceGarbage(int $id): object
    {
        return ServiceGarbage::where('id', $id)
            ->withServiceType()
            ->select(ServiceGarbage::COLUMNS_SERVICE_GARBAGE)
            ->get();
    }

    /**
     * Method get all items garbageTypes
     *
     * @return object
     */
    public function getGarbagetypes(): object
    {
        return GarbageType::select(GarbageType::COLUMNS)->get();
    }
}
