<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;

interface SortAndFilterInterface
{
    public function applySearch(QueryBuilder $query): self;

    public function applySort(QueryBuilder $query): self;

    public function applyFilter(QueryBuilder $query): self;
}