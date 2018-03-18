<?php

namespace N9Bundle\Repository;

/**
 * ExperienceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ExperienceRepository extends \Doctrine\ORM\EntityRepository
{
    public function getExperiencesWithCompany()
    {
        $qb = $this->createQueryBuilder('exp');

        $qb
            ->select('exp')
            ->innerJoin('exp.company', 'comp')
            ->addSelect('comp')
            ->orderBy('exp.startDate', 'DESC');

        // Enfin, on retourne le résultat
        return $qb
            ->getQuery()
            ->getResult();
    }
    
    public function getExperiencesWithAll()
    {
        $qb = $this->createQueryBuilder('exp');

        $qb
            ->select('exp')
            ->innerJoin('exp.company', 'comp')
            ->addSelect('comp')
            ->leftJoin('exp.skills', 'skl')
            ->addSelect('skl')
            ->leftJoin('skl.skillType', 'typ')
            ->addSelect('typ')
          //  ->where('exp.experience_id = skl.experience_id')
            ->orderBy('exp.startDate', 'DESC')
            ->addOrderBy('skl.level', 'DESC');

        // Enfin, on retourne le résultat
        return $qb
            ->getQuery()
            ->getResult();
    }
}