<?php

namespace Shippinno\Learn\Infrastructure\Persistence\Doctrine\Type\EntityId;

use Doctrine\DBAL\Platforms\AbstractPlatform;

class DoctrineCourseId extends DoctrineEntityId
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'course_id';
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return parent::convertToPHPValue($value, $platform);
    }

    /**
     * {@inheritdoc}
     */
    protected function getNamespace(): string
    {
        return 'Shippinno\Learn\Domain\Model\Course';
    }
}

