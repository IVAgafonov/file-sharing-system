<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Controller;


use Prg\Facade\ExchangeFacadeInterface;
use Prg\Exception\PrgException;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

class MainController extends AbstractActionController
{
    protected $exchangeFacade;

    public function __construct(ExchangeFacadeInterface $exchangeFacade)
    {
        $this->exchangeFacade = $exchangeFacade;
    }

    public function indexAction()
    {
        return new ViewModel(array());
    }

    public function uploadAction()
    {
        if ($this->request->isPost()) {
            $request = array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            try {
                $storageArray = $this->exchangeFacade->uploadFile($request);
            } catch (PrgException $ex) {
                $this->flashMessenger()->addErrorMessage($ex->getMessage());
                return $this->redirect()->toRoute('home');
            }
            return $this->redirect()->toRoute('upload', array('path' => $storageArray['path']));
        } else {
            $path = $this->params()->fromRoute('path', 0);
            if (!$path) {
                return new ViewModel(array('error' => _('File not found.')));
            }
            try {
                $storageInfo = $this->exchangeFacade->getFileInfo($path);
            } catch (PrgException $ex) {
                $this->flashMessenger()->addErrorMessage($ex->getMessage());
                return $this->redirect()->toRoute('home');
            }
            return new ViewModel($storageInfo);
        }
    }

    public function downloadAction()
    {
        $path = $this->params()->fromRoute('path', 0);
        try {
            $storageInfo = $this->exchangeFacade->getFileInfo($path);
        } catch (PrgException $ex) {
            return new ViewModel(array('error' => _('File not found.')));
        }

        if (!$this->request->isPost()) {
            return new ViewModel($storageInfo);
        }
        if (isset($storageInfo['credential']) && strlen($storageInfo['credential']) > 0) {
            $credential = $this->getRequest()->getPost()->toArray()['credential'];
            if ($this->exchangeFacade->auth($credential, $storageInfo['path'])) {
                return $this->exchangeFacade->downloadFile($storageInfo['path']);
            }
            $this->flashMessenger()->addErrorMessage(_("Password is wrong. Try again."));
            return $this->redirect()->toRoute('download', array('path' => $storageInfo['path']));
        }
        return $this->exchangeFacade->downloadFile($storageInfo['path']);
    }
}

