<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\Excel\Excel;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Area extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Area::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];
    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['city'];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Name', 'name')->sortable(),
            DateTime::make('Created At', 'created_at')->sortable(),
            DateTime::make('Updated At', 'updated_at')->sortable(),
            BelongsTo::make('City', 'city')->sortable(),
            Number::make('City ID', 'city_id')->sortable(),
            HasMany::make('Addresses')->sortable(),
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
        return [
            new Filters\CityFilter,
        ];
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
        return [
            (new DownloadExcel)
                ->withHeadings()
                ->withWriterType(Excel::CSV)
                ->onSuccess(function (){
                    return Action::message("Export Successful!");
                })
                ->onFailure(function (){
                    return Action::danger("Could not export data");
                })
        ];
    }
}
