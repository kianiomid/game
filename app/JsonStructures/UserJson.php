<?php

namespace App\JsonStructures;


use App\JsonStructures\Base\BaseJsonStructure;
use App\JsonStructures\Base\JsonDictionary;

class UserJson extends BaseJsonStructure
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
        $user = $this->options;

        $res = [
            JsonDictionary::NS_ID => $user->getAttribute('id'),
            JsonDictionary::NS_NAME => $user->getAttribute('name'),
            JsonDictionary::NS_EMAIL => $user->getAttribute('email'),
        ];

        return $res;
    }
}
