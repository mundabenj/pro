<?php
/**
 * Class:        dbConnection (MySQLi, PDO)
 * Developer:    Mundabenj
 * Date:         2025-09-19
 * Description:  Multi-Database Connector supporting MySQLi and PDO.
 * Website:      https://elearning.strathmore.edu/
 */
/******************************************************************************************
 * Database Connections
 * Usage Example:
 * $db = new dbConnection('MySQLi', 'localhost', 'dbname', 'user', 'pass', 3306);
 * or
 * $db = new dbConnection('PDO', 'localhost', 'dbname', 'user', 'pass', 3306);
******************************************************************************************/
class dbConnection{
    //constructor creation
    
    private $connection;
    private $db_type;
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_port;
    private $posted_values;
    
    // * $db = new dbConnection('PDO', 'localhost', 'dbname', 'user', 'pass', 3306);
    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $DB_PORT) {
        $this->db_type      = $DB_TYPE;
        $this->db_host      = $DB_HOST;
        $this->db_name      = $DB_NAME;
        $this->db_user      = $DB_USER;
        $this->db_pass      = $DB_PASS;
        $this->db_port      = $DB_PORT;
        $this->connection($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $DB_PORT);
    }
    public function connection($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $DB_PORT){
        switch ($DB_TYPE) {
            case 'MySQLi':
                if($DB_PORT<>Null){
                    $DB_HOST.=":".$DB_PORT;
                }
                $this->connection = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
                if ($this->connection->connect_error) { return "Connection failed: " . $this->connection->connect_error; }else{
                    // print "Connected successfully with ".$DB_TYPE;
                }
                break;
            case 'PDO':
                if($DB_PORT<>Null){
                    $DB_HOST.="";
                }
                try {
                    $this->connection = new PDO("mysql:host=$DB_HOST:$DB_PORT;dbname=$DB_NAME", $DB_USER, $DB_PASS);
                    // set the PDO error mode to exception
                    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // print "Connected successfully with ".$DB_TYPE;
                } catch(PDOException $e) {
                    die("Connection failed: " . $e->getMessage());
                }
                break;
        }
    }
    /******************************************************************************************
    Close Database Connection
     ******************************************************************************************/
    public function closeConnection() {
        switch ($this->db_type) {
            case 'MySQLi':
                if ($this->connection instanceof mysqli) {
                    $this->connection->close();
                }
                break;
            case 'PDO':
                $this->connection = null;
                break;
        }
    }
    /******************************************************************************************
    MySQLi Real Escape String (tested)
     ******************************************************************************************/
    public function escape_values($posted_values): string
    {
        switch ($this->db_type) {
            case 'MySQLi':
                if ($this->connection instanceof mysqli) {
                    $this->posted_values = $this->connection->real_escape_string($posted_values);
                } else {
                    // Fallback: use addslashes if not a mysqli instance
                    $this->posted_values = addslashes($posted_values);
                }
                break;
            case 'PDO':
                $this->posted_values = addslashes($posted_values);
                break;
        }
        return $this->posted_values;
    }
    /******************************************************************************************
    Count Returned Results (tested)
     ******************************************************************************************/
    public function count_results($sql){
        switch ($this->db_type) {
            case 'MySQLi':
                $result = $this->connection->query($sql);
                if ($result instanceof mysqli_result === TRUE) {
                    $count_results = $result->num_rows;
                } elseif ($result instanceof mysqli_result === FALSE) {
                    $count_results = 0;
                }
                break;
            case 'PDO':
                $res = $this->connection->prepare($sql);
                if ($res === false) {
                    print "Error 5: " . $sql . "<br />" . implode(" | ", $this->connection->errorInfo()) . "<br />";
                    $count_results = 0;
                } else {
                    $res->execute();
                    $count_results = $res->rowCount();
                }
                break;
        }
        return $count_results;
    }
    /******************************************************************************************
    Insert Query (extracted) (tested)
     ******************************************************************************************/
    public function insert($table, $data){
        ksort($data);
        $fieldDetails = NULL;
        $fieldNames = implode('`, `',  array_keys($data));
        $fieldValues = implode("', '",  array_values($data));
        $sth = "INSERT INTO $table (`$fieldNames`) VALUES ('$fieldValues')";
        return $this->extracted($sth);
    }
    /******************************************************************************************
    Select Query From a DataBase
     ******************************************************************************************/
    public function select($sql){
        switch ($this->db_type) {
            case 'MySQLi':
                $result = $this->connection->query($sql);
                if ($result instanceof mysqli_result) {
                    $select_res = $result->fetch_assoc();
                } else {
                    $select_res = false;
                }
                break;
            case 'PDO':
                $result = $this->connection->prepare($sql);
                $result->execute();
                $select_res = $result->fetchAll(PDO::FETCH_ASSOC)[0];
                break;
        }
        return $select_res;
    }
    /******************************************************************************************
    Select Query While Loop From a DataBase (tested)
     ******************************************************************************************/
    public function select_while($sql){
        switch ($this->db_type) {
            case 'MySQLi':
                $result = $this->connection->query($sql);
                $res = array();
                if ($result instanceof mysqli_result) {
                    while ($row = $result->fetch_assoc()) {
                        $res[] = $row;
                    }
                }
                $select_while = $res;
                break;
            case 'PDO':
                $result = $this->connection->prepare($sql);
                $result->execute();
                $select_while = $result->fetchAll(PDO::FETCH_ASSOC);
                break;
        }
        return $select_while;
    }
    /******************************************************************************************
    Update Query (extracted) (tested)
     ******************************************************************************************/
    public function update($table, $data, $where){
        $wer = '';
        if (is_array($where)) {
            foreach ($where as $clave => $value) {
                $wer .= $clave . "='" . $value . "' AND ";
            }
            $wer = substr($wer, 0, -5); // trim trailing ' AND '
            $where = $wer;
        }

        ksort($data);
        $fieldDetails = '';
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                $fieldDetails .= "$key=NULL,";
            } else {
                $fieldDetails .= "$key='" . addslashes($value) . "',";
            }
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = "UPDATE $table SET $fieldDetails";
        if (!empty($where)) {
            $sth .= " WHERE $where";
        }

        return $this->extracted($sth);
    }
    /******************************************************************************************
    Delete Query (extracted) (tested)
     ******************************************************************************************/
    public function delete($table,$where){
        $wer = '';
        if(is_array($where)){
            foreach ($where as $clave=>$value){
                $wer.= $clave."='".$value."' and ";
            }
            $wer   = substr($wer, 0, -4);
            $where = $wer;
        }
        if($where==NULL or $where==''){
            $sth = "DELETE FROM $table";
        }else{
            $sth = "DELETE FROM $table WHERE $where";
        }
            return $this->extracted($sth);
    }
    /******************************************************************************************
    Truncate Query (extracted)
     ******************************************************************************************/
    public function truncate($table){
        $sth = "TRUNCATE $table";
        return $this->extracted($sth);
    }
	
	/******************************************************************************************
	Get ID of Last Inserted Record
	******************************************************************************************/
	public function last_id(){
		switch ($this->db_type) {
        case 'MySQLi':
            if ($this->connection instanceof mysqli) {
                $last_id = $this->connection->insert_id;
            } else {
                $last_id = null;
            }
        break;
		case 'PDO':
			$last_id = $this->connection->lastInsertId();
		break;
		}
		return $last_id;
	}

	/******************************************************************************************
	Method to execute custom migrations queries (tested) for DROP, CREATE, ALTER
	******************************************************************************************/

    // Method to Disable Foreign Key Checks in MySQL
    public function disableForeignKeyChecks() {
        $sql = "SET FOREIGN_KEY_CHECKS = 0";
        return $this->extracted($sql);
    }

    // Method to Enable Foreign Key Checks in MySQL
    public function enableForeignKeyChecks() {
        $sql = "SET FOREIGN_KEY_CHECKS = 1";
        return $this->extracted($sql);
    }

        // Method to drop a table (for testing purposes)
    public function dropTable($tableName) {
        $sql = "DROP TABLE IF EXISTS `$tableName`";
        return $this->extracted($sql);
    }

    // Method to create a table (for testing purposes)
    public function createTable($tableName, $columns) {
        $columnsSql = [];
        foreach ($columns as $columnName => $dataType) {
            $columnsSql[] = "`$columnName` $dataType";
        }
        $columnsSqlString = implode(", ", $columnsSql);
        $sql = "CREATE TABLE IF NOT EXISTS `$tableName` ($columnsSqlString)";
        return $this->extracted($sql);
    }

    // Alter table to add foreign key constraints
    public function addConstraint($table, $ref_table, $column, $on_delete, $on_update) {
        $constraint_name = "{$table}_{$column}_fk";
        $sql = "ALTER TABLE `$table` ADD CONSTRAINT `$constraint_name` FOREIGN KEY (`$column`) REFERENCES $ref_table ON DELETE $on_delete ON UPDATE $on_update";
        return $this->extracted($sql);
    }

    // Method to add columns to an existing table (for testing purposes)
    public function addColumn($tableName, $columnName, $dataType) {
        $sql = "ALTER TABLE `$tableName` ADD COLUMN `$columnName` $dataType";
        return $this->extracted($sql);
    }

    // Method to remove columns from an existing table (for testing purposes)
    public function removeColumn($tableName, $columnName) {
        $sql = "ALTER TABLE `$tableName` DROP COLUMN `$columnName`";
        return $this->extracted($sql);
    }

    // Method to rename columns in an existing table (for testing purposes)
    public function renameColumn($tableName, $oldColumnName, $newColumnName, $dataType) {
        $sql = "ALTER TABLE `$tableName` CHANGE `$oldColumnName` `$newColumnName` $dataType";
        return $this->extracted($sql);
    }

    /******************************************************************************************
    Extracted (tested)
     ******************************************************************************************/
    /**
     * @param string $sth
     * @return bool|string|void
     */
    public function extracted(string $sth)
    {
        switch ($this->db_type) {
            case 'MySQLi':
                if ($this->connection->query($sth) === TRUE) {
                    $extracted_result = TRUE;
                } else {
                    $extracted_result = 0;
                }
                break;
            case 'PDO':
                try {
                    // Prepare statement
                    $stmt = $this->connection->prepare($sth);
                    // execute the query
                    $stmt->execute();
                    $extracted_result = TRUE;
                } catch (PDOException $e) {
                    $extracted_result = $sth . "<br />" . $e->getMessage();
                }
                break;
        }
        return $extracted_result;
    }
}