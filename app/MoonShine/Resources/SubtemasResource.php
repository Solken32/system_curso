<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subtemas;
use App\Models\Temas;
use Illuminate\Support\Facades\Request;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use MoonShine\Fields\Select;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

/**
 * @extends ModelResource<Subtemas>
 */
class SubtemasResource extends ModelResource
{
    protected string $model = Subtemas::class;

    protected string $title = 'SubTemas InnovaSoft';

    protected bool $createInModal = True; 
 
    protected bool $editInModal = True; 
 
    protected bool $detailInModal = false;
    
    public function redirectAfterSave(): string
    {
        $referer = Request::header('referer'); 
        return $referer ?: '/';
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Select::make('Elige el tema', 'tema_id')  // Campo para seleccionar el tema
                ->options(Temas::all()->pluck('titulo', 'id')->toArray())  // Obtén todos los temas y sus títulos
                ->required(),  // Hazlo obligatorio si es necesario
                Text::make('titulo'),
                Text::make('descripcion'),
                Image::make('imagen')->disk('public') ,
                Text::make('video'),
            ]),
        ];
    }

    /**
     * @param Subtemas $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
