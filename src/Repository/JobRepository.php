<?php

namespace App\Repository;

use App\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Job|null find($id, $lockMode = null, $lockVersion = null)
 * @method Job|null findOneBy(array $criteria, array $orderBy = null)
 * @method Job[]    findAll()
 * @method Job[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Job::class);
    }


    public function getJobsFromSearch($search){
        $qb = $this ->createQueryBuilder("job")
                    ->select("job")
                    ->join("job.skills", "s")
                    ->groupBy("job.id");

        if(! empty($search["jobTitle"])){
            $qb ->andWhere("job.title LIKE :title")
                ->setParameter('title', "%".$search["jobTitle"]."%");
        }

        if(!empty($search["skills"])){
            $skillArray = explode(",", $search["skills"]);
            $skillArray = array_map(
                function ($item){
                    return trim($item);
                },
                $skillArray
            );
            $skillArray = array_unique($skillArray);

            for($i=0; $i< count($skillArray); $i++){
                if(!empty($skillArray[$i])){
                    $key = ":skill_$i";
                    $criteria = "s.skillName= :skill_$i";

                    dump($criteria);
                    $qb ->andWhere($criteria)
                        ->setParameter($key, $skillArray[$i]);
                }
            }
        }

        return $qb->getQuery()->getResult();

    }

    // /**
    //  * @return Job[] Returns an array of Job objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Job
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
