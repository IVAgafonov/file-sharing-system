<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Cms\Mapper;


use Sms\Entity\UserInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\ORM\Tools\Pagination\Paginator;

class UserMapper implements UserMapperInterface
{
    protected $entityManager;
    protected $userEntity;

    public function __construct($entityManager, UserInterface $userEntity)
    {
        $this->entityManager = $entityManager;
        $this->userEntity = $userEntity;
    }
    /**
     * Convert User (UserInterface) to array.
     *
     * @param  UserInterface $user
     * @return array
     */
    public function toArray(UserInterface $user)
    {
        $hydrator = new DoctrineHydrator($this->entityManager);
        return $hydrator->extract($user);
    }
    /**
     * Convert array to User (UserInterface).
     *
     * @param  array $array
     * @return UserInterface
     */    
    public function toEntity($array)
    {
        $hydrator = new DoctrineHydrator($this->entityManager);
        return $hydrator->hydrate($array, $this->userEntity);
    }
    /**
     * Add user.
     *
     * @param  UserInterface $user
     * @return int
     */
    public function add(UserInterface $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user->getId();
    }
    /**
     * Edit user.
     *
     * @param  UserInterface $user
     * @return int
     */
    public function edit(UserInterface $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user->getId();
    }
    /**
     * Delete user by id.
     *
     * @param  int $id
     * @return int
     */
    public function delete($id)
    {
        $this->entityManager->getRepository(get_class($this->userEntity))->createQueryBuilder('p')
            ->delete(get_class($this->userEntity), 'p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        return 0;
    }
    /**
     * Get user by id.
     *
     * @param  int $id
     * @return UserInterface
     */
    public function getById($id)
    {
        $user = $this->entityManager->getRepository(
            get_class($this->userEntity)
        )->findBy(array('user_id' => $id));
        if (empty($user)) {
            return 0;
        }
        return $user[0];
    }
    /**
     * Get list of users by page.
     *
     * @param  int $page
     * @return Doctrine\ORM\Tools\Pagination\Paginator
     */
    public function getUserList($page)
    {
        $limit = 10;
        $offset = ($page == 0) ? 0 : ($page - 1) * $limit;
        $userList = $this->entityManager->getRepository(get_class($this->userEntity))->createQueryBuilder('u')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery();

        if (empty($userList->getResult())) {
            return 0;
        }

        $paginator = new Paginator($userList);
        return $paginator;
    }
}

