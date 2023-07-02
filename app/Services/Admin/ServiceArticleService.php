<?php

namespace App\Services\Admin;

use App\Models\ServiceArticle;
use Illuminate\Support\Str;
use App\Traits\ResultPaginateTrait;

class ServiceArticleService
{
    use ResultPaginateTrait;

    protected $model;

    /**
     * Constructor for initializing the model object.
     *
     * @param ServiceArticle $serviceArticle The ServiceArticle object to be assigned to the $model property.
     */
    public function __construct(ServiceArticle $serviceArticle)
    {
        $this->model = $serviceArticle;
    }

    /**
     * Generate a slug from the title and the latest article with the same title
     *
     * @param array $data - The data to be processed
     * @return array - The processed data with a generated slug
     */
    protected function processData($data)
    {
        // Query the latest article with the same title and get its ID
        $articleBuilder = $this->model->where('title', $data['title'])->orderBy('id', 'desc');
        $prefixId = '';
        if ($articleBuilder->exists()) {
            $lastedArticleByTitle = $articleBuilder->first();
            $prefixId = "-" . $lastedArticleByTitle->id;
        }

        // Generate the slug by appending the prefix ID to the slugified title
        $data['slug'] = Str::slug($data['title']) . $prefixId;

        return $data;
    }

    /**
     * store function
     *
     * @param array $data Data for create the service article
     * @return mixed The create service article object
     */
    public function store($data)
    {
        $isStore = $this->model->create($this->processData($data));
        if ($isStore) {
            return $this->get(config('define.paginate.default'));
        }
        return null;
    }

    /**
     * get
     *
     * @param string $limit
     * @return mixed
     */
    public function get($limit)
    {
        $columns = ServiceArticle::COLUMNS;
        $serviceArticle = $this->model
            ->select($columns)
            ->with('services_category:id,title')
            ->with('services:id,title')
            ->orderBy('id', 'DESC')
            ->paginate($limit)
            ->toArray();

        return  $this->resultCustomizePaginate($serviceArticle);
    }

    /**
     * Update a service article
     *
     * @param array $data Data for updating the service article
     * @param int $id ID of the service article to be updated
     * @return mixed The updated service article object
     */
    public function update($data, $id)
    {
        $serviceArticle = $this->model->find($id);
        if ($serviceArticle->title == $data['title']) {
            $serviceArticle->update($data);

            return $this->get(config('define.paginate.default'));
        }
        $serviceArticle->update($this->processData($data));

        return $this->get(config('define.paginate.default'));
    }
}
