<?php


namespace app\core;


/**
 * Get user page from uri
 *
 * 'REQUEST_URI' => string '/lara/about/add?id=5'
 * extract/add
 *
 * Class Request
 * @package app\core
 */
class Request
{

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';//nukreipiamas i home page

        $questionPosition = strpos($path, '?');

        if ($questionPosition !== false) :
            $path = substr($path, 0, $questionPosition);
        endif;
        return $path;
    }

}
