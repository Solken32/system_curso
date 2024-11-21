<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\OptionsResource;
use App\MoonShine\Resources\QuestionsResource;
use App\MoonShine\Resources\QuizzesResource;
use App\MoonShine\Resources\SubtemasResource;
use App\MoonShine\Resources\TemasResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;
use MoonShine\Commands\MakePageCommand;
use MoonShine\Components\Url;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.admins_title'),
                    new MoonShineUserResource()
                ),
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.role_title'),
                    new MoonShineUserRoleResource()
                ),
            ]),

            MenuItem::make("Temas", new TemasResource),
            MenuItem::make("Subtemas", new SubtemasResource),
            
            MenuGroup::make("Quizzes", [
                MenuItem::make("Quizz", new QuizzesResource),
                MenuItem::make("Preguntas", new QuestionsResource),
                MenuItem::make("Opciones", new OptionsResource),
            ]),

            MenuItem::make("Ir al Inicio" , url("/")),
            
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
