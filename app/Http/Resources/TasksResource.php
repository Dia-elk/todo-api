<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'task' => [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'priority' => $this->priority
            ],

            'creator' => [
                'name' => $this->creator->name,
            ]
        ];
    }
}
