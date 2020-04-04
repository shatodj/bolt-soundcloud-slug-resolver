<?php
namespace Bolt\Extension\SHatoDJ\Soundcloud\Field;

use Bolt\Storage\Field\Type\FieldTypeBase;
use Doctrine\DBAL\Types\Type;

class SoundcloudField extends FieldTypeBase
{

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'soundcloud';
    }

    /**
     * {@inheritdoc}
     */
    public function getStorageType()
    {
        return Type::getType('text');
    }

    /**
     * @inheritdoc
     */
    public function getStorageOptions()
    {
        return [
          'default' => ''
        ];
    }

    /**
     * @inheritdoc
     */
    public function getTemplate()
    {
        return '@soundcloud/_soundcloud.twig';
    }
}