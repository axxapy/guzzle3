<?php

namespace Guzzle\Common;

use Symfony\Contracts\EventDispatcher\Event as SymfonyEvent;

/**
 * Default event for Guzzle notifications
 */
class Event extends SymfonyEvent implements ToArrayInterface, \ArrayAccess, \IteratorAggregate
{
    /** @var array */
    private $context;

    /**
     * @param array $context Contextual information
     */
    public function __construct(array $context = array())
    {
        $this->context = $context;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->context);
    }

    public function offsetGet($offset): mixed
    {
        return isset($this->context[$offset]) ? $this->context[$offset] : null;
    }

    public function offsetSet($offset, $value): void
    {
        $this->context[$offset] = $value;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->context[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->context[$offset]);
    }

    public function toArray()
    {
        return $this->context;
    }
}
