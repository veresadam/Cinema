<?php

namespace Model\Admin;


class Reader
{
    public function readFile($file) : array
    {
        $fileArray = file($file, FILE_IGNORE_NEW_LINES);
        $keys = explode(',',$fileArray[0]);
        unset($fileArray[0]);
        $resultArray = [];
        foreach ($fileArray as $rowNum => $row) {
            $resultArray[$rowNum] = array_combine($keys,explode(',', $row));
        }
        return $resultArray;
    }
}