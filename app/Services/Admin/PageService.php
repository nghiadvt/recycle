<?php

namespace App\Services\Admin;

use App\Models\Page;

class PageService
{
    protected $model;

    /**
     * Constructor function for the PageService class.
     *
     * @param Page $model
     */
    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    /**
     * get all data Term And Privacies
     *
     * @param array $columns
     * @param string $type
     *
     * @return object
     */
    public function getTermAndPrivacies(array $columns = [], string $type = null): object
    {
        $defaultColumns = $this->model::COLUMNS;

        // Select columns in $columns if they exist in $defaultColumns
        $selectedColumns = array_intersect($columns, $defaultColumns);
        $query = $this->model->select($selectedColumns ?: $defaultColumns);

        switch ($type) {
            case 'none':
                return $query->where('type', $this->model::NONE)
                    ->get();
            case 'term':
                return $query->where('type', $this->model::TERMS_OF_SERVICE)
                    ->get();
            case 'privacy':
                return $query->where('type', $this->model::PRIVACY_POLICY)
                    ->get();
            default:
                return $query->get();
        }
    }

    /**
     * Method addItem
     *
     * @param array $data
     *
     * @return object
     */
    public function addItem(array $data): object
    {
        $this->model->create($data);

        return $this->getTermAndPrivacies();
    }

    /**
     * Method update
     *
     * @param array $data
     *
     * @return object|bool
     */
    public function updateItem(int $id, array $data): object|bool
    {
        $termPrivacyItem = $this->model->find($id);

        if ($termPrivacyItem) {
            $termPrivacyItem->update($data);

            return $this->getTermAndPrivacies();
        }
        return false;
    }
}
