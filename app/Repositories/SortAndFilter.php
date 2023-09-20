<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Repositories\Contracts\SortAndFilterInterface;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;


class SortAndFilter implements SortAndFilterInterface
{
    protected null|string $search;

    protected array $orderBy = [
        'field' => null,
        'direction' => 'asc',
    ];

    protected array $filter = [
        'field' => null,
        'value' => null,
    ];

    protected $possiblyFilters = [
        'status',
        'priority',
    ];

    protected $possiblySorting = [
        'createdAt',
        'completedAt',
        'priority',
    ];

    protected $searchByFields = [
        'title',
    ];

    public function __construct(Request $request)
    {
        // get search value
        $this->search = $request->input('search');

        // get sorting by value
        $orderBy = str_replace('-', '', $request->input('sort'));
        if (in_array($orderBy, $this->possiblySorting)) {
            $this->orderBy['field'] = $orderBy;
            $this->orderBy['direction'] = $request->input('sort')[0] === '-' ? 'desc' : 'asc';
        }

        // get filter
        if (in_array($request->input('filter.name'), $this->possiblyFilters)) {
            $this->filter['field'] = $request->input('filter.name');
            $this->filter['value'] = $request->input('filter.value');
        }
    }

    public function applySearch(QueryBuilder $query): self
    {
        $query->when($this->search, function ($query) {
            foreach ($this->searchByFields as $field) {
                $query->where($field, 'like', '%' . $this->search . '%');
            }
        });

        return $this;
    }

    public function applySort(QueryBuilder $query): self
    {
        $query->when($this->orderBy['field'], fn ($query) => $query->orderBy($this->orderBy['field'], $this->orderBy['direction']));
   
        return $this;
    }

    public function applyFilter(QueryBuilder $query): self
    {
        $query->when($this->filter['field'], fn ($query) => $query->where($this->filter['field'], $this->filter['value']));

        return $this;
    }
}
