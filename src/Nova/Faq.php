<?php

namespace App\Nova;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;

class Faq extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'OpenHaus\LaravelEasyFaq\Models\Faq';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'question';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'question',
        'answer',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $categories = array_combine(range(1,3), range(1,3));
        array_walk($categories, function(&$item, $key) {
            $item = trans_choice('laravel-easy-faq::faq.categories', $key);
        });

        return [
            ID::make('ID')->sortable(),

            Text::make('Question')
                ->displayUsing(function ($q) {
                    return Str::limit($q);
                })
                ->sortable()
                ->rules('required', 'max:255'),

            Trix::make('Answer')
                ->withFiles('public'),

            Select::make('Category', 'faq_category_id')
                ->options($categories)
                ->displayUsingLabels()
                ->sortable(),

            Number::make('Likes')
                ->min(0)
                ->step(1)
                ->sortable(),

            Number::make('Dislikes')
                ->min(0)
                ->step(1)
                ->sortable(),

            Boolean::make('Is Public')
                ->trueValue(1)
                ->falseValue(0)
                ->hideFromIndex()
                ->sortable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
