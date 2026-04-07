<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $paragraphTitles = [];
        if (is_array($this->content)) {
            foreach ($this->content as $block) {
                if (($block['type'] ?? '') === 'paragraph' && !empty($block['data']['title'])) {
                    $paragraphTitles[] = $block['data']['title'];
                }
            }
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image ? url('storage/' . $this->image) : null,
            'content' => $this->content,
            'paragraph_titles' => $paragraphTitles,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
