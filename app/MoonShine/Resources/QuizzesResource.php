<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;
use Illuminate\Support\Facades\Request;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quizzes;
use App\Models\Temas;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;

/**
 * @extends ModelResource<Quizzes>
 */
class QuizzesResource extends ModelResource
{
    protected string $model = Quizzes::class;

    protected string $title = 'Quizzes';

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
                Select::make('Elige el tema', 'tema_id')
                ->options(Temas::all()->pluck('titulo', 'id')->toArray())  // Obtén todos los temas y sus títulos
                ->required(),  // Hazlo obligatorio si es necesario
                Text::make('titulo'),
                Text::make('descripcion'),
            ]),
        ];
    }

    /**
     * @param Quizzes $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
