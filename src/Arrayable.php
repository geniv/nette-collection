<?php declare(strict_types=1);

namespace Collection;

/**
 * Interface Arrayable
 *
 * @author  geniv
 * @package Collection
 */
interface Arrayable
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray();
}
