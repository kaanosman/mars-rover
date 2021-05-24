<?php


namespace App\Repositories;


use Illuminate\Support\Facades\Redis;

class RoverRepository
{
    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $roverId = $this->getRoverId();
        Redis::set('rover_' . $roverId, json_encode($data));

        unset($data['plateau_id']);
        return Redis::set('rover_state_' . $roverId, json_encode($data));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $rover = Redis::get('rover_' . $id);

        return $rover;
    }

    /**
     * @return mixed
     */
    public function getRoverId()
    {
        if(!Redis::exists('rover_count')) {
            Redis::set('rover_count', 0);
        }

        return Redis::incr('rover_count');
    }
}
