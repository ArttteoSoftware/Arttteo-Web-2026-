<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category?->value,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image ? url('storage/' . $this->image) : null,
            'video' => $this->video ? url('storage/' . $this->video) : null,
            'sections' => $this->whenLoaded('sections', fn() => $this->sections->map(fn($section) => [
                'id' => $section->id,
                'name' => $section->name,
                'title' => $section->title,
                'description' => $section->description,
                'image' => $section->image ? url('storage/' . $section->image) : null,
                'contents' => $section->contents->map(fn($content) => [
                    'id' => $content->id,
                    'category' => $content->category,
                    'title' => $content->title,
                    'description' => $content->description,
                    'image' => $content->image ? url('storage/' . $content->image) : null,
                    'items' => $content->items->map(fn($item) => [
                        'id' => $item->id,
                        'text' => $item->text,
                        'image' => $item->image ? url('storage/' . $item->image) : null,
                    ]),
                ]),
            ])),
            'faqs' => $this->whenLoaded('faqs', fn() => $this->faqs->map(fn($faq) => [
                'id' => $faq->id,
                'question' => $faq->question,
                'answer' => $faq->answer,
            ])),
        ];
    }
}
