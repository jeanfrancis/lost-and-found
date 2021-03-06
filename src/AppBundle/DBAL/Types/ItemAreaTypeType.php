<?php

namespace AppBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * ItemAreaType type
 *
 * @author Artem Genvald  <genvaldartem@gmail.com>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class ItemAreaTypeType extends AbstractEnumType
{
    const POLYGON   = 'polygon';
    const RECTANGLE = 'rectangle';
    const CIRCLE    = 'circle';
    const MARKER    = 'marker';

    /**
     * {@inheritdoc}
     */
    protected static $choices = [
        self::POLYGON   => 'Polygon',
        self::RECTANGLE => 'Rectangle',
        self::CIRCLE    => 'Circle',
        self::MARKER    => 'Marker'
    ];
}
