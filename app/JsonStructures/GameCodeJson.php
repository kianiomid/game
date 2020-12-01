<?php

namespace App\JsonStructures;


use App\JsonStructures\Base\BaseJsonStructure;
use App\JsonStructures\Base\JsonDictionary;

class GameCodeJson extends BaseJsonStructure
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
        $code = $this->options;

        $res = [
            JsonDictionary::NS_CODE => $code->getAttribute('code'),
        ];

        return $res;
    }
}
