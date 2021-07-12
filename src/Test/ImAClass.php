<?php

namespace SSITU\Hekate\Test;

class ImAClass
{

    private static $name;
    private static $spacer;

    public function __construct($spacer)
    {
        self::$spacer = $spacer;
    }

    public function nonStaticInquiry($name)
    {
        self::$name = $name;
        echo self::$spacer . ' ## class ImAClass ## ' . self::$spacer;
        echo 'Hey ' . $name . ', I\'m non-static method called from a previously instantiated class, but are you? ' . self::$spacer;
    }

    public static function bye($exclamationMark = false)
    {
        $mark = '';
        if ($exclamationMark) {
            $mark = '!';
        }
        echo 'I guess you\'re not. Bye ' . self::$name . $mark;
    }

    private function privatePS()
    {
        echo 'I\'m a private post-scriptum, this will not work.';
    }

}
