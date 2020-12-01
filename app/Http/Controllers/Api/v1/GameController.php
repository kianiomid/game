<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\JsonStructures\Base\BaseJsonStructure;
use App\JsonStructures\Base\JsonResponse;
use App\JsonStructures\GameCodeJson;
use App\JsonStructures\GameMethodListJson;
use App\JsonStructures\UserRequestJson;
use App\Models\GameMethod;
use App\Models\UserRequest;
use App\Repositories\GameCodeRepository;
use App\Repositories\GameMethodRepository;
use App\Repositories\UserRequestRepository;


class GameController extends AppBaseController
{

    public $gameMethodRepos;
    public $userRequestRepos;
    public $gameCodeRepos;

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth:api');

        $this->gameMethodRepos = GameMethodRepository::createInstance(app(), $this->entityManager);
        $this->userRequestRepos = UserRequestRepository::createInstance(app(), $this->entityManager);
        $this->gameCodeRepos = GameCodeRepository::createInstance(app(), $this->entityManager);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function gameMethodLists()
    {
        /* we are two way for play game that shown here*/
        $gameMethodLists = $this->gameMethodRepos->getData();

        $gameMethodJson = (new GameMethodListJson(request()->get(BaseJsonStructure::NS_INCREMENTAL_KEY), $gameMethodLists))->toArray();

        return JsonResponse::response($gameMethodJson, trans('response.general.success'), 200, 200);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sendWord()
    {
        $rules = [
            'word' => 'required|min:8|max:8',
        ];

        $this->validate(request(), $rules);

        $word = request()->get('word');

        $gameMethod = $this->gameMethodRepos->loadByDescriptor(GameMethod::ALL_WORD);

        $loadUserRequest = $this->userRequestRepos->loadUserRequestByUserIdByGameMethodId(auth()->user()->id, $gameMethod->id);

        // create first record for user request
        if (empty($loadUserRequest)) {
            $ur = new UserRequest();
            $ur->setAttribute('user_id', auth()->user()->id);
            $ur->setAttribute('game_method_id', $gameMethod->id);
            $ur->setAttribute('actual_request', count([$word]));
            $ur->setAttribute('max_request', UserRequest::MAX_REQUEST);
            $ur->save();

        } else {

            if ($loadUserRequest->actual_request <= UserRequest::MAX_REQUEST) {
                $loadUserRequest->actual_request += 1;
                $loadUserRequest->save();
            }
        }

        $userRequests = $this->userRequestRepos->getUserRequestByUserIdByGameMethodId(auth()->user()->id, $gameMethod->id);

        foreach ($userRequests as $userRequest) {

            if ($userRequest->actual_request <= $userRequest->max_request) {

                $gameCode = $this->gameCodeRepos->getCodeByName($word);

                if (!empty($gameCode)) {

                    $gameCodeJson = (new GameCodeJson(request()->get(BaseJsonStructure::NS_INCREMENTAL_KEY), $gameCode))->toArray();
                    auth()->logout();
                    return JsonResponse::response($gameCodeJson, trans('response.general.win'), 200, 200);

                } else {
                    return JsonResponse::response([], trans('response.general.try_again'), 200, 200);
                }

            } else {

                auth()->logout();
                return JsonResponse::response([], trans('response.general.lost'), 200, 200);
            }
        }
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function userStatus()
    {
        $gameMethodLists = $this->gameMethodRepos->loadByDescriptor(GameMethod::ALL_WORD);

        $user = $this->userRequestRepos->getUserRequestByUserIdByGameMethodId(auth()->user()->id, $gameMethodLists->id);

        $userRequestJson = (new UserRequestJson(request()->get(BaseJsonStructure::NS_INCREMENTAL_KEY), $user))->toArray();

        return JsonResponse::response($userRequestJson, trans('response.general.success'), 200, 200);
    }
}