<?php

namespace SSITU\Hekate\Test;

use \SSITU\Hekate\Hekate;

class TestRunner
{

    private $Hekate;
    private $spacer;

    public function __construct(bool $displayException = false, bool $htmlDisplay = false)
    {
        $this->Hekate = new Hekate();
        $this->displayException($displayException);
        $this->htmlDisplay($htmlDisplay);
    }

    public function displayException(bool $on = false)
    {
        $this->Hekate->setThrowException($on);
    }

    public function htmlDisplay(bool $on = false)
    {
        if ($on) {
            $this->spacer = '<br>';
        } else {
            $this->spacer = PHP_EOL;
        }
    }

    public function run()
    {

        echo ' ## function sayFluff ## ' . $this->spacer;
        $this->Hekate->register('sayFluff', ['Puff', $this->spacer], 1);
        $this->Hekate->register('sayFluff', ['Puff again', $this->spacer], 1);

        $justAclassName = '\\' . __NAMESPACE__ . '\ImJustANameOrAmI';

        $this->Hekate->register([$justAclassName, 'instantiated'], [$this->spacer], 2);
        $this->Hekate->register([$justAclassName, 'ohbother'], [], 1);
        $this->Hekate->register([$justAclassName, 'unknownMethod'], [], 1);
        $this->Hekate->register([$justAclassName], []);
        $this->Hekate->register(['NonExistantClass'], [], 0);
        $this->Hekate->register([false, 'duh'], []);
        $this->Hekate->register(null);

        $schrodingId = $this->Hekate->register([$justAclassName, 'changingMind'], [], 3);
        $this->Hekate->deregister($schrodingId);

        $ImAClass = new ImAClass($this->spacer);
        $this->Hekate->register([$ImAClass, 'nonStaticInquiry'], ['You'], 3);
        $this->Hekate->register([$ImAClass, 'privatePS'], [], 0);
        $this->Hekate->registerMethod($ImAClass, 'bye', [true], 3);
    }

}
