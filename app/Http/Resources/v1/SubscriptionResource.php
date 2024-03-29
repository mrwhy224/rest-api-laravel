<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id'=>$this->id,
            'type'=>$this->type,
            'period'=>$this->period,
            'remaining_time'=>$this->remaining_time,
            'subscription_info'=>json_decode($this->subscription_info),
            'is_active'=>$this->is_active,
        ];
    }
}
