<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerSortMacro();
    }

    private function registerSortMacro()
    {
        Collection::macro('sortByList', function (iterable $orderList, ?string $property = null) {
            return $this
                ->sortBy(function($item) use ($property, $orderList) {
                    $value = $item;

                    if (is_iterable($item)) {
                        $value = $item[$property];
                    }

                    if (is_object($item)) {
                        $value = $item->$property;
                    }

                    $position = array_search($value, collect($orderList)->values()->toArray(), true);

                    return $position !== false ? $position : INF;
                });
        });

        Collection::macro('sortKeyByList', function (iterable $orderList) {
            return $this
                ->sortBy(function($item, $key) use ($orderList) {
                    $position = array_search($key, collect($orderList)->values()->toArray(), true);

                    return $position !== false ? $position : INF;
                });
        });
    }
}
