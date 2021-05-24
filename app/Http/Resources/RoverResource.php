<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'plateau_id' => $this->plateau_id,
            'direction' => $this->direction,
            'x' => $this->x,
            'y' => $this->y,
        ];
    }
}
