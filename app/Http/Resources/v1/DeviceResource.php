<?php

namespace App\Http\Resources\v1;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'unique_info'=>$this->unique_info,
            'device_info'=> json_decode($this->device_info),
            'account'=> new AccountResource($this->user->account),
            'user'=> new UserResource($this->user),
            'stores'=> StoreResource::collection($this->user->account->stores),
        ];
    }
}
