<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Filament\Resources\FaqResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

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
        return [
            'all' => Tab::make('All'),

            'xr-training-systems' => Tab::make('XR Training Systems')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('page', 'XR Training Systems')),

            'workforce-intelligence' => Tab::make('Workforce Intelligence')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('page', 'Workforce Intelligence')),

            'regulated-training-systems' => Tab::make('Regulated Training Systems')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('page', 'Regulated Training Systems')),

            'operational-simulation-digital-twins' => Tab::make('Operational Simulation Digital Twins')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('page', 'Operational Simulation Digital Twins')),
        ];
    }
}
