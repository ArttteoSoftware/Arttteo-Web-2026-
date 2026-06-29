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
        $paragraphTopics = [];
        if (is_array($this->content)) {
            foreach ($this->content as $block) {
                if (($block['type'] ?? '') === 'paragraph' && !empty($block['data']['topic'])) {
                    $paragraphTopics[] = $block['data']['topic'];
                }
            }
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category ? [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ] : null,
            'image' => $this->image ? url('storage/' . $this->image) : null,
            'content' => $this->content,
            'paragraph_topics' => $paragraphTopics,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
