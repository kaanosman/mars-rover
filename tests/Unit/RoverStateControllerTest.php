<?php

namespace Tests\Unit;

use Illuminate\Http\Response;
use Tests\TestCase;


class RoverStateControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_rover_state()
    {
        $this->getJson('api/v1/rover-state/1')
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_move_rover()
    {
        $this->postJson('api/v1/rover-state', ['commands' => 'LMLMLMLMM', 'rover_id' => 1])
            ->assertStatus(Response::HTTP_OK);
    }
}
