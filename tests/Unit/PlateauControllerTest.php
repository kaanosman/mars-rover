<?php

namespace Tests\Unit;

use Illuminate\Http\Response;
use Tests\TestCase;

class PlateauControllerTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function test_store_plateau()
    {
        $this->postJson('api/v1/plateau', ['x' => '0', 'y' => '0'])
            ->assertStatus(Response::HTTP_CREATED);
    }

    /**
     *
     * @return void
     */
    public function test_get_plateau()
    {
        $this->getJson('api/v1/plateau/1')
            ->assertStatus(Response::HTTP_OK);
    }

}
