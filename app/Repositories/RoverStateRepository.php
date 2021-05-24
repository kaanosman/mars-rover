<?php


namespace App\Repositories;


use Illuminate\Support\Facades\Redis;

class RoverStateRepository
{
    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $roverState = Redis::get('rover_state_' . $id);

        return $roverState;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function move($data)
    {
        $roverId = $data['rover_id'];
        $commands = $data['commands'];

        $commandsArray = str_split($commands);

        $roverState = json_decode($this->findById($roverId), true);

        foreach ($commandsArray as $command) {
            if ($command == 'M') {
                $roverState = $this->forward($roverState);
            } elseif ($command == 'L' || $command == 'R') {
                $roverState = $this->rotate($roverState, $command);
            }
        }

        Redis::set('rover_state_' . $roverId, json_encode($roverState));

        return $roverState;
    }

    /**
     * @param $roverState
     * @param $direction
     * @return mixed
     */
    public function rotate($roverState, $direction)
    {
        $currentDirection = $roverState['direction'];

        $leftRotateArray = ['N' => 'W', 'S' => 'E', 'E' => 'N', 'W' => 'S'];
        $rightRotateArray = ['N' => 'E', 'S' => 'W', 'E' => 'S', 'W' => 'N'];

        if ($direction === 'L') {
            $roverState['direction'] = $leftRotateArray[$currentDirection];

            return $roverState;
        }

        $roverState['direction'] = $rightRotateArray[$currentDirection];

        return $roverState;
    }

    /**
     * @param $roverState
     * @return mixed
     */
    public function forward($roverState)
    {
        switch ($roverState['direction']) {
            case 'N':
                $roverState['y'] += 1;
                break;
            case 'S':
                $roverState['y'] -= 1;
                break;
            case 'E':
                $roverState['x'] += 1;
                break;
            case 'W':
                $roverState['x'] -= 1;
                break;
        }

        return $roverState;
    }
}
