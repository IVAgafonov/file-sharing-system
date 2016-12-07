<?php

/* 
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Mapper;

use Prg\Entity\StorageInterface;

interface StorageMapperInterface
{
    /**
     * Convert storage (StorageInterface) to array.
     *
     * @param  StorageInterface $storage
     * @return array
     */
    public function toArray(StorageInterface $storage);
    /**
     * Convert array to storage (StorageInterface).
     *
     * @param  array $array
     * @return StorageInterface
     */    
    public function toEntity($array);
    /**
     * Add new storage.
     *
     * @param  StorageInterface $storage
     * @return int
     */
    public function add(StorageInterface $storage);
    /**
     * Edit storage.
     *
     * @param StorageInterface $storage
     * @return int
     */
    public function edit(StorageInterface $storage);
    /**
     * Delete storage by id.
     *
     * @param  int $id
     * @return int
     */
    public function delete($id);
    /**
     * Get storage by id.
     *
     * @param  int $id
     * @return StorageInterface
     * @throws PrgException
     */
    public function getById($id);
    /**
     * Get storage by path.
     *
     * @param  string $path
     * @return StorageInterface
     * @throws PrgException
     */
    public function getByPath($path);
    /**
     * Check storage by path.
     *
     * @param  string $path
     * @return int
     */
    public function checkPathExists($path);
    /**
     * Get storage list by filter.
     *
     * @param  string $filter
     * @return array;
     */

    public function getStorageList($page, $filter = null);
}