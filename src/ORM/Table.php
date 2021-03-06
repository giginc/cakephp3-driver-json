<?php

namespace Giginc\Json\ORM;

use BadMethodCallException;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\ORM\Table as CakeTable;
use Exception;
use Giginc\Json\Database\Driver\Json;

class Table extends CakeTable
{
    protected $_query;

    /**
     * return Json file
     *
     * @return file
     * @throws Exception
     */
    private function _getConnection()
    {
        $driver = $this->getConnection()->getDriver();
        if (!$driver instanceof Json) {
            throw new Exception("Driver must be an instance of 'Giginc\Json\Database\Driver\Json'");
        }
        $json = $driver->getConnection($this->getTable());

        return $json;
    }

    /**
     * Creates a new Query instance for a table.
     *
     * @return \Cake\ORM\Query
     */
    public function query()
    {
        return $this->_getConnection();
    }

    /**
     * always return true because Json is schemaless
     *
     * @param string $field
     * @return bool
     * @access public
     */
    public function hasField($field)
    {
        return true;
    }

    /**
     * find documents
     *
     * @param string $type
     * @param array $options
     * @return Array
     * @access public
     * @throws \Exception
     */
    public function find($type = '.', $options = [])
    {
        $query = $this->query();
        return $query->from($type);
    }

    /**
     * get the document by _id
     *
     * @param string $primaryKey
     * @param array $options
     * @return \Cake\ORM\Entity
     * @access public
     * @throws \Exception
     */
    public function get($primaryKey, $options = [])
    {
        $query = $this->query();
        return $query->find($primaryKey);
    }

    /**
     * remove one document
     *
     * @param \Cake\Datasource\EntityInterface $entity
     * @param array $options
     * @return bool
     * @access public
     */
    public function delete(EntityInterface $entity, $options = [])
    {
        return false;
    }

    /**
     * delete all rows matching $conditions
     * @param $conditions
     * @return int
     * @throws \Exception
     */
    public function deleteAll($conditions = null)
    {
        return false;
    }

    /**
     * save the document
     *
     * @param EntityInterface $entity
     * @param array $options
     * @return mixed $success
     * @access public
     * @throws \Exception
     */
    public function save(EntityInterface $entity, $options = [])
    {
        return false;
    }

    public function updateAll($fields, $conditions)
    {
        return false;
    }
}
