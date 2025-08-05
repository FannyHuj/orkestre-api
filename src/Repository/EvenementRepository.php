<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Dto\EvenementFiltersDto;
use App\Entity\User;
use App\Entity\UserEvenement;

/**
 * @extends ServiceEntityRepository<Evenement>
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

    public function save(Evenement $evenement){
        $this->getEntityManager()->persist($evenement);
        $this->getEntityManager()->flush();
    }

     public function findAllEvenements(){
        $qbf = $this->createQueryBuilder('evenement');
        $qbf->where ('evenement.evenementDate >= :date');
        $qbf->setParameter('date', new \DateTime());
        $query = $qbf->getQuery();
        return $query->execute();
    }

    public function findFilteredEvenements(EvenementFiltersDto $filtersDto){
       
        $qbf = $this->createQueryBuilder('evenement');

         if($filtersDto->getDate() !== null) {
            
            $qbf ->where ('evenement.evenementDate >= :date');
            $qbf->setParameter('date', $filtersDto->getDate()) ;
        }
        

    if($filtersDto->getPriceMax() !==0)
     {
         $qbf->andWhere('evenement.price <= :priceMax');
          $qbf->setParameter('priceMax', $filtersDto->getPriceMax());
    } 
   

    if($filtersDto->getCategory() !== null) {
        $qbf->andWhere('evenement.category = :category');
    }

   
    
        
    if($filtersDto->getCategory() !== null) {
        $qbf->setParameter('category', $filtersDto->getCategory());
    }

        $query = $qbf->getQuery();
        return $query->execute();
    }

     public function findEvenementById($id){

        return $this->find($id);
    }



    
    public function cancelEvenementByOrganizer ($id){

        $this->getEntityManager()->remove($id);
        
        $this->getEntityManager()->flush();

       
    }



    //    /**
    //     * @return Evenement[] Returns an array of Evenement objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Evenement
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
