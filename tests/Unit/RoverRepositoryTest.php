<?php

namespace Tests\Unit;

use App\Repositories\RoverRepository;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class RoverRepositoryTest extends TestCase
{
    private $roverRepository;

    public function setUp() :void
    {
        parent::setUp();
        $this->roverRepository = new RoverRepository();
    }

    public function tearDown() :void
    {
        parent::tearDown();
    }

    /**
     *
     * @return void
     */
    public function test_create()
    {
        $roverData = ['plateau_id' => 1, 'x' => 100, 'y' => 100, 'direction' => 'N'];
        $status = $this->roverRepository->create($roverData);

        $this->assertEquals('OK', $status);
    }

    /**
     *
     * @return void
     */
    public function test_find_by_id()
    {
        $expectedRover = Redis::get('rover_1');

        $rover = $this->roverRepository->findById(1);

        $this->assertEquals($expectedRover, $rover);
    }

    /**
     *
     * @return void
     */
    public function test_get_rover_id()
    {
        $roverCount = Redis::get('rover_count');
        $roverId = $this->roverRepository->getRoverId();

        $this->assertEquals($roverCount + 1, $roverId);
    }
}
