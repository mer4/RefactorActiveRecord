<?php
namespace database;
abstract class model {

    public function save()
    {
        if ($this->id != '') {
            $sql = $this->update();
        } else {
           $sql = $this->insert();
        }
        $db = dbConn::getConnection();
        $statement = $db->prepare($sql);
        $array = get_object_vars($this);
        foreach (array_flip($array) as $key=>$value){
            $statement->bindParam(":$value", $this->$value);
        }
        $statement->execute();
        $id = $db->lastInsertId();
        return $id;

    }
    private function insert() {

        $modelName=static::$modelName;
        $tableName = $modelName::getTablename();
        $array = get_object_vars($this);
        $columnString = implode(',', array_flip($array));
        $valueString = ':'.implode(',:', array_flip($array));
	$sql =  'INSERT INTO '.$tableName.' ('.$columnString.') VALUES ('.$valueString.')';
        return $sql;
    }

    private function update() {

        $modelName=static::$modelName;
        $tableName = $modelName::getTablename();
        $array = get_object_vars($this);

        $comma = " ";
        $sql = 'UPDATE '.$tableName.' SET ';
        foreach ($array as $key=>$value){
            if( ! empty($value)) {
                $sql .= $comma . $key . ' = "'. $value .'"';
                $comma = ", ";
            }
        }
        $sql .= ' WHERE id='.$this->id;
        return $sql;

    }
    public function delete() {
        $db = dbConn::getConnection();
        $modelName=static::$modelName;
        $tableName = $modelName::getTablename();
        $sql = 'DELETE FROM '.$tableName.' WHERE id='.$this->id;
        $statement = $db->prepare($sql);
        $statement->execute();
    }
}

?>
