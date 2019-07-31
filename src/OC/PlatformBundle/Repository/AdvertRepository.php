<?php

namespace OC\PlatformBundle\Repository;

use Doctrine\ORM\QueryBuilder;

/**
 * AdvertRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdvertRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAdvertWithCategories(array $categoryNames)
    {
        $qb = $this->createQueryBuilder('a');

        $qb->join('a.categories', 'c')
            ->addSelect('c');

        $qb->where($qb->expr()->in('c.name', $categoryNames));

        return $qb
            ->getQuery()
            ->getResult();
    }


    public function myFindAll()
    {
        /*Toutes les étapes
        //récupération en passant par l'EntityManager
        $queryBuilderOldManner = $this->_em->createQueryBuilder()
            ->select('a')
            ->from($this->_entityName, 'a');

        //récupération direct (préférable)
        $queryBuilder = $this->createQueryBuilder('a');

        //On récupère el Query à partir du Query
        $query = $queryBuilder->getQuery();

        //On récupère les résultats
        $results = $query->getResult();

        //on retourne les résultats
        return $results;
        */


        /*en raccourci*/

        return $this->createQueryBuilder('a')->getQuery()->getResult();
    }

    public function testFindAll()
    {
        $test = 'test';

        return $test;
    }

    public function myFindOne($id)
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->where('a.id = :id')
            ->setParameter('id', $id);

        return $qb
            ->getQuery()
            ->getResult();
    }


    public function findByAuthorAndDate($author, $year)
    {
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.author = :author')
            ->setParameter('author', $author)
            ->andWhere('a.date < :year')
            ->setParameter('year', $year)
            ->orderBy('a.date', 'DESC');

        return $qb
            ->getQuery()
            ->getResult();
    }

    public function whereCurrentYear(QueryBuilder $qb)
    {
        $qb
            ->andWhere('a.date BETWEEN :start AND :end')
            ->setParameter('start', new \DateTime(date('Y') . '-01-01'))// Date entre le 1er janvier de cette année
            ->setParameter('end', new \DateTime(date('Y') . '-12-31'))  // Et le 31 décembre de cette année
        ;
    }


    public function myFind()
    {
        $qb = $this->createQueryBuilder('a');

        // On peut ajouter ce qu'on veut avant
        $qb
            ->where('a.author = :author')
            ->setParameter('author', 'Marine');

        // On applique notre condition sur le QueryBuilder
        $this->whereCurrentYear($qb);

        // On peut ajouter ce qu'on veut après
        $qb->orderBy('a.date', 'DESC');

        return $qb
            ->getQuery()
            ->getResult();
    }

    //requete avec jointure
    public function getAdvertWithApplications()
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->leftJoin('a.applications', 'app')
            ->addSelect('app');

        return $qb
            ->getQuery()
            ->getResult();
    }

}
