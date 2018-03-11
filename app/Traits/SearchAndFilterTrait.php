<?php

namespace App\Traits;

trait SearchAndFilterTrait
{
    public function scopeSearch($query, $field, $value)
    {
        return $query->orWhere($field, 'like', "%{$value}%");
    }

    public function scopeSearchName($query, $name = '')
    {
        return $query->search('name', $name)->search('name_kh', $name);
    }

    public function scopeFilterName($query, $request)
    {
        return $query->searchName($request->get('name', ''));
    }

    public function scopeGetNamePageSort($query, $request)
    {
        $size = $request->get('size', '9');
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
