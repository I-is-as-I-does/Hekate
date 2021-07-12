<?php

namespace SSITU\Hekate;

class Hekate implements ShutdownInterface
{

    private $callbacks = [];
    private $throwException = false;

    public function __construct(bool $throwException = false)
    {
        $this->setThrowException($throwException);
        register_shutdown_function([$this, 'callRegisteredCallbacks']);
    }

    public function setThrowException(bool $throwException = false)
    {
        $this->throwException = $throwException;
    }

    public function register(mixed $callback, array $argm = [], int $priority = 2)
    {
        if ($callableName = $this->isReallyCallable($callback)) {
            $priority = $this->resolvePriority($priority);
            $id = $this->resolveId($priority);
            $this->callbacks[$id] = [$callback, $argm];
            return $id;
        }
        if ($this->throwException) {
            throw new \Exception('Callback is not callable');
        }
        return false;
    }

    //@doc: helper method
    public function registerMethod(mixed $classOrClassName, string $methodName, array $methodArgm = [], int $priority = 2)
    {
        return $this->register([$classOrClassName, $methodName], $methodArgm, $priority);
    }

    public function deregister($id)
    {
        if (array_key_exists($id, $this->callbacks)) {
            unset($this->callbacks[$id]);
        }
    }

    public function callRegisteredCallbacks()
    {
        if (!empty($this->callbacks)) {
            ksort($this->callbacks);
            foreach ($this->callbacks as $callbackItm) {
                call_user_func_array($callbackItm[0], $callbackItm[1]);
            }
        }
    }

    private function resolvePriority($priority)
    {
        if (in_array($priority, self::PRIORITIES)) {
            return $priority;
        }
        if ($this->throwException) {
            throw new \Exception($priority . ' is not a valid priority');
        }
        return 2;
    }

    private function resolveId($priority)
    {
        $i = 1;
        $baseid = $priority . '_';
        while (array_key_exists($baseid . $i, $this->callbacks)) {
            $i++;
        }
        return $baseid . $i;
    }

    private function isACallableMethod($callback)
    {
        if (method_exists($callback[0], $callback[1])) {
            $reflection = new \ReflectionMethod($callback[0], $callback[1]);
            $isAccessible = true;
            if ((is_object($callback[0]) || $reflection->isStatic()) && $reflection->isPublic()) {
                return true;
            }
        }
        if ($this->throwException) {
            throw new \Exception('Callback method is not accessible');
        }
        return false;
    }

    private function isReallyCallable($callback)
    {
        if (is_callable($callback, true, $callableName) && (is_string($callback) || $this->isACallableMethod($callback))) {
            return $callableName;
        }
        return false;

    }

}
