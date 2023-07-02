<?php

namespace App\Services\Admin;

use App\Models\Language;

class LanguageService
{
    protected $model;

    /**
     * Constructor function for the LanguageService class.
     *
     * @param Model Language model instance to be used by the service.
     */
    public function __construct(Language $model)
    {
        $this->model = $model;
    }

    /**
     * Use the method of the "Language" model to get all the record
     *
     * @param array $columns
     * @return array
     */
    public function getLanguages($columns = [])
    {
        $defaultColumns = Language::COLUMNS;

        // Select columns in $columns if they exist in $defaultColumns
        $selectedColumns = array_intersect($columns, $defaultColumns);

        return $this->model->select($selectedColumns ?: $defaultColumns)->get();
    }

    /**
     * Use the "create" method of the "Language" model to create a record with $data
     * from 'store' method in LanguageController
     *
     * @param array $data
     * @return array
     */
    public function addLanguage($data)
    {
        $this->model->create($data);

        return $this->getLanguages();
    }

    /**
     * Update a Language record in the database with the given data and ID.
     *
     * @param array $data from "update" method in LanguageController
     * @param int $id from "update" method in LanguageController
     * @return object
     */
    public function updateLanguage($id, $data)
    {
        // Search for a language with ID.
        $language = $this->model->findOrFail($id);

        if ($language->update($data)) {
            return $this->getLanguages();
        }
    }
}
