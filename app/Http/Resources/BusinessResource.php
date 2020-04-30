<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
{
    
    public function toArray($request)
    {
        
        return [
            'id' => $this->id,
            'business_name' => $this->business_name,
            'address' => $this->address,
            'file' => $this->file,
            'short_name' => $this->short_name,
        ];

    }

}
