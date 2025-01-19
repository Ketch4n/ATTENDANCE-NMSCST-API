<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'email'=> $this->email,
            'course'=> $this->course_id,
            'section'=> $this->section,
            'semester'=> $this->semester_id,
            'school_year'=> $this->school_year,
            'id_number'=> $this->bdate,
            'contact_number'=> $this->address,
            'role'=> $this->role,
            'status'=> $this->status,
           
        ];
    }
}
