<?php

namespace App\Models\Traits;

trait DBQuerySelect
{

    public static function getDBSelectFields($prefix)
    {
        $res = [];

        foreach (self::$selectFields as $item) {
            $res[] = $prefix . '.' . $item . ' AS ' . $prefix . '_' . $item;
        }

        return $res;
    }

    /**
     * @param string $prefix
     * @param array $data
     * @param bool $addKey
     * @return DBQuerySelect
     */
    public static function bindDBQuery($prefix, $data, $addKey = true)
    {

        $x = new self();
        $found = false;
        foreach ($data as $it => $val) {
            if (substr($it, 0, strlen($prefix . '_')) == $prefix . '_') {
                $fieldName = substr($it, strlen($prefix . '_'));
                if ($fieldName != $x->getKeyName() || $addKey == true) {
                    if ($val != null) $found = true;
                    $x->$fieldName = $val;
                }
            }
        }

        return $found ? $x : null;
    }

    /**
     * @param string $prefix
     * @param array $data
     * @return DBQuerySelect
     */
    public function bindDBQueryAddKey($prefix, $data)
    {
        foreach ($data as $it => $val) {
            if (substr($it, 0, strlen($prefix . '_')) == $prefix . '_') {
                $fieldName = substr($it, strlen($prefix . '_'));
                if ($fieldName == $this->getKeyName()) {
                    $this->$fieldName = $val;
                }
            }
        }

        return $this;

    }

    /**
     * @param $record
     * @param $prefix
     * @return array
     */
    public static function removePrefixAndGetRecord($record, $prefix)
    {
        $result = [];

        foreach ($record as $key => $value) {
            if (stristr($key, $prefix)) {
                $result[str_replace($prefix, '', $key)] = $value;
            }
        }

        return $result;
    }

}
