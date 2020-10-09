<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class commentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return[
            'comment_id' =>$this->comment_id,
            'user_comment'=>$this->user_comment,
            'comment'=>$this->comment,
            'comment_created_at' =>$this->comment_created_at,
        ];
    }
}
