<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CandidatureResource extends JsonResource
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
            "id"           => $this->id,
            "pays"         => $this->pays,
            "candidat"     => $this->user,
            "status"       => $this->status,
            "acceptedBy"   => $this->acceptedBy,
            "edition"      => $this->edition,
            "lien_rx"      => $this->lien_rx,
            "images_activity"      => $this->getMedia('images_activity'),
        ];
    }
}
