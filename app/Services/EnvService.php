<?php

namespace App\Services;

class EnvService
{
    public static function replaceVariable(string $key, string $value): bool
    {
        $replaced = preg_replace(
            pattern: '/'.$key.'=.*$/m',
            replacement: $key.'="'.$value.'"',
            subject: $input = file_get_contents(app()->environmentFilePath()),
        );

        if ($replaced === $input || is_null($replaced)) {
            return false;
        }

        file_put_contents(app()->environmentFilePath(), $replaced);

        return true;
    }
}
