<?php

namespace App\Repositories;

use App\Models\GameCode;
use App\Models\GameMethod;
use Illuminate\Container\Container as Application;

class GameCodeRepository extends BaseRepository
{

    /**
     * @param Application $app
     * @param null $entityManager
     * @return GameCodeRepository
     */
    public static function createInstance(Application $app, $entityManager = null)
    {
        return new GameCodeRepository($app, new GameCode(), $entityManager);
    }

    public function getCodeByName($word)
    {
        $query = GameCode::whereName($word)->first();

        return $query;
    }


}
