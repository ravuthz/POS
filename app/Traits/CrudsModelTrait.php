<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

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
        $path = public_path('images');
        $file = $request->file($name);
        $filename = $file->getClientOriginalName();

        // $this->resizeImage($file, 640, 480);
        // $this->resizeImage($file, 400, 200);
        // $this->resizeImage($file, 100, 70);

        $file->move($path, $filename);

        return $filename;
    }

    public function resizeImage($file, $width, $height) {

        // create instance of Intervention Image
        $img = Image::make($file);

        // resize image to fixed size
        // See the docs - http://image.intervention.io/api/resize
        $img->resize($width, $height);

        $fileName = $this->fileNameSize($file->getClientOriginalName(), $width, $height);

        $img->save('uploads/' . $fileName);

        return $img;
    }

    private function fileNameSize($name, $width, $height) {
        if ($name) {
            $names = explode('.', $name);
            return $names[0] . '-' . $width . 'x' . $height . '.' . $names[1];
        }
        return $name;
    }
}
