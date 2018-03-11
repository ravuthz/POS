<?php namespace App\Traits;

use Illuminate\Support\Facades\Request;

trait Authorizable
{
    private $abilities = [
        'index' => 'DETAIL',
        'edit' => 'UPDATE',
        'show' => 'DETAIL',
        'update' => 'UPDATE',
        'create' => 'CREATE',
        'store' => 'CREATE',
        'destroy' => 'DELETE'
    ];

    /**
     * Override of callAction to perform the authorization before
     *
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function callAction($method, $parameters)
    {
        if ($ability = $this->getAbility($method)) {
            $this->authorize($ability);
        }

        return parent::callAction($method, $parameters);
    }

    public function getAbility($method)
    {
        $routeName = explode('.', Request::route()->getName());
        $action = array_get($this->getAbilities(), $method);

        if ($action) {
            $route = strtoupper(str_singular($routeName[0]));
            $action = $action . '_' . $route;
        }
        
        return $action;
    }

    private function getAbilities()
    {
        return $this->abilities;
    }

    public function setAbilities($abilities)
    {
        $this->abilities = $abilities;
    }
}