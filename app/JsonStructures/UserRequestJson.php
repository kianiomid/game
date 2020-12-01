<?php

namespace App\JsonStructures;


use App\JsonStructures\Base\BaseJsonStructure;
use App\JsonStructures\Base\JsonDictionary;

class UserRequestJson extends BaseJsonStructure
{

    protected $options;

    public function __construct($incrementalKey, $options)
    {
        parent::__construct($incrementalKey);
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $res = [];

        if (!empty($this->options)) {
            foreach ($this->options as $item) {

                $user = (new UserJson(request()->get(BaseJsonStructure::NS_INCREMENTAL_KEY), $item->user))->toArray();
                $gameMethod = (new GameMethodJson(request()->get(BaseJsonStructure::NS_INCREMENTAL_KEY), $item->gameMethod))->toArray();

                $res[JsonDictionary::NS_USER_REQUEST][] = [
                    JsonDictionary::NS_ID => $item->getAttribute('id'),
                    JsonDictionary::NS_ACTUAL_REQUEST => $item->getAttribute('actual_request'),
                    JsonDictionary::NS_MAX_REQUEST => $item->getAttribute('max_request'),
                    JsonDictionary::NS_REMAIN_REQUEST => $item->getAttribute('max_request') - $item->getAttribute('actual_request') < 0 ? 0 : $item->getAttribute('max_request') - $item->getAttribute('actual_request'),
                    JsonDictionary::NS_USER => $user,
                    JsonDictionary::NS_GAME_METHOD => $gameMethod,
                    JsonDictionary::NS_CREATED_AT => $item->getAttribute('created_at'),
                    JsonDictionary::NS_UPDATED_AT => $item->getAttribute('updated_at'),
                ];
            }
        }

        return $res;
    }
}
