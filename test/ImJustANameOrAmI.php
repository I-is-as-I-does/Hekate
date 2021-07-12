<?php
/* This file is part of Hekate | SSITU | (c) 2021 I-is-as-I-does | MIT License */
namespace SSITU\Hekate\Test;

class ImJustANameOrAmI
{
    private static $_this;
    private static $spacer;

    public static function instantiated($spacer)
    {
        echo $spacer . ' ## class ImJustANameOrAmI ## ' . $spacer;
        echo 'Class was registered as a string; and I\'m a static method, so it\'s all fine and dandy. Now, let me relay the message of a less lucky fellow method: ' . $spacer;
        if (!isset(self::$_this)) {
            self::$_this = new self();
            self::$spacer = $spacer;
        }
        echo '"' . self::$_this->ohbother() . '" ' . self::$spacer;
    }
    public function ohbother()
    {
        return 'If class is set as a string and method is not static, registration won\'t be allowed.' . self::$spacer .
            'Sure, class *could* be instantiated down the road, but also coud not be; so, this is not safe. If this is displayed, an intermediate static method has been used.';
    }
    public static function changingMind()
    {
        echo 'I will be unregistered.';
    }
}
