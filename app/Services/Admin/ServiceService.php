<?php

namespace App\Services\Admin;

use App\Models\Service;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Traits\ResultPaginateTrait;

class ServiceService
{
    use ResultPaginateTrait;

    protected $model;

    /**
     * Constructor for initializing the model object.
     *
     * @param Service $service The Service object to be assigned to the $model property.
     */
    public function __construct(Service $service)
    {
        $this->model = $service;
    }

    /**
     * processData
     *
     * @param array $data
     * @return array
     */
    protected function processData($data)
    {
        $serviceBuilder = $this->model->where('title', $data['title'])->orderBy('id', 'desc');
        $prefixId = '';
        if ($serviceBuilder->exists()) {
            $lastedServiceByTitle = $serviceBuilder->first();
            $prefixId = "-" . $lastedServiceByTitle->id;
        }
        $data['slug'] = Str::slug($data['title']) . $prefixId;

        return $data;
    }

    /**
     * store function
     *
     * @param array $data Data for create the service
     * @return mixed The create service object
     */
    public function store(array $data)
    {
        $this->model->create($this->processData($data));

        return $this->get(config('define.paginate.default'));
    }

    /**
     * get
     *
     * @param string $limit
     * @return mixed
     */
    public function get($limit)
    {
        $services = $this->model
            ->orderBy('id', 'DESC')
            ->paginate($limit)
            ->toArray();
        return  $this->resultCustomizePaginate($services);
    }

    /**
     * Update a service
     *
     * @param array $data Data for updating the service
     * @param int $id ID of the service  to be updated
     * @return mixed The updated service  object
     */
    public function update($data, $id)
    {
        $service = $this->model->find($id);
        if ($service) {
            // Prevent from going into observer
            $service->withoutEvents(function () use ($service, $data) {
                if ($service->title == $data['title']) {
                    $service->update($data);
                } else {
                    $service->update($this->processData($data));
                }
            });
            return $this->get(config('define.paginate.default'));
        }
        return null;
    }

    /**
     *  Update a service image record in the database with the given data and ID.
     *
     * @param int $id
     * @param array $data
     *
     * @return mixed
     */
    public function updateImageService($id, $data)
    {
        $service = $this->model->find($id);

        if ($service) {
            if (!array_key_exists('image_url', $data)) {
                deleteImage(Service::IMAGE_URL_DIRECTORY . '/' . $service->image_url);
                $service->update(
                    ['image_url' => null]
                );
            } else {
                // If image = true, Update image in observe
                $service->update(
                    $data
                );
            }
            return $this->get(config('define.paginate.default'));
        }
        return null;
    }
}
