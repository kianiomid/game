<?php

namespace App\Repositories;

use App\Models\GameMethod;
use App\Models\UserRequest;
use Illuminate\Container\Container as Application;

class UserRequestRepository extends BaseRepository
{

    /**
     * @param Application $app
     * @param null $entityManager
     * @return UserRequestRepository
     */
    public static function createInstance(Application $app, $entityManager = null)
    {
        return new UserRequestRepository($app, new UserRequest(), $entityManager);
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

}
