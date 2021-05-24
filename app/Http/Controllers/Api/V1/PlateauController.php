<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StorePlateauRequest;
use App\Http\Resources\PlateauResource;
use App\Repositories\PlateauRepository;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class PlateauController extends Controller
{
    private $plateauRepository;

    /**
     * PlateauController constructor.
     * @param PlateauRepository $plateauRepository
     */
    public function __construct(PlateauRepository $plateauRepository)
    {
        $this->plateauRepository = $plateauRepository;
    }

    /** @OA\Info(title="Mars Rover API", version="1.0") */

    /**
     * @OA\Post(
     *  path="/api/v1/plateau",
     *  @OA\RequestBody(@OA\MediaType(mediaType="application/json", @OA\Schema(
     *      @OA\Property(property="x", type="integer", example="", description="Horizontal Coordinate"),
     *    	@OA\Property(property="y",type="integer", example="", description="Vertical Coordinate"),),),),
     *  summary="Create an plateau",
     *  @OA\Response(response="201", description="Create Plateau Response")
     * )
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlateauRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePlateauRequest $request)
    {
        $validatedPlateauData = $request->validated();
        $status = $this->plateauRepository->create($validatedPlateauData);

        if($status != 'OK') {
            return response()->json($status, Response::HTTP_NOT_ACCEPTABLE);
        }

        return response()->json('OK', Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/plateau",
     *  summary="Get an plateau",
     *  @OA\Response(response="200", description="Show an Plateau Response")
     * )
     */

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $plateau = $this->plateauRepository->findById($id);

        return response()->json(PlateauResource::make(json_decode($plateau)));
    }
}
