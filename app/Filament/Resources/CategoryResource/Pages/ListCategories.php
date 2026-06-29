<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    $data['type'] ??= $this->activeTab === 'blogs' ? 'post' : 'portfolio';

                    return $data;
                }),
        ];
    }

    public function getTabs(): array
    {
        return [
            'portfolios' => Tab::make('Portfolios')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'portfolio')),
            'blogs' => Tab::make('Blogs')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'post')),
        ];
    }
}
