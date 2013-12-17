<?php 
namespace Etunote\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

 class Etunote implements InputFilterAwareInterface
 {
     public $id;
     public $etu;
     public $exercice;
     public $cours;
     public $note;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->etu = (!empty($data['etu'])) ? $data['etu'] : null;
         $this->exercice  = (!empty($data['exercice'])) ? $data['exercice'] : null;
         $this->cours  = (!empty($data['cours'])) ? $data['cours'] : null;
         $this->note  = (!empty($data['note'])) ? $data['note'] : null;
     }
     public function getArrayCopy()
     {
     	return get_object_vars($this);
     }
     
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
     	throw new \Exception("Not used");
     }
     
     public function getInputFilter()
     {
     	if (!$this->inputFilter) {
     		$inputFilter = new InputFilter();
     
     		$inputFilter->add(array(
     				'name'     => 'id',
     				'required' => true,
     				'filters'  => array(
     						array('name' => 'Int'),
     				),
     		));
     
     		$inputFilter->add(array(
     				'name'     => 'etu',
     				'required' => true,
     				'filters'  => array(
     						array('name' => 'StripTags'),
     						array('name' => 'StringTrim'),
     				),
     				'validators' => array(
     						array(
     								'name'    => 'StringLength',
     								'options' => array(
     										'encoding' => 'UTF-8',
     										'min'      => 1,
     										'max'      => 100,
     								),
     						),
     				),
     		));
     
     		$inputFilter->add(array(
     				'name'     => 'exercice',
     				'required' => true,
     				'filters'  => array(
     						array('name' => 'StripTags'),
     						array('name' => 'StringTrim'),
     				),
     				'validators' => array(
     						array(
     								'name'    => 'StringLength',
     								'options' => array(
     										'encoding' => 'UTF-8',
     										'min'      => 1,
     										'max'      => 100,
     								),
     						),
     				),
     		));
     		$inputFilter->add(array(
     				'name'     => 'cours',
     				'required' => true,
     				'filters'  => array(
     						array('name' => 'StripTags'),
     						array('name' => 'StringTrim'),
     				),
     				'validators' => array(
     						array(
     								'name'    => 'StringLength',
     								'options' => array(
     										'encoding' => 'UTF-8',
     										'min'      => 1,
     										'max'      => 100,
     								),
     						),
     				),
     		));
     		$inputFilter->add(array(
     				'name'     => 'note',
     				'required' => true,
     				'filters'  => array(
     						array('name' => 'Int'),
     				),
     		));
     
     		$this->inputFilter = $inputFilter;
     	}
     
     	return $this->inputFilter;
     }
    
 }
 
 ?>