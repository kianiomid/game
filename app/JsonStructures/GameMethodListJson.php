<?php

namespace App\JsonStructures;


use App\JsonStructures\Base\BaseJsonStructure;
use App\JsonStructures\Base\JsonDictionary;

class GameMethodListJson extends BaseJsonStructure
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
        $gameMethods = [];
        if (!empty($this->options)) {
            foreach ($this->options as $gameMethod) {
                $gameMethods[] = (new GameMethodJson($this->incrementalKey, $gameMethod))->toArray();
            }
        }

        $res = [
            JsonDictionary::NS_GAME_METHOD => $gameMethods
        ];

        return $res;
    }
}
