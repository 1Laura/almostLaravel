<?php


namespace app\core;


/**
 *
 * Class Request
 * @package app\core
 */
class Request
{

    /**
     * Get user page from uri
     *
     * 'REQUEST_URI' => string '/lara/about/add?id=5'
     * extract/add
     *
     * @return string
     */
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';//nukreipiamas i home page

        $questionPosition = strpos($path, '?');

        if ($questionPosition !== false) :
            $path = substr($path, 0, $questionPosition);
        endif;
        return $path;
    }

    /**
     * This
     *
     * @return string
     */
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }


    /**
     * Sanitize get and post arrays with html special chars
     *
     * @return array
     */
    public function getBody()
    {
        //store clean values
        $body = [];

        //what type of request
        if ($this->getMethod() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        if ($this->getMethod() === 'get') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        return $body;
    }

}
