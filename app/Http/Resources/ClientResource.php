<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'id'=> $this->id,
          'name'=> $this->name,
          'company'=> $this->company,
          'email'=> $this->email,
          'phone'=> $this->phone,
          'source'=> $this->source,
          'notes'=> $this->notes,
          'meta'=> $this->meta,
          'owner'=> $this->whenLoaded('owner'),
          'created_at'=> $this->created_at,
          'updated_at'=> $this->updated_at,

        ];
    }
}
