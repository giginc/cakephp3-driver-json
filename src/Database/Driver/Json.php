<?php

namespace Giginc\Json\Database\Driver;

use Exception;
use Nahid\JsonQ\Jsonq;

class Json
{
    /**
     * Config
     *
     * @var array
     * @access private
     */
    private $_config;

    /**
     * Are we connected to the DataSource?
     *
     * true - yes
     * false - nope, and we can't connect
     *
     * @var boolean
     * @access public
     */
    public $connected = false;

    /**
     * File Instance
     *
     * @var File
     * @access protected
     */
    protected $_json = null;

    /**
     * Base Config
     *
     * set_string_id:
     *        true: In read() method, convert Json\BSON\ObjectId object to string and set it to array 'id'.
     *        false: not convert and set.
     *
     * @var array
     * @access public
     *
     */
    protected $_baseConfig = [
        'path' => '', // local path on the server relative to WWW_ROOT
    ];

    /**
     * Direct connection with database
     *
     * @var mixed null | Mongo
     * @access private
     */
    private $connection = null;

    /**
     * @param array $config configuration
     */
    public function __construct($config)
    {
        $this->_config = array_merge($this->_baseConfig, $config);
    }

    /**
     * return configuration
     *
     * @return array
     * @access public
     */
    public function config()
    {
        return $this->_config;
    }

    /**
     * connect to the database
     *
     * @return bool
     * @access public
     */
    public function connect()
    {
        try {
            if (file_exists($this->_config['path'])) {
                if (($this->_json = new Jsonq($this->_config['path'])) === false) {
                    trigger_error("Could not open file.{$this->_config['path']}");

                    return false;
                }
            } else {
                trigger_error("The specified file was not found.{$this->_config['path']}");

                return false;
            }

            $this->connected = true;
        } catch (Exception $e) {
            trigger_error($e->getMessage());
        }

        return $this->connected;
    }

    /**
     * return Json file
     *
     * @access public
     */
    public function getConnection()
    {
        if (!$this->isConnected()) {
            $this->connect();
        }

        return $this->_json;
    }

    /**
     * disconnect from the database
     *
     * @return bool
     * @access public
     */
    public function disconnect()
    {
        if ($this->connected) {
            unset($this->_json, $this->connection);

            return !$this->connected;
        }

        return true;
    }

    /**
     * database connection status
     *
     * @return bool
     * @access public
     */
    public function isConnected()
    {
        return $this->connected;
    }

    /**
     * @return bool
     */
    public function enabled()
    {
        return true;
    }
}
