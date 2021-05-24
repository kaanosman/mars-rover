<?php

namespace Tests\Unit;

use Illuminate\Http\Response;
use Tests\TestCase;

class RoverControllerTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function test_store_rover()
    {
        $roverData = ['x' => '0', 'y' => '0', 'direction' => 'N', 'plateau_id' => 1];

        $this->postJson('api/v1/rover', $roverData)
            ->assertStatus(Response::HTTP_CREATED);
    }

    /**
     *
     * @return void
     */
    public function test_get_rover()
    {
        $this->getJson('api/v1/rover/1')
            ->assertStatus(Response::HTTP_OK);
    }
}
