<?php

namespace App\Repository;

use App\Entity\Acts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Acts>
 *
 * @method Acts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Acts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Acts[]    findAll()
 * @method Acts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActsRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Acts::class);
    }

    public function save(Acts $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Acts $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //save image to /public/images/
    public function saveImage($image, $name)
    {
        $image->move(
            $this->getParameter('images_directory'),
            $name
        );
    }
}
