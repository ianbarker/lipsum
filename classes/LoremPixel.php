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

    public static function getWidth() {

        return self::$width;
    }

    public static function getHeight() {

        return self::$height;
    }

    public function getImage($type = '', $width, $height) {

        $width = intval($width) > 0 ? $width : self::$width;
        $height = intval($height) > 0 ? $height : self::$height;

        $url = 'http://lorempixel.com/' . $width . '/' . $height . (!empty($type) ? '/' . $type : '');

        return file_get_contents($url);


    }


}
