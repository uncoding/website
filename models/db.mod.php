<?php
class DB {
	private $db;
	private $config = array();
	private $data = array();

	public function __construct() {
		$config = array();
		$config['username'] = MYDB_USER;
		$config['password'] = MYDB_PASS;
		$config['dbname']	= MYDB_NAME;
		$config['char']		= MYDB_CHAR;
		$config['dsn']		= 'mysql:host='.MYDB_HOST.';port='.MYDB_PORT.';dbname='.MYDB_NAME;
		$this->config 		= $config;
		
	}
	
	/**
	 * 连接数据库
	 *
	 */
	private function _connect() {
		if($this->db!= NULL) {
			$this->db=NULL;
		}
        try{       
			$this->db = new PDO($this->config['dsn'],$this->config['username'], $this->config['password']);
			$this->db->query('SET NAMES '.$this->config['char']);      
        }catch (PDOException $e){       
            exit('连接失败:'.$e->getMessage());       
        }  
	}	
	
	
	/**
	 * 设置更新数据
	 *
	 * @param string $key
	 * @param string $value
	 */
	final public function setData($key, $value) {
		$this->data[$key][] = array('value' => $value, 'type' => 'setData');
	}

	/**
	 * 向某表中添加一条数据
	 * 本函数不允许被重载
	 *
	 * @param string	$table	表名
	 * @return boolean
	 */
	final public function insert($table) {
		$data = $this->data;
		$this->data = array();

		if (count($data) == 0) {
			return false;
		}
		
		$colStr = $valueStr = '';
		$param = array();
		foreach ($data as $k => $row) {
			if ($row[0]['type'] == 'setData') {
				$colStr .= ",`{$k}`";
				$valueStr .= ",:{$k}";
				$param[$k] = $row[0]['value'];
			} else {
				$colStr .= ",`{$k}`";
				$valueStr .= ", {$row[0]['value']}";
			}
		}
		$colStr = substr($colStr, 1);
		$valueStr = substr($valueStr, 1);

		$sql = "INSERT INTO `$table`($colStr) VALUES($valueStr)";
		$rs = $this->query($sql, $param);
		if($rs){
			return $this->db->lastInsertId();
		}
	}

	/**
	 * 删除某表中数据
	 *
	 * @param string	$table	表名
	 * @param string	$pk		主键名
	 * @param mix		$id		主键值
	 * @return boolean
	 */
	final public function delete($table) {
		$data = $this->data;
		$this->data = array();
		$param = array();
		$sql = "DELETE FROM `{$table}`"; 
		if (count($data)>0) {
			foreach ($data as $k => $row) {
				if ($row[0]['type'] == 'setData') {
					$param[$k] = $row[0]['value'];
				}
			}
			if (false !== ($con = $this->getCondition($param))){       
            	$sql .= $con;       
        	}
		}
		
		$rs = $this->query($sql);
		return $rs;
	}

	/**
	 * 根据主键更新某表中的数据
	 * 本函数不允许被重载
	 *
	 * @param string	$table	表名
	 * @param array		$data	入库的数据
	 * @param mix		$id		主键值
	 * @param string	$pk		主键名
	 * @return boolean
	 */
	final public function update($table, $pk, $id) {
		$data = $this->data;
		$this->data = array();

		if (count($data) == 0) {
			return false;
		}

		if (!is_array($id)) {
			$where = "`{$pk}` = " . $this->_quote($id);
		} else {
			$where = array();
			foreach ($id as $k => $v) {
				$where[] = "{$k} = " . $this->_quote($v);
			}
			$where = implode(' AND ', $where);
		}
		
		$valueStr = '';
		$param = array();
		$i = 0;
		foreach ($data as $k => $row) {
			foreach ($row as $v) {
				if ($v['type'] == 'setData') {
					$i++;
					$valueStr .= ",`{$k}` = :{$k}_{$i}";
					$param["{$k}_{$i}"] = $v['value'];
				} else {
					$valueStr .= ",`$k` = {$v['value']}";
				}
			}
		}
		$valueStr = substr($valueStr, 1);

		$sql = "UPDATE `{$table}` SET $valueStr WHERE $where";
		return (boolean)$this->query($sql, $param);
	}
	
