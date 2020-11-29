<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\JsonStructures\Base\BaseJsonStructure;
use App\JsonStructures\Base\JsonResponse;
use App\JsonStructures\GameMethodJson;
use App\Repositories\GameMethodRepository;


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
}