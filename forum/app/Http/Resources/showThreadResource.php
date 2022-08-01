<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class showThreadResource extends JsonResource
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
            'channel_name' => $this->channel->name,
            'title' => $this->tile,
            'body' => $this->body,
            'replies_count' => $this->replies_count,
            'replies' => $this->replies
        ];
    }
}
