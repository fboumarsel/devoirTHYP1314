<?php 
namespace Etunote\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Zend\Form\Annotation\AnnotationBuilder;
 use Etunote\Model\Etunote;
 use Etunote\Form\EtunoteForm;
 
 class EtunoteController extends AbstractActionController
 {
     protected $etunoteTable;
     
     public function indexAction()
     {
         return new ViewModel(array(
         		'etunotes' => $this->getEtunoteTable()->fetchAll(),
         ));
         
         
         
     }

     public function addAction()
     {
         $form = new EtunoteForm();
         $form->get('submit')->setValue('Add');
         
         
         $request = $this->getRequest();
         if ($request->isPost()) {
         	$etunote = new Etunote();
         	$form->setInputFilter($etunote->getInputFilter());
         	$form->setData($request->getPost());
         
         	if ($form->isValid()) {
         		$etunote->exchangeArray($form->getData());
         		$this->getEtunoteTable()->saveEtunote($etunote);
         		

         		// Redirect to list of note
         		return $this->redirect()->toRoute('etunote');
         	}
         		
         }
         
         return array('form' => $form);
     }

     public function editAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
         	return $this->redirect()->toRoute('etunote', array(
         			'action' => 'add'
         	));
         }
         
         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
         	$etunote = $this->getEtunoteTable()->getEtunote($id);
         }
         catch (\Exception $ex) {
         	return $this->redirect()->toRoute('etunote', array(
         			'action' => 'index'
         	));
         }
         
         $form  = new EtunoteForm();
         $form->bind($etunote);
         $form->get('submit')->setAttribute('value', 'Edit');
         
         $request = $this->getRequest();
         if ($request->isPost()) {
         	$form->setInputFilter($etunote->getInputFilter());
         	$form->setData($request->getPost());
         
         	if ($form->isValid()) {
         		$this->getEtunoteTable()->saveEtunote($etunote);
         
         		// Redirect to list of albums
         		return $this->redirect()->toRoute('etunote');
         	}
         }
         
         return array(
         		'id' => $id,
         		'form' => $form,
         );
     }

     public function deleteAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
         	return $this->redirect()->toRoute('etunote');
         }
         
         
         $request = $this->getRequest();
         if ($request->isPost()) {
         	$del = $request->getPost('del', 'No');
         
         	if ($del == 'Yes') {
         		$id = (int) $request->getPost('id');
         		$this->getEtunoteTable()->deleteEtunote($id);
         	}
         
         	// Redirect to list of albums
         	return $this->redirect()->toRoute('etunote');
         }
         
         return array(
         		'id'    => $id,
         		'etunote' => $this->getEtunoteTable()->getEtunote($id)
         );
     }
     public function getEtunoteTable()
     {
         
     	if (!$this->etunoteTable) {
     		$sm = $this->getServiceLocator();
     		$this->etunoteTable = $sm->get('Etunote\Model\EtunoteTable');
     	}
     	return $this->etunoteTable;
     }
     
     
     
    
 }
 
 ?>