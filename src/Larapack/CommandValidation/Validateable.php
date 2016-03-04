<?php

namespace Larapack\CommandValidation;

trait Validateable
{
    protected function validate($method, $callback)
    {
        $value = $method();

        $validate = $callback($value);

        if ($validate !== true && $validate !== null) {
            if (is_string($validate)) {
                $this->warn($validate);
            }

            $value = $this->validate($method, $callback);
        }

        return $value;
    }
}
