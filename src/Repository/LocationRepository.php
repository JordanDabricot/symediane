<?php

namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Location|null find($id, $lockMode = null, $lockVersion = null)
 * @method Location|null findOneBy(array $criteria, array $orderBy = null)
 * @method Location[]    findAll()
 * @method Location[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Location::class);
    }

    public function insertAddress (array $addressInfo, $user) {
        $location = new Location();
        $location->setAdresse($addressInfo['adresse']);
        $location->setCodePostal($addressInfo['codePostal']);
        $location->setPays($addressInfo['pays']);
        $location->setVille($addressInfo['ville']);
        $location->setUser($user);
        $location->setDateCommande(\DateTime::createFromFormat('Y-m-d', "2018-07-12"));

        $this->_em->persist($location);
        $this->_em->flush();
    }

    public function getAddress () {
        return $this->createQueryBuilder('l')
            ->select('l.id, u.nom, u.prenom, l.dateCommande, l.ville, l.codePostal')
            ->innerJoin('l.user', 'u')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Location[] Returns an array of Location objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Location
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
