<?php

namespace App\Repositories;

use App\Models\GameCode;
use App\Models\GameMethod;
use Illuminate\Container\Container as Application;

class GameCodeRepository extends BaseRepository
{

    private static $instance = null;

    /**
     * @param Application $app
     * @param null $entityManager
     * @return GameCodeRepository
     */
    public static function createInstance(Application $app, $entityManager = null)
    {
        if (!self::$instance) {

            self::$instance = new GameCodeRepository($app, new GameCode(), $entityManager);
        }
        return self::$instance;
    }

    /**
     * @param $word
     * @return mixed
     */
    public function getCodeByName($word)
    {
        $query = GameCode::whereName($word)->first();

        return $query;
    }


}
