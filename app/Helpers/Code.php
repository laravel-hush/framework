<?php

namespace ScaryLayer\Hush\Helpers;

use Exception;

class Code
{
    public static function execute($codeString)
    {
        try {
            return eval('return ' . $codeString . ';');
        } catch (Exception $exception) {
            return 'You have an error in your code: ' . $exception->getMessage();
        }

        return 'Something is wrong';
    }
}