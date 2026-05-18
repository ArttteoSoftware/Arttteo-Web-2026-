<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Filament\Resources\FaqResource;
use App\Models\Page;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ListFaqs extends ListRecords
{
    protected static string $resource = FaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = ['all' => Tab::make('All')];

        Page::orderBy('ordering')->get()->each(function (Page $page) use (&$tabs) {
            $tabs[Str::slug($page->name)] = Tab::make($page->name)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('page_id', $page->id));
        });

        return $tabs;
    }
}
