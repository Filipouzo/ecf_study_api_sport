<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->add($user, true);
    }



    // recherche des User par role et aussi par id si ce dernier existe 
    public function findByRole($role,string $search = null)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('user')
            ->from($this->_entityName, 'user')
            ->Where('user.roles LIKE :roles')
            ->setParameter('roles', '%"'.$role.'"%')
            ->orderBy('user.name', 'ASC');

            if ($search) {
                $qb->andWhere('user.id LIKE :searchTerm')
                    ->setParameter('searchTerm', '%'.$search.'%');

            }
        return $qb->getQuery()->getResult()
        ;
    }
    
    // recherche des structures par parent (franchise) et aussi par id si ce dernier existe 
    public function findByParentId($parent,string $search = null)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('user')
            ->from($this->_entityName, 'user')
            ->Where('user.parent = :val')
            ->setParameter('val', $parent)
            ->orderBy('user.address', 'ASC');

            if ($search) {
                $qb->andWhere('user.id LIKE :searchTerm')
                    ->setParameter('searchTerm', '%'.$search.'%');
            }
        return $qb->getQuery()->getResult()
        ;
    }


    /* Recherche des administrateurs des partenaires par nom */
    public function findbyName($search,$userToAdmin)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('user')
            ->from($this->_entityName, 'user')
            ->Where('user.name LIKE :val')
            ->setParameter('val', '%'.$search.'%')
            ->andWhere('user.roles LIKE :roles')
            ->setParameter('roles', '%'.$userToAdmin.'%')
            ;
        if ($search) {
            return $qb
                ->setMaxResults(2)
                ->getQuery()
                ->getResult();
        }
    }        


    /* Recherche des structures par adresse */
    public function findByAddress($search)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('user')
            ->from($this->_entityName, 'user')
            ->Where('user.address LIKE :val')
            ->setParameter('val', '%'.$search.'%');

        if ($search) {
            return $qb
                ->setMaxResults(2)
                ->getQuery()
                ->getResult();
        }
    }
}
