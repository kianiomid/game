<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\JsonStructures\Base\BaseJsonStructure;
use App\JsonStructures\Base\JsonResponse;
use App\JsonStructures\GameCodeJson;
use App\JsonStructures\GameMethodJson;
use App\Models\GameMethod;
use App\Models\UserRequest;
use App\Repositories\GameCodeRepository;
use App\Repositories\GameMethodRepository;
use App\Repositories\UserRequestRepository;
use Illuminate\Http\Request;


class GameController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function gameMethodLists()
    {
        $gameMethodLists = GameMethodRepository::createInstance(app())->getData();

        $gameMethodJson = (new GameMethodJson(request()->get(BaseJsonStructure::NS_INCREMENTAL_KEY), $gameMethodLists))->toArray();
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

        $gameMethod = GameMethodRepository::createInstance(app())
            ->loadByDescriptor(GameMethod::ALL_WORD);

        $userRequ = UserRequestRepository::createInstance(app())
            ->loadUserRequestByUserIdByGameMethodId(1, $gameMethod->id);

        if (empty($userRequ)) {
            $ur = new UserRequest();
            //        $ur->user_id = auth()->user()->id;
            $ur->user_id = 1;
            $ur->game_method_id = $gameMethod->id;
            $ur->actual_request = count([$word]);
            $ur->max_request = 10;
            $ur->save();

        } else {
            $userRequ->actual_request += 1;
            $userRequ->save();
        }

        $userRequests = UserRequestRepository::createInstance(app())
            ->getUserRequestByUserIdByGameMethodId(1, $gameMethod->id);

        foreach ($userRequests as $userRequest) {

            if ($userRequest->actual_request <= $userRequest->max_request) {

                $gameCode = GameCodeRepository::createInstance(app())->getCodeByName($word);

                if (!empty($gameCode)) {
                    $gameCodeJson = (new GameCodeJson(request()->get(BaseJsonStructure::NS_INCREMENTAL_KEY), $gameCode))->toArray();
                    return JsonResponse::response($gameCodeJson, trans('response.general.win'), 200, 200);

                } else {
                    return JsonResponse::response([], trans('response.general.try_again'), 200, 200);
                }

            } else {
                return JsonResponse::response([], trans('response.general.lost'), 200, 200);
            }
        }

    }
}