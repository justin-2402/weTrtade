<?php

class safeForm
{
    public function convertInput($input)
    {
        $input = stripslashes($input);
        $input = htmlentities($input);
        return $input;
    }
}
