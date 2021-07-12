<?php
/* This file is part of Hekate | SSITU | (c) 2021 I-is-as-I-does | MIT License */

namespace SSITU\Hekate;

interface ShutdownInterface
{
    const PRIORITIES = ['high' => 1, 'normal' => 2, 'low' => 3];

    public function setThrowException(bool $throwException = false);
    public function register(mixed $callback, array $argm = [], int $priority = 2);
    public function registerMethod(mixed $classOrClassName, string $methodName, array $methodArgm = [], int $priority = 2);
    public function deregister($id);
}
