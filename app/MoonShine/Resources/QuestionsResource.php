<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Questions;
use App\Models\quizzes;
use App\Models\Temas;
use Illuminate\Support\Facades\Request;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;

/**
 * @extends ModelResource<Questions>
 */
class QuestionsResource extends ModelResource
{
    protected string $model = Questions::class;

    protected string $title = 'Questions';

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
                Select::make('Elige el quizz', 'quiz_id')
                ->options(quizzes::all()->pluck('titulo', 'id')->toArray())  // Obtén todos los temas y sus títulos
                ->required(),  // Hazlo obligatorio si es necesario
                Text::make('Pregunta'),
            ]),
        ];
    }

    /**
     * @param Questions $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
