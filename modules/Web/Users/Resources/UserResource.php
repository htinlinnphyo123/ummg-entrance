<?php

namespace BasicDashboard\Web\Users\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        $this->profile_photo ??= "/Default/default_profile_pic.jpg";
        return [
            "id" => customEncoder($this->id),
            "name" => $this->name,
            "email" => $this->email,
            "status" => $this->status,
        ];
    }
}