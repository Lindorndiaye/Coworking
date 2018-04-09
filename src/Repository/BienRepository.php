<?php

namespace App\Repository;


use App\Entity\TypeBien;
use App\Entity\Localite;
use App\Entity\Image;
use App\Entity\Reservation;

use App\Entity\Bien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bien[]    findAll()
 * @method Bien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bien::class);
    }
    
    
        public function countReservation($idbien){
            $qb = $this
            ->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->where('r.bien_id = :idbien')
            ->setParameter('idbien',$idbien);
            return $qb
            ->getQuery()
            ->getSingleScalarResult();
           
        }
    
        public function findBiens($idLocalite=0,$idType=0,$budget=0)
        {
            $dql = "SELECT b, i FROM App\Entity\Bien  b 
            left Join b.images i Join b.TypeBien t Join b.Localite l WHERE b.etat = 1";
    
           
    
    
            
            if ($idLocalite != 0) {
                $dql .= ' AND l.id = :idLoc';
            }
            if ($idType != 0) {
                $dql .= ' AND t.id = :idType';
            }
            if ($budget != 0) {
                $dql .= ' AND b.prixlocation BETWEEN :prixMin AND :prixMax';
            }
     
            $query = $this->getEntityManager()->createQuery($dql);
     
            if ($idLocalite != 0) {
                $query->setParameter('idLoc', $idLocalite);
            }
            if ($idType != 0) {
                $query->setParameter('idType', $idType);
            }
            if ($budget != 0) {
                $query->setParameter('prixMin', $budget - 10000)
                ->setParameter('prixMax', $budget + 20000);
            }
    
     
            return $query->getResult();
        }
    
    
        /****trouver les biens independamment des etats */
        public function findBienWhitoutEtat()
          {
            $dql = "SELECT b, i FROM App\Entity\Bien  b 
            left Join b.images i Join b.TypeBien t Join b.Localite l order by b.id ";
    
           $query = $this->getEntityManager()->createQuery($dql);
     
            return $query->getResult();
          }
    
           /**Trouver un bien a reserver +description+image by id */
        public function FindBienById($id)
        {
            $dql = "SELECT b, i FROM App\Entity\Bien  b 
            left Join b.images i Join b.TypeBien t Join b.Localite l  WHERE b.id = :id";
            $query = $this->getEntityManager()->createQuery($dql);
            $query->setParameter('id', $id);
    
              return $query->getResult();   
        }
    
    
               /** Touver la list des 6 premiers biens diponibles */
       public function list6Biens($idLocalite=0,$idType=0,$budget=0)
          {
            $dql = "SELECT b, i FROM App\Entity\Bien  b 
            left Join b.images i Join b.TypeBien t Join b.Localite l WHERE b.etat = 1  ";
             $query = $this->getEntityManager()->createQuery($dql);
              return $query->getResult();
          }
    
          
       
    
    
    
          /** Update etat du bien en 0 => non disponible */
         public function updateEtatBien($id)
         {
            
            $dql =   "UPDATE  App\Entity\Bien b   SET b.etat = 0 WHERE b.id = :id";
            
             $query = $this->getEntityManager()->createQuery($dql);
             $query->setParameter('id', $id);
     
               return $query->getResult();   
         }
    

//    /**
//     * @return Bien[] Returns an array of Bien objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bien
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function findBySearch(){
        $query = $this->createQueryBuilder('b')
    ->join('b.localite', 'l')
    ->join('b.typebien', 't')
    ->addSelect('l')
    ->addSelect('t')    
    ->WHERE('l.id = :localite OR t.id = :typebien OR b.prixlocation BETWEEN :prixMin and :prixMax')
    ->setParameters(array('localite' => $localite, 'typebien' => $typebien,'prixMin'=>$prixlocation-20000,'prixMax'=>$prixlocation+20000));

    return $query->getQuery()->getResult();
}


}
