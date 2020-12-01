<?php namespace App\JsonStructures\Base;


abstract class BaseJsonStructure
{
    protected $incrementalKey = '';
    protected $messages = [];
    protected $hasError = false;

    const NS_INCREMENTAL_KEY = 'incrementalKey';

    protected abstract function toArray();

    /**
     * BaseJsonStructure constructor.
     * @param $incrementalKey
     */
    public function __construct($incrementalKey)
    {
        $this->incrementalKey = $incrementalKey;
    }

    /**
     * @param $incrementalKey
     */
    public function setIncrementalKey($incrementalKey)
    {
        $this->incrementalKey = $incrementalKey;
    }

    /**
     * @return false|string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
