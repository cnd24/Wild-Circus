<?php

namespace App\Repository;

use App\Entity\Representation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Representation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Representation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Representation[]    findAll()
 * @method Representation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepresentationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Representation::class);
    }


    public function findDateFromNow(int $id): array
    {

        $query = $this->createQueryBuilder('r')
            ->where('CURRENT_DATE() <= r.date')
            ->andWhere('r.event ='.$id)
            ->orderBy('r.date', 'ASC');

        return $query->getQuery()->getResult();
    }

}
