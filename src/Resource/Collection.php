<?php

namespace Rancher\Resource;

/**
 * Class Collection
 * @package Rancher\Resource
 */
class Collection implements \ArrayAccess, \Countable, \IteratorAggregate, \JsonSerializable
{
    /**
     * @var array
     */
    public $_items;

    /**
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->_items = $items;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->_items;
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return reset($this->_items);
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return end($this->_items);
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return key($this->_items);
    }

    /**
     * @return mixed
     */
    public function next()
    {
        return next($this->_items);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->_items);
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function remove($key)
    {
        if (isset($this->_items[$key])) {
            $removed = $this->_items[$key];
            unset($this->_items[$key]);

            return $removed;
        }

        return null;
    }

    /**
     * @param $item
     * @return bool
     */
    public function removeItem($item)
    {
        $key = array_search($item, $this->_items, true);

        if ($key !== false) {
            unset($this->_items[$key]);
            return true;
        }

        return false;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->containsKey($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $item
     * @return bool|void
     */
    public function offsetSet($offset, $item)
    {
        if (!isset($offset)) {
            return $this->add($item);
        }

        return $this->set($offset, $item);
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetUnset($offset)
    {
        return $this->remove($offset);
    }

    /**
     * @param $key
     * @return bool
     */
    public function containsKey($key)
    {
        return isset($this->_items[$key]);
    }

    /**
     * @param $item
     * @return bool
     */
    public function contains($item)
    {
        return in_array($item, $this->_items, true);
    }

    /**
     * @param \Closure $p
     * @return bool
     */
    public function exists(\Closure $p)
    {
        foreach ($this->_items as $key => $item) {
            if ($p($key, $item)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $item
     * @return mixed
     */
    public function indexOf($item)
    {
        return array_search($item, $this->_items, true);
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        if (isset($this->_items[$key])) {
            return $this->_items[$key];
        }

        return null;
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        return array_keys($this->_items);
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return array_values($this->_items);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->_items);
    }

    /**
     * @param $key
     * @param $item
     */
    public function set($key, $item)
    {
        $this->_items[$key] = $item;
    }

    /**
     * @param $item
     * @return bool
     */
    public function add($item)
    {
        $this->_items[] = $item;
        return true;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return !$this->_items;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->_items);
    }

    /**
     * @param \Closure $p
     * @return static
     */
    public function filter(\Closure $p) {
        return new static(array_filter($this->_items, $p));
    }

    /**
     * Clear all items in collection
     */
    public function clear()
    {
        $this->_items = [];
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        return $this->getValues();
    }
}