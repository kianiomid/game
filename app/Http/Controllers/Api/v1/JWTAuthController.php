<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\JsonStructures\Base\BaseJsonStructure;
use App\JsonStructures\Base\JsonResponse;
use App\JsonStructures\NewTokenJson;
use App\JsonStructures\UserJson;
use App\Repositories\UserRepository;


class JWTAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register()
    {
        $rules = [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ];

        $this->validate(request(), $rules);

        $user = UserRepository::createInstance(app())->createUserInfo(request()->all());
        $userJson = (new UserJson(request()->get(BaseJsonStructure::NS_INCREMENTAL_KEY), $user))->toArray();

        return JsonResponse::response($userJson, trans('response.general.success_register'), 200, 200);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login()
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];

        $this->validate(request(), $rules);

        if (!$token = auth()->attempt(request()->all())) {
            return JsonResponse::response([], trans('response.errors.unauthorized'), 401, 401);
        }

        $newTokenJson = (new NewTokenJson(request()->get(BaseJsonStructure::NS_INCREMENTAL_KEY), $token))->toArray();
        return JsonResponse::response($newTokenJson, trans('response.general.success'), 200, 200);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->logout();
        return JsonResponse::response([], trans('response.general.logout'), 200, 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh()
    {
        $newTokenJson = (new NewTokenJson(request()->get(BaseJsonStructure::NS_INCREMENTAL_KEY), auth()->refresh()))->toArray();
        return JsonResponse::response($newTokenJson, trans('response.general.success'), 200, 200);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\Response
     */
    public function userProfile()
    {
        $user = (new UserJson(request()->get(BaseJsonStructure::NS_INCREMENTAL_KEY), auth()->user()))->toArray();
        return JsonResponse::response($user, trans('response.general.success'), 200, 200);
    }

}