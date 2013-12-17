<?php
namespace Etunote\Form;

use Zend\Form\Form;

class EtunoteForm extends Form
{
	public function __construct($name = null)
	{
		// we want to ignore the name passed
		parent::__construct('etunote');

		$this->add(array(
				'name' => 'id',
				'type' => 'Hidden',
		));
		$this->add(array(
				'name' => 'etu',
				'type' => 'Text',
				'options' => array(
						'label' => 'Etu',
				),
		));
		$this->add(array(
				'name' => 'exercice',
				'type' => 'Text',
				'options' => array(
						'label' => 'Exercice',
				),
		));
		$this->add(array(
				'name' => 'cours',
				'type' => 'Text',
				'options' => array(
						'label' => 'Cours',
				),
		));
		$this->add(array(
				'name' => 'note',
				'type' => 'int',
				'options' => array(
						'label' => 'Note',
				),
		));
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Go',
						'id' => 'submitbutton',
				),
		));
	}
}