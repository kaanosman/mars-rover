<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreRoverRequest;
use App\Http\Resources\RoverResource;
use App\Repositories\RoverRepository;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class RoverController extends Controller
{
    /**
     * @OA\Post(
     *  path="/api/v1/rover",
     *  summary="Create an rover",
     *  @OA\RequestBody(@OA\MediaType(mediaType="application/json", @OA\Schema(
     *      @OA\Property(property="plateau_id", type="integer", example="", description="Plateau"),
     *    	@OA\Property(property="x",type="integer", example="", description="Horizontal Coordinate"),
     *    	@OA\Property(property="y",type="integer", example="", description="Vertical Coordinate"),
     *    	@OA\Property(property="direction",type="string", example="", description="Direction"),),),),
     *  @OA\Response(response="201", description="Create Rover Response")
     * )
     */

    private $roverRepository;

    /**
     * PlateauController constructor.
     * @param RoverRepository $roverRepository
     */
    public function __construct(RoverRepository $roverRepository)
    {
        $this->roverRepository = $roverRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoverRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRoverRequest $request)
    {
        $validatedRoverData = $request->validated();

        $status = $this->roverRepository->create($validatedRoverData);

        if($status != 'OK') {
            return response()->json($status, Response::HTTP_NOT_ACCEPTABLE);
        }

        return response()->json('OK',Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/rover",
     *  summary="Get an rover",
     *  @OA\Response(response="200", description="Show an Rover Response")
     * )
     */

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $rover = $this->roverRepository->findById($id);

        return response()->json(RoverResource::make(json_decode($rover)));
    }
}
