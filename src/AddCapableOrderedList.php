<?php

namespace Dhii\Collection;

use ArrayIterator;
use IteratorAggregate;
use Exception as RootException;
use Dhii\Exception\CreateInvalidArgumentExceptionCapableTrait;
use Dhii\I18n\StringTranslatingTrait;
use Dhii\Util\Normalization\NormalizeArrayCapableTrait;

/**
 * A list implementation that can have items added.
 *
 * @since [*next-version*]
 */
class AddCapableOrderedList implements
    IteratorAggregate,
    CountableListInterface,
    AddCapableInterface
{
    /* Ability to normalize arrays.
     *
     * @since [*next-version*]
     */
    use NormalizeArrayCapableTrait;

    /* Factory of Invalid Argument exception.
     *
     * @since [*next-version*]
     */
    use CreateInvalidArgumentExceptionCapableTrait;

    /* Basic string i18n.
     *
     * @since [*next-version*]
     */
    use StringTranslatingTrait;

    /**
     * The items of the list.
     *
     * @since [*next-version*]
     *
     * @var array
     */
    protected $items = [];

    public function __construct($items = null)
    {
        if (!is_null($items)) {
            $this->items = $this->_normalizeArray($items);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function add($item)
    {
        $this->items[] = $item;
    }

    /**
     * Retrieves an iterator for the items of the list.
     *
     * @throws RootException If iterator could not be retrieved.
     *
     * @return ArrayIterator The new iterator.
     */
    public function getIterator()
    {
        return $this->_createArrayIterator($this->items);
    }

    /**
     * Creates a new array iterator.
     *
     * @since [*next-version*]
     *
     * @param array $array The array that the iterator will be iterating over.
     *
     * @throws RootException If the iterator could not be creted.
     *
     * @return ArrayIterator The new iterator.
     */
    protected function _createArrayIterator(array $array)
    {
        return new ArrayIterator($array);
    }
}
