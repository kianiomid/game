<?php

namespace App\Repositories;

use App\Models\GameMethod;
use Illuminate\Container\Container as Application;

class GameMethodRepository extends BaseRepository
{

    /**
     * @param Application $app
     * @param null $entityManager
     * @return GameMethodRepository
     */
    public static function createInstance(Application $app, $entityManager = null)
    {
        return new GameMethodRepository($app, new GameMethod(), $entityManager);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return GameMethod::latest()->get();
    }

    public function loadByDescriptor($descriptor)
    {
        $query = GameMethod::whereDescriptor($descriptor)->first();
        return $query;
    }


}
