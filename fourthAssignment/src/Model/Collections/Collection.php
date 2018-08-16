<?php
/**
 * Created by PhpStorm.
 * User: adamveres
 * Date: 13.08.2018
 * Time: 14:01
 */

namespace Model\Collections;

use Model\Entities\Entity;

class Collection implements \Iterator
{
    protected $items = [];
    protected $position = 0;

    public function addItem(Entity $item)
    {
        $this->items[] = $item;
    }

    /**
     * @return array
     */
    public function getAllItems(): array
    {
        return $this->items;
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function getItem(int $id)
    {
        return isset($this->items[$id]) ? $this->items[$id] : null;
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->items[$this->position];
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next() : void
    {
        $this->position++;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key() : int
    {
        return $this->position;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid() : bool
    {
        return (isset($this->items[$this->position]));
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind() : void
    {
        $this->position = 0;
    }

    public function count() : int
    {
        return count($this->items);
    }
}