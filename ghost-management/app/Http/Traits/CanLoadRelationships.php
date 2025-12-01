<?php

namespace App\Http\Traits;

use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait CanLoadRelationships
{
    //to remind ? before a parameter make it optional
    public function loadRelationships(
        Model | EloquentBuilder | QueryBuilder | HasMany $for,
        ?array $relations = null
    ): Model | EloquentBuilder | QueryBuilder | HasMany {
        //if left argument is null, it will go on to the next one to the right, if that one is null it will take the last
        $relations = $relations ?? $this->relations ?? [];

        foreach ($relations as $relation) {
            $for -> when(
                $this->shouldIncludeRelation($relation),
                fn ($addToQuery) => $for instanceof Model ?
                $for -> load($relation) :
                $addToQuery -> with($relation)
            );
        }
        return $for;
    }
}
