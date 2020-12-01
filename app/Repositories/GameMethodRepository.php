<?php

namespace App\Repositories;

use App\Models\GameMethod;
use Illuminate\Container\Container as Application;

class GameMethodRepository extends BaseRepository
{

    private static $instance = null;

    /**
     * @param Application $app
     * @param null $entityManager
     * @return GameMethodRepository
     */
    public static function createInstance(Application $app, $entityManager = null)
    {
        if (!self::$instance) {

            self::$instance = new GameMethodRepository($app, new GameMethod(), $entityManager);
        }
        return self::$instance;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return GameMethod::latest()->get();
    }

    /**
     * @param $descriptor
     * @return mixed
     */
    public function loadByDescriptor($descriptor)
    {
        $query = GameMethod::whereDescriptor($descriptor)->first();
        return $query;
    }


}
