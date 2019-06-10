<?php declare(strict_types=1);

namespace Collection;

/**
 * Interface Jsonable
 *
 * @author  geniv
 * @package Collection
 */
interface Jsonable
{
    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0);
}
