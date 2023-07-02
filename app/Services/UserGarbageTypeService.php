<?php

namespace App\Services;

use App\Models\Account;
use App\Models\UserGarbageType;
use App\Traits\ResultPaginateTrait;

class UserGarbageTypeService
{
    use ResultPaginateTrait;

    protected $model;

    /**
     * Constructor for initializing the model object.
     *
     * @param UserGarbageType $userGarbageType The UserGarbageType object to be assigned to the $model property.
     */
    public function __construct(UserGarbageType $userGarbageType)
    {
        $this->model = $userGarbageType;
    }

    /**
     * store function
     *
     * @param array $data Data for create the UserGarbageType
     * @return mixed The create user_garbage_types object
     */
    public function store($data)
    {
        foreach ($data as $userGarbageType) {
            $userGarbage = new $this->model();
            $userGarbage->account_id = $userGarbageType['account_id'];
            $userGarbage->garbage_type_id = $userGarbageType['garbage_type_id'];
            $userGarbage->weight = $userGarbageType['weight'];
            $userGarbage->save();
        }
        return $this->get(config('define.paginate.default'));
    }

    /**
     * get function
     *
     * @param int $limit
     * @return array
     */
    public function get($limit)
    {
        $userGarbageType = $this->model
            ->with('account:id,name')
            ->with('garbage_type:id,name')
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->toArray();

        return $this->resultCustomizePaginate($userGarbageType);
    }

    /**
     * method show
     *
     * @param int $id
     * @return mixed
     */
    public function show($id)
    {
        $userGarbages = $this->model
            ->select()
            ->where('account_id', $id)
            ->with('account:id,name')
            ->with('garbage_type:id,name')
            ->get()
            ->toArray();

        return $userGarbages;
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @param int $id
     * @return array
     */
    public function update($data, $id)
    {
        $account = Account::find($id);
        $garbageTypes = [];
        foreach ($data as $item) {
            $garbageTypes[$item['garbage_type_id']] = ['weight' => $item['weight']];
        }
        $account->garbageTypes()->sync($garbageTypes);

        return $this->get(config('define.paginate.default'));
    }
}
