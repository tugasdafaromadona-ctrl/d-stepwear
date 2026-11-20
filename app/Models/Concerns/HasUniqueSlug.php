<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasUniqueSlug
{
    protected static function bootHasUniqueSlug(): void
    {
        static::saving(function ($model) {
            if ($model->isDirty('name') || empty($model->slug)) {
                $base = Str::slug($model->name) ?: 'item';
                $slug = $base;
                $i = 2;

                while (
                    static::where('slug', $slug)
                        ->when($model->exists, fn ($q) => $q->whereKeyNot($model->getKey()))
                        ->exists()
                ) {
                    $slug = $base.'-'.$i++;
                }

                $model->slug = $slug;
            }
        });
    }
}
