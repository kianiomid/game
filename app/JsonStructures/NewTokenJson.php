<?php

namespace App\JsonStructures;


use App\JsonStructures\Base\BaseJsonStructure;
use App\JsonStructures\Base\JsonDictionary;

class NewTokenJson extends BaseJsonStructure
{

    const BEARER = 'bearer';

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
        $token = $this->options;

        $res = [
            JsonDictionary::NS_ACCESS_TOKEN => $token,
            JsonDictionary::NS_TOKEN_TYPE => self::BEARER,
            JsonDictionary::NS_EXPIRE_IN => auth()->factory()->getTTL() * 60,
            JsonDictionary::NS_USERS => (new UserJson(request()->get(BaseJsonStructure::NS_INCREMENTAL_KEY), auth()->user()))->toArray()
        ];

        return $res;
    }
}
