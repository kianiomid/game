<?php

namespace App\JsonStructures;


use App\JsonStructures\Base\BaseJsonStructure;
use App\JsonStructures\Base\JsonDictionary;

class GameMethodJson extends BaseJsonStructure
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

        foreach ($this->options as $item) {

            $res[JsonDictionary::NS_METHOD_GAMES][] = [
                JsonDictionary::NS_ID => $item->getAttribute('id'),
                JsonDictionary::NS_NAME => $item->getAttribute('name'),
                JsonDictionary::NS_DESCRIPTOR => $item->getAttribute('descriptor'),
                JsonDictionary::NS_ENABLE => $item->getAttribute('enable'),
                JsonDictionary::NS_CREATED_AT => $item->getAttribute('created_at'),
                JsonDictionary::NS_UPDATED_AT => $item->getAttribute('updated_at'),
            ];
        }

        return $res;
    }
}
