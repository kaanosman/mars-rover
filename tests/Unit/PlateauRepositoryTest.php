<?php

namespace Tests\Unit;

use App\Repositories\PlateauRepository;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class PlateauRepositoryTest extends TestCase
{
    private $plateauRepository;

    public function setUp() :void
    {
        parent::setUp();
        $this->plateauRepository = new PlateauRepository();
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
        $plateauData = ['x' => 100, 'y' => 100];
        $status = $this->plateauRepository->create($plateauData);

        $this->assertEquals('OK', $status);
    }

    /**
     *
     * @return void
     */
    public function test_find_by_id()
    {
        $expectedPlateau = Redis::get('plateau_1');
        $plateau = $this->plateauRepository->findById(1);

        $this->assertEquals($expectedPlateau, $plateau);
    }

    /**
     *
     * @return void
     */
    public function test_get_plateau_id()
    {
        $plateauCount = Redis::get('plateau_count');
        $plateauId = $this->plateauRepository->getPlateauId();

        $this->assertEquals($plateauCount + 1, $plateauId);
    }
}
