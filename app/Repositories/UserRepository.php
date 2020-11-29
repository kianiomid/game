<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Container\Container as Application;

class UserRepository extends BaseRepository
{

    /**
     * @param Application $app
     * @param null $entityManager
     * @return UserRepository
     */
    public static function createInstance(Application $app, $entityManager = null)
    {
        return new UserRepository($app, new User(), $entityManager);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createUserInfo($data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return $user;
    }


}
