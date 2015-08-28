<?php

namespace Rancher\Resource;

class Collection implements \ArrayAccess, \Countable, \IteratorAggregate
{
    public $_items;

    public function __construct(array $items = [])
    {
        $this->_items = $items;
    }

    public function toArray()
    {
        return $this->_items;
    }

    public function first()
    {
        return reset($this->_items);
    }

    public function last()
    {
        return end($this->_items);
    }

    public function key()
    {
        return key($this->_items);
    }

    public function next()
    {
        return next($this->_items);
    }

    public function current()
    {
        return current($this->_items);
    }

    public function remove($key)
    {
        if (isset($this->_items[$key])) {
            $removed = $this->_items[$key];
            unset($this->_items[$key]);

            return $removed;
        }

        return null;
    }

    public function removeItem($item)
    {
        $key = array_search($item, $this->_items, true);

        if ($key !== false) {
            unset($this->_items[$key]);
            return true;
        }

        return false;
    }

    public function offsetExists($offset)
    {
        return $this->containsKey($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $item)
    {
        if (!isset($offset)) {
            return $this->add($item);
        }

        return $this->set($offset, $item);
    }

    public function offsetUnset($offset)
    {
        return $this->remove($offset);
    }

    public function containsKey($key)
    {
        return isset($this->_items[$key]);
    }

    public function contains($item)
    {
        return in_array($item, $this->_items, true);
    }

    public function exists(\Closure $p)
    {
        foreach ($this->_items as $key => $item) {
            if ($p($key, $item)) {
                return true;
            }
        }

        return false;
    }

    public function indexOf($item)
    {
        return array_search($item, $this->_items, true);
    }

    public function get($key)
    {
        if (isset($this->_items[$key])) {
            return $this->_items[$key];
        }

        return null;
    }

    public function getKeys()
    {
        return array_keys($this->_items);
    }

    public function getValues()
    {
        return array_values($this->_items);
    }

    public function count()
    {
        return count($this->_items);
    }

    public function set($key, $item)
    {
        $this->_items[$key] = $item;
    }

    public function add($item)
    {
        $this->_items[] = $item;
        return true;
    }

    public function isEmpty()
    {
        return !$this->_items;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->_items);
    }

    public function clear()
    {
        $this->_items = [];
    }
}