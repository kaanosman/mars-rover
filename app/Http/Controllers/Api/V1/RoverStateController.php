<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\MoveRoverRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoverStateResource;
use App\Repositories\RoverStateRepository;

class RoverStateController extends Controller
{
    /**
     * @OA\Post(
     *  path="/api/v1/rover-state",
     *  summary="Move an rover",
     *  @OA\RequestBody(@OA\MediaType(mediaType="application/json", @OA\Schema(
     *      @OA\Property(property="rover_id", type="integer", example="", description="Rover"),
     *    	@OA\Property(property="commands",type="string", example="", description="Commands"),),),),
     *  @OA\Response(response="200", description="Move Rover Response")
     * )
     */

    private $roverStateRepository;

    /**
     * PlateauController constructor.
     * @param RoverStateRepository $roverStateRepository
     */
    public function __construct(RoverStateRepository $roverStateRepository)
    {
        $this->roverStateRepository = $roverStateRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MoveRoverRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function move(MoveRoverRequest $request)
    {
        $validatedRoverStateData = $request->validated();

        $roverState = $this->roverStateRepository->move($validatedRoverStateData);

        return response()->json(RoverStateResource::make((object)($roverState)));
    }

    /**
     * @OA\Get(
     *  path="/api/v1/rover-state",
     *  summary="Get an rover state",
     *  @OA\Response(response="200", description="Show an Rover State Response")
     * )
     */

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $roverState = $this->roverStateRepository->findById($id);

        return response()->json(RoverStateResource::make(json_decode($roverState)));
    }
}
