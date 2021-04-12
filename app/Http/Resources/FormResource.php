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

        $requirements = [];
        $responsibilities = [];
        foreach ($this->requirements as $requirement) {
            $requirements[] = $requirement->content;
        }

        foreach ($this->responsibilities as $responsibility) {
            $responsibilities[] = $responsibility->content;
        }
        return [
            'id' => $this->id,
            'questions' => QuestionResource::collection($this->questions),
            'requirements' => $requirements,
            'responsibilities' => $responsibilities,
        ];
    }
}
