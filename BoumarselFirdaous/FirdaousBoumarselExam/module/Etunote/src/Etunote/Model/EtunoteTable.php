<?php
namespace Etunote\Model;

use Zend\Db\TableGateway\TableGateway;

class EtunoteTable

{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
	    $resultSet = $this->tableGateway->select();
		
		return $resultSet;
	}

	public function getEtunote($id)
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}

	public function saveEtunote(Etunote $etunote)
	{
		$data = array(
				'etu' => $etunote->etu,
				'exercice'  => $etunote->exercice,
		        'cours'  => $etunote->cours,
		        'note'  => $etunote->note
		    
		   
		);

		$id = (int) $etunote->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getEtunote($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('etunote id does not exist');
			}
		}
	}

	public function deleteEtunote($id)
	{
		$this->tableGateway->delete(array('id' => (int) $id));
	}
}

?>