<?php

namespace Tests\Unit;

use App\Repositories\RoverStateRepository;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class RoverStateRepositoryTest extends TestCase
{
    private $roverStateRepository;

    public function setUp() :void
    {
        parent::setUp();
        $this->roverStateRepository = new RoverStateRepository();
    }

    public function tearDown() :void
    {
        parent::tearDown();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_move()
    {
        $exampleData['rover_id'] = 1;
        $exampleData['commands'] = 'LMLMLMLMM';

        $currentRoverState = json_decode(Redis::get('rover_state_1'), true);
        $currentRoverState['y'] += 1;

        $roverState = $this->roverStateRepository->move($exampleData);

        $this->assertEquals($currentRoverState, $roverState);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_rotate()
    {
        $exampleRoverState = ['direction' => 'N', 'x' => 100, 'y' => 100];
        $expectedRoverState = ['direction' => 'W', 'x' => 100, 'y' => 100];

        $roverState = $this->roverStateRepository->rotate($exampleRoverState, 'L');

        $this->assertEquals($expectedRoverState, $roverState);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_forward()
    {
        $exampleRoverState = ['direction' => 'N', 'x' => 100, 'y' => 100];
        $expectedRoverState = ['direction' => 'N', 'x' => 100, 'y' => 101];

        $roverState = $this->roverStateRepository->forward($exampleRoverState);

        $this->assertEquals($expectedRoverState, $roverState);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_find_by_id()
    {
        $expectedRoverState = Redis::get('rover_state_1');

        $roverState = $this->roverStateRepository->findById(1);

        $this->assertEquals($expectedRoverState, $roverState);
    }
}
