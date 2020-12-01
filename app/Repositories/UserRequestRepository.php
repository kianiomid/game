<?php

namespace App\Repositories;

use App\Models\GameMethod;
use App\Models\UserRequest;
use Illuminate\Container\Container as Application;

class UserRequestRepository extends BaseRepository
{

    private static $instance = null;

    /**
     * @param Application $app
     * @param null $entityManager
     * @return UserRequestRepository
     */
    public static function createInstance(Application $app, $entityManager = null)
    {
        if (!self::$instance) {

            self::$instance = new UserRequestRepository($app, new UserRequest(), $entityManager);
        }
        return self::$instance;
    }

    /**
     * @param $userId
     * @param $gameMethodId
     * @return mixed
     */
    public function getUserRequestByUserIdByGameMethodId($userId, $gameMethodId)
    {
        $query = $this->queryByUserIdByGameMethodId($userId, $gameMethodId)->get();
        return $query;
    }

    /**
     * @param $userId
     * @param $gameMethodId
     * @return mixed
     */
    public function loadUserRequestByUserIdByGameMethodId($userId, $gameMethodId)
    {
        $query = $this->queryByUserIdByGameMethodId($userId, $gameMethodId)->first();
        return $query;
    }

    /**
     * @param $userId
     * @param $gameMethodId
     * @return mixed
     */
    public function queryByUserIdByGameMethodId($userId, $gameMethodId)
    {
        $query = UserRequest::whereUserId($userId)->whereGameMethodId($gameMethodId);
        return $query;
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function loadStatusUserByUserId($userId)
    {
        $query = UserRequest::whereUserId($userId)
            ->get();

        return $query;
    }

}
