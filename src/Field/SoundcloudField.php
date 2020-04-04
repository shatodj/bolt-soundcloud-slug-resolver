<?php
namespace Bolt\Extension\SHatoDJ\Soundcloud\Field;

use Bolt\Extension\SHatoDJ\Soundcloud\Helper\SoundcloudAlbum;
use Bolt\Extension\SHatoDJ\Soundcloud\Service\SoundcloudService;
use Bolt\Storage\EntityManager;
use Bolt\Storage\Field\Type\FieldTypeBase;
use Bolt\Storage\QuerySet;
use Doctrine\DBAL\Types\Type;
use Silex\Application;

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

    // /**
    //  * 
    //  */
    // public function persist(QuerySet $queries, $entity, EntityManager $em = null)
    // {
    //     $key = $this->mapping['fieldname'];
    //     $qb = $queries->getPrimary();
        
    //     $value = $entity->get($key);


    //     $qb->setValue($key, ':' . $key);
    //     $qb->set($key, ':' . $key);
    //     $qb->setParameter($key, $key);
    // }

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
            $this->set($entity, $val);
        }
    }

    public function set($entity, $value)
    {
        
        /** @var Application */
        $app = $entity->app;

        /** @var SoundcloudService */
        $scService = $app["soundcloud.api"];

        $scAlbum = $scService->getAlbum($value);

        // dump($scAlbum);

        parent::set($entity, $scAlbum);
    }

    public function getTemplate()
    {
        return '@soundcloud/_soundcloud.twig';
    }
}