<?php

/* 
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Facade;


use Prg\Exception\PrgException;
use Prg\Factory\Mapper\MapperFactoryInterface;
use Prg\Factory\Service\ServiceFactoryInterface;
use Prg\Strategy\DownloadStrategyInterface;

class ExchangeFacade implements ExchangeFacadeInterface
{
    protected $mapperFactory;
    protected $serviceFactory;

    public function __construct(
        MapperFactoryInterface $mapperFactory,
        ServiceFactoryInterface $serviceFactory,
        DownloadStrategyInterface $downloadStrategy
    ) {
        $this->mapperFactory = $mapperFactory;
        $this->serviceFactory = $serviceFactory;
        $this->downloadStrategy = $downloadStrategy;
    }
    /**
     * Upload file.
     *
     * @param  array $request
     * @return array
     */
    public function uploadFile($request)
    {
        $loggerService = $this->serviceFactory->createLoggerService();

        if (!isset($request['file']['name']) ||
            !isset($request['file']['tmp_name']) ||
            !isset($request['file']['size'])) {
            $loggerService->log('Bad request from IP - '.$_SERVER['REMOTE_ADDR']);
            throw new PrgException(_('Bad request.'));
        }
        
        $storageMapper = $this->mapperFactory->createStorageMapper();
        $storageRecord = $storageMapper->toEntity(array());
        
        if (isset($request['iscredential']) && $request['iscredential'] == 'on') {
            if (strlen($request['credential']) > 0 && strlen($request['credential']) < 32) {
                $bcrypt = $this->serviceFactory->createBcrypt();
                $storageRecord->setCredential($bcrypt->create($request['credential']));
            } else {
                $loggerService->log('Input incorrect password for file from ip - '.$_SERVER['REMOTE_ADDR']);
                throw new PrgException(_('Password must contain 1 - 32 symbols.'));
            }
        }
        $storageRecord->setName(htmlspecialchars($request['file']['name']));
        $storageRecord->setSize($request['file']['size']);
        $storageRecord->setDownloaded(0);
        $storageRecord->setTimeStamp(new \DateTime());
        $storageRecord->setRemoteAddr($_SERVER['REMOTE_ADDR']);

        $fsService = $this->serviceFactory->createFSService();
        do {
            $storageRecord->setPath($fsService->getNewPath());
        } while ($storageMapper->checkPathExists($storageRecord->getPath()));

        $fsService->createPath($storageRecord->getPath());
        $fsService->moveToPath(
            $request['file']['tmp_name'],
            $storageRecord->getPath(),
            $storageRecord->getName()
        );

        $loggerService->log('Add file (/'.$storageRecord->getPath().'/'.$storageRecord->getName().') from IP '.$_SERVER['REMOTE_ADDR']);
        $storageMapper->add($storageRecord);
        return $storageMapper->toArray($storageRecord);
    }
    /**
     * Download file.
     *
     * @param  string $path
     * @return Response
     */
    public function downloadFile($path) 
    {
        $storageMapper = $this->mapperFactory->createStorageMapper();
        $storageRecord = $storageMapper->getByPath($path);
        $fsService = $this->serviceFactory->createFSService();
        $fullPath = $fsService->getFullPath($storageRecord->getPath(), $storageRecord->getName());
        $storageRecord->setDownloaded($storageRecord->getDownloaded() + 1);
        $storageMapper->edit($storageRecord);
        return $this->downloadStrategy->downloadFile($fullPath);
    }
    /**
     * Get file info by path.
     *
     * @param  string $path
     * @return int
     */
    public function getFileInfo($path)
    {
        $storageMapper = $this->mapperFactory->createStorageMapper();
        $storageRecord = $storageMapper->getByPath($path);
        return $storageMapper->toArray($storageRecord);
    }
    /**
     * Check password before download.
     *
     * @param  string $credential
     * @param  string $path
     * @return int
     */
    public function auth($credential, $path)
    {
        $storageMapper = $this->mapperFactory->createStorageMapper();
        $bcrypt = $this->serviceFactory->createBcrypt();
        $storageRecord = $storageMapper->getByPath($path);
        if (!$bcrypt->verify($credential, $storageRecord->getCredential())) {
            return 0;
        }
        return 1;
    }
    /**
     * Get storage list.
     *
     * @param  int $id
     * @return Paginator
     */
    public function getStorageList($page, $filter)
    {
        $storageMapper = $this->mapperFactory->createStorageMapper();
        return $storageMapper->getStorageList($page, $filter);
    }
    /**
     * Delete file & path from storage & record from base.
     *
     * @param  int $id
     * @return void
     */
    public function deleteStorage($id)
    {
        $storageMapper = $this->mapperFactory->createStorageMapper();
        $storageRecord = $storageMapper->getById($id);
        $fsService = $this->serviceFactory->createFSService();
        $fsService->deleteFromPath($storageRecord->getPath(), $storageRecord->getName());
        $storageMapper->delete($id);
    }
}

