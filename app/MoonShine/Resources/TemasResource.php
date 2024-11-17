<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Temas;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\File;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image; 

use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

/**
 * @extends ModelResource<Temas>
 */
class TemasResource extends ModelResource
{
    protected string $model = Temas::class;

    protected string $title = 'Temas InnovaSoft';

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
                Text::make("titulo"),
                Text::make("descripcion"),
                Image::make("imagen")->disk('public'),
            ]),
        ];
    }

    /**
     * @param Temas $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
