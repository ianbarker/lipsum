<?php

/**
 * @author: ianbarker <ian@theorganicagency.com>
 * @date:   29/05/2014
 *
 */
class LoremPixel {

    private static $instance = null;
    private static $width = 500;
    private static $height = 768;

    private function __construct() {

    }

    public static function getInstance() {

        if (is_null(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;

    }

    public function getImage($type = '') {

        $url = 'http://lorempixel.com/' . self::$width . '/' . self::$height . (!empty($type) ? '/' . $type : '');

        return file_get_contents($url);


    }


}
