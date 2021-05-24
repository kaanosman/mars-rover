<?php


namespace App\Repositories;


use Illuminate\Support\Facades\Redis;

class PlateauRepository
{
    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $plateauId = $this->getPlateauId();

        return  Redis::set('plateau_' . $plateauId, json_encode($data));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $plateau = Redis::get('plateau_' . $id);

        return $plateau;
    }

    /**
     * @return mixed
     */
    public function getPlateauId()
    {
        if(!Redis::exists('plateau_count')) {
            Redis::set('plateau_count', 0);
        }

        return Redis::incr('plateau_count');
	 }
}


