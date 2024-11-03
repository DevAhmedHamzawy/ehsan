<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionResource extends JsonResource
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
            'id' => $this->id,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'image' => $this->img_path,
            'name' => $this->name,
            'description' => $this->description,
            'prize' => $this->prize,
            'points' => $this->points,
            'min_ans' => $this->min_ans,
            'time_question_second' => $this->time_question_second,  
        ];
    }
}
