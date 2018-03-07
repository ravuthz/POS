<?php

namespace App\Traits;

trait CrudsModelTrait
{
    /**
     * Get validate rules
     */
    public function getValidateRules()
    {
        if (count($this->rules) <= 0) {
            return [];
        }
        $search = [',{id}'];
        $replace = $this->id ? [',' . $this->id] : [''];
        foreach ($this->rules as $k => $rules) {
            $this->rules[$k] = str_replace($search, $replace, $rules);
        }

        // dd($this->rules);
        return $this->rules;
    }

    /**
     * Get only validate rules for create action
     * @return validation rules
     */
    public function getCreateRules()
    {
        if (isset($this->createRules)) {
            $this->rules = $this->createRules;
        }

        if (isset($this->rules) && $this->rules == null) {
            $this->rules = [];
        }

        return $this->getValidateRules();
    }

    /**
     * Get only validate rules for update action
     * @return validation rules
     */
    public function getUpdateRules()
    {
        if (isset($this->updateRules)) {
            $this->rules = $this->updateRules;
        }

        if (isset($this->rules) && $this->rules == null) {
            $this->rules = [];
        }

        return $this->getValidateRules();
    }

    /**
     * Create or Update data with provide request
     */
    public function saveOrUpdate($request)
    {
        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile('image', $request);
        }

        return $this->fill($data)->save();
    }

    public function uploadFile($name, $request)
    {
        $path = public_path('uploads');
        $file = $request->file($name);
        $filename = $file->getClientOriginalName();
        $file->move($path, $filename);
        return $filename;
    }
}
