<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class CheckItemType
 *
 * @author Artem Genvald  <genvaldartem@gmail.com>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 *
 * @Annotation
 */
class ItemArea extends Constraint
{
    public $message = 'Check the "%areaType%" on map';

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'item_area';
    }

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
