<?php

if (! function_exists('rpg_url')) {
    /**
     * @param string
     *
     * @return string
     */
    function rpg_url (string $argument) : string
    {
        return url(config('rpg.http.back-office.prefix').'/'. $argument);
    }
}

