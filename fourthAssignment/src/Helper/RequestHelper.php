<?php
namespace Helper;

class RequestHelper
{
    public function getSanitizedParam(string $name): ?string
    {
        // check $_GET first
        $value = isset($_GET[$name]) && !empty($_GET[$name]) ? filter_var($_GET[$name], FILTER_SANITIZE_STRING) : null;

        if (!is_null($value)) {
            return $value;
        }

        return isset($_POST[$name]) && !empty($_POST[$name]) ? filter_var($_POST[$name], FILTER_SANITIZE_STRING) : null;
    }
}