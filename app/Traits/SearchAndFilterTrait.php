<?php

namespace App\Traits;

trait SearchAndFilterTrait
{
    public function scopeFilterName($query, $request)
    {
        if ($request->has('name')) {
            $name = $request->get('name');
            $query->where('name', 'like', "%{$name}%");
            $query->orWhere('name_kh', 'like', "%{$name}%");
        }
        return $query;
    }

    public function scopeSearchName($query, $name = '')
    {
        $query->where('name', 'like', "%{$name}%");
        $query->orWhere('name_kh', 'like', "%{$name}%");
        return $query;
    }

    public function scopeGetNamePageSort($query, $request)
    {
        $size = $request->get('size', '12');
        $sort = $request->get('sort', 'null');
        $desc = $request->get('desc', 'false');
        $filter = $request->get('filter', 'null');

        if ($sort === null || $sort == 'null') {
            $sort = 'id';
        }

        if ($desc == false || $desc == 'false') {
            $desc = 'asc';
        } else {
            $desc = 'desc';
        }

        if ($filter == null || $filter == 'null') {
            $filter = '';
        }

        return $query->searchName($filter)->orderBy($sort, $desc)->paginate($size);
    }
}