	/**
	 * 查询某表中数据
	 *
	 * @param string	$table	表名
	 * @param string	$field	字段
	 * @param array		$limit	限制条数
	 * @return boolean
	 */
	final public function fetch($table,$field='*',$limit=array()) {
		$data = $this->data;
		$this->data = array();
		$param = array();
		$sql = "SELECT {$field} FROM `{$table}`"; 
		if (count($data)>0) {
			foreach ($data as $k => $row) {
				if ($row[0]['type'] == 'setData') {
					$param[$k] = $row[0]['value'];
				}
			}
			if (false !== ($con = $this->getCondition($param))){       
            	$sql .= $con;       
        	}
		}
		if(count($limit)>0){
			$skip=$limit[0];
			$limit=$limit[1];
			$sql=$sql.'limit'." $skip".","." $limit";
		}
//		return $sql;
		$rs = $this->query($sql);
		return $rs;
	}
	

	/**
	 * 配置SQL
	 */
	public function query($sql, $param = array()) {
		$sql = $this->_prepare($sql, $param);
		$rs = $this->sendQuery($sql);
		return $rs;
	}

   /**
    * 获取查询条件
    */
   public function getCondition($condition=''){       
        if ($condition != ''){       
            $con = ' WHERE';       
            if (is_array($condition)){       
                $i = 0;       
                foreach ($condition as $k => $v){       
                    if ($i != 0){       
                        $con .= " AND $k = '$v'";       
                    }else {       
                        $con .= " $k = '$v'";       
                    }       
                    $i++;       
                }       
            }elseif (is_string($condition)){       
                $con .= " $condition";       
            }else {       
                return false;       
            }       
            return $con;       
        }       
        return false;       
    }  	
	
	final protected function _prepare($sql, $param) {
		static $i = 0;
		if (!$param) {
			return $sql;
		}

		$key = $value = $keys = array();
		foreach ($param as $k => $v) {
			$keys[$k] = strlen($k);
		}
		arsort($keys);
		foreach ($keys as $k => $v) {
			$key[] = ':' . $k;
			if (!is_array($param[$k])) {
				$value[] = $this->_quote($param[$k]);
			} else {
				if (count($param[$k]) > 0) {
					foreach ($param[$k] as $itemK => $itemV) {
						$param[$k][$itemK] = $this->_quote($itemV);
					}
					$value[] = implode(", ", $param[$k]);
				} else {
					$value[] = "''";
				}
			}
		}

		// 编译SQL
		if ($key && $value) {
			$sql = str_replace($key, $value, $sql);
		}
		return $sql;
	}

	final private function _quote($value) {
		$value = addslashes($value);
		$value = is_string($value) ? "'{$value}'" : $value;
		return $value;
	}

	/**
	 * 发送sql语句
	 */
	protected function sendQuery($sql) {
		static $tryNum = 0;

		// 判断如果当前没有连接的话，则需要建立连接
		if (!$this->db) {
			// 如果重试次数超过5次，则放弃重试
//			if ($tryNum > 9) {
//				$tryNum = 0;
//				return false;
//			}
//			$tryNum++;
			$this->_connect();
		}
		
		//判断是否为select查询
		$isSelect = !preg_match('/\s*(UPDATE|DELETE|INSERT)\s*/i', $sql);
		
		// 发送SQL
		if($isSelect){
			$pdoquery=$this->db->query($sql);       
	        $this->getPDOError();       
	        $pdoquery->setFetchMode(PDO::FETCH_ASSOC);       
	        $result = $pdoquery->fetchAll();
		}else{
			$result = $this->execute($sql);
		}
		return $result;
	}
	
    /**     
     * 执行SQL查询     
     *     
     */      
    public function execute($sql){       
        $result=$this->db->exec($sql);       
        $this->getPDOError(); 
        return $result;
    }       

    /**     
     * 执行原生态SQL查询     
     *     
     */      
    public function execsql($sql){       
        $result=$this->sendQuery($sql);       
        return $result;
    }     
    /**     
     * 获取总记录数     
     *     
     */      
    public function fetchCount($sql){       
    	if (!$this->db) {
			$this->_connect();
		}
		$pdoquery=$this->db->query($sql);       
        $this->getPDOError();       
        $pdoquery->setFetchMode(PDO::FETCH_ASSOC);       
        $rowCount = $pdoquery->rowCount();
        return $rowCount;
    }        
    /**     
     * 捕获PDO错误信息     
     */      
    private function getPDOError(){
        if ($this->db->errorCode() != '00000'){       
            $error = $this->db->errorInfo();       
            exit($error[2]);       
        }       
    } 

	//关闭数据连接       
    public function __destruct(){       
        $this->db = null;       
    } 

}

