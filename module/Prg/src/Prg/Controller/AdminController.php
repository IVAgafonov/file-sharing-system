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

class AdminController extends AbstractActionController
{
    protected $exchangeFacade;

    public function __construct(ExchangeFacadeInterface $exchangeFacade)
    {
        $this->exchangeFacade = $exchangeFacade;
    }

    public function indexAction()
    {
        $filter = $this->params()->fromRoute('filter', null);
        $page = $this->params()->fromRoute('page', 1);
        if ($this->request->isPost()) {
            if (isset($this->getRequest()->getPost()->toArray()['filter'])) {
                $filter = htmlspecialchars($this->getRequest()->getPost()->toArray()['filter']);
                return $this->redirect()->toRoute('admin', array('page' => 1, 'filter' => $filter));
            }
            if (isset($this->getRequest()->getPost()->toArray()['delete'])) {
                $id = htmlspecialchars($this->getRequest()->getPost()->toArray()['delete']);
                $this->exchangeFacade->deleteStorage($id);
                $this->flashMessenger()->addSuccessMessage(_('File successfully deleted'));
                return $this->redirect()->toRoute('admin', array('page' => $page, 'filter' => $filter));
            }
        }
        $storageList = $this->exchangeFacade->getStorageList($page, $filter);
        return new ViewModel(array('storageList' => $storageList, 'page' => $page, 'filter' => $filter));
    }
}

