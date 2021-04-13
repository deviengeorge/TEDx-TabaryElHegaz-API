<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $responsibilities = [];

        foreach ($this->responsibilities as $responsibility) {
            $responsibilities[] = $responsibility->content;
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'end_date' => $this->end_data->format('Y-m-d H:i:s'),
            'questions' => QuestionResource::collection($this->questions),
            'responsibilities' => $responsibilities,
        ];
    }
}
