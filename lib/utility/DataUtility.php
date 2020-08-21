<?php
require_once SITE_ROOT.'lib/utility/helpers.php';
class DataUtility
{
    public function __construct()
    {
        consoleLogger("DataUtility Initialized");
    }
    public function extractData($data, $attribute)
    {
        $dataArray = array();
        $i = 1;
        foreach ($data as $dt) {
            if (array_key_exists($attribute, $dt)) {
                $dataArray[$attribute . "_" . $i++] = $dt->$attribute;
            }
        }
        return $dataArray;
    }
}
