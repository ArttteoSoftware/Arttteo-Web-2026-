<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company_name' => $this->company_name,
            'project_name' => $this->project_name,
            'main_picture' => $this->main_picture ? url('storage/' . $this->main_picture) : null,
            'duration' => $this->duration,
            'scope' => $this->scope,
            'team_size' => $this->team_size,
            'challenge' => $this->challenge,
            'solution' => $this->solution,
            'result' => $this->result,
            'images' => $this->images->map(function($img) {
                return [
                    'id' => $img->id,
                    'image' => $img->image ? url('storage/' . $img->image) : null,
                ];
            }),
            'engagements' => $this->engagements->map(function($eng) {
                return [
                    'id' => $eng->id,
                    'title' => $eng->title,
                    'description' => $eng->description,
                    'picture' => $eng->picture ? url('storage/' . $eng->picture) : null,
                ];
            }),
            'quote_text' => $this->quote_text,
        ];
    }
}
