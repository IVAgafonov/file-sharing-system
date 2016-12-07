<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Mapper;


use Prg\Entity\StorageInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Prg\Exception\PrgException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\Query;

class StorageMapper implements StorageMapperInterface
{
    
    protected $entityManager;
    protected $storageEntity;
    
    public function __construct(
        $entityManager,
        StorageInterface $storageEntity
    ) {
        $this->entityManager = $entityManager;
        $this->storageEntity = $storageEntity;
    }
    /**
     * Convert storage (StorageInterface) to array.
     *
     * @param  StorageInterface $storage
     * @return array
     */
    public function toArray(StorageInterface $storage)
    {
        $hydrator = new DoctrineHydrator($this->entityManager);
        return $hydrator->extract($storage);
    }
    /**
     * Convert array to storage (StorageInterface).
     *
     * @param  array $array
     * @return StorageInterface
     */    
    public function toEntity($array)
    {
        $newStorage = clone($this->storageEntity);
        $hydrator = new DoctrineHydrator($this->entityManager);
        return $hydrator->hydrate($array, $newStorage);
    }
    /**
     * Add new storage.
     *
     * @param  StorageInterface $storage
     * @return int
     */
    public function add(StorageInterface $storage)
    {
        $this->entityManager->persist($storage);
        $this->entityManager->flush();
        return $storage->getId();
    }
    /**
     * Edit storage.
     *
     * @param StorageInterface $storage
     * @return int
     */
    public function edit(StorageInterface $storage)
    {
        $this->entityManager->persist($storage);
        $this->entityManager->flush();
        return $storage->getId();
    }
    /**
     * Delete storage by id.
     *
     * @param  int $id
     * @return int
     */
    public function delete($id)
    {
        $this->entityManager->getRepository(get_class($this->storageEntity))->createQueryBuilder('d')
            ->delete(get_class($this->storageEntity), 'd')
            ->where('d.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        return 0;
    }
    /**
     * Get storage by id.
     *
     * @param  int $id
     * @return StorageInterface
     * @throws PrgException
     */
    public function getById($id)
    {
        $storage = $this->entityManager->getRepository(
            get_class($this->storageEntity)
        )->findBy(array('id' => $id));
        if (empty($storage)) {
            throw new PrgException(_('File not found'));
        }
        return $storage[0];
    }
    /**
     * Get storage by path.
     *
     * @param  string $path
     * @return StorageInterface
     * @throws PrgException
     */
    public function getByPath($path)
    {
        $storage = $this->entityManager->getRepository(
            get_class($this->storageEntity)
        )->findBy(array('path' => $path));
        if (empty($storage)) {
            throw new PrgException(_('File not found'));
        }
        return $storage[0];
    }
    /**
     * Check storage by path.
     *
     * @param  string $path
     * @return int
     */
    public function checkPathExists($path)
    {
        $storage = $this->entityManager->getRepository(
            get_class($this->storageEntity)
        )->findBy(array('path' => $path));
        if (empty($storage)) {
            return 0;
        }
        return 1;
    }
    /**
     * Get storage list by filter.
     *
     * @param  string $filter
     * @return array;
     */
    public function getStorageList($page, $filter = null)
    {
        $limit = 10;
        $offset = ($page == 0) ? 0 : ($page - 1) * $limit;
        if ($filter === null) {
            $storageList = $this->entityManager->getRepository(get_class($this->storageEntity))->createQueryBuilder('s')
                ->orderBy('s.id', 'ASC')
                ->setMaxResults($limit)
                ->setFirstResult($offset)
                ->getQuery();
        } else {
            $storageList = $this->entityManager->getRepository(get_class($this->storageEntity))->createQueryBuilder('s')
                ->where('s.path LIKE :path OR s.name LIKE :name' )
                ->orderBy('s.id', 'ASC')
                ->setMaxResults($limit)
                ->setFirstResult($offset)
                ->setParameter('name', "%$filter%")
                ->setParameter('path', "%$filter%")
                ->getQuery();
        }
        if (empty($storageList->getResult())) {
            return 0;
        }
        $paginator = new Paginator($storageList);
        return $paginator;
    }
}

