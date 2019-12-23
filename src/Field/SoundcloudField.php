<?php
namespace Bolt\Extensions\SHatoDJ\Soundcloud\Field;

use Bolt\Extensions\SHatoDJ\Soundcloud\Helper\Url;
use Bolt\Storage\EntityManager;
use Bolt\Storage\Field\Type\FieldTypeBase;
use Bolt\Storage\QuerySet;
use Doctrine\DBAL\Types\Type;
use Embed\Providers\Api\Soundcloud;

// use Bolt\Extension\SHatoDJ\Soundcloud


class SoundcloudField extends FieldTypeBase
{
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
     * 
     */
    public function persist(QuerySet $queries, $entity, EntityManager $em = null)
    {
        $key = $this->mapping['fieldname'];
        $qb = $queries->getPrimary();
        $value = $entity->get($key);

        if (!$value instanceof Url) {
            $value = Url::fromNative($value);
        }

        $qb->setValue($key, ':' . $key);
        $qb->set($key, ':' . $key);
        $qb->setParameter($key, (string)$value);

    }

    public function getStorageOptions()
    {
        return [
          'default' => ''
        ];
    }

    public function hydrate($data, $entity)
    {
        $key = $this->mapping['fieldname'];

        $val = isset($data[$key]) ? $data[$key] : null;
        if ($val !== null) {
            $value = Url::fromNative($val);
            $this->set($entity, $value);
        }
    }

}