<?php

namespace OC\PlatformBundle\Repository;

/**
 * ApplicationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ApplicationRepository extends \Doctrine\ORM\EntityRepository
{

    public function getApplicationsWithAdvert($limit)
    {
        $qb = $this->createQueryBuilder('a');

        //jointure avec entité advert alias adv
        $qb->join('a.advert', 'adv')
            ->addSelect('adv');

        // limit nbre resultats
        $qb->setMaxResults($limit);

        // retourne resultat
        return $qb
            ->getQuery()
            ->getResult();
    }


}
