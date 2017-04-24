<?php
class FlatDB {
    private static $field_deliemeter = "\t";
    private static $linebreak = "\n";
    private static $table_extension = '.tsv';

    public $table_name;
    public $table_contents = array("FIELDS" => NULL, "RECORDS" => NULL);

    /*
    ** This method creates a table
    ** 
    ** @param   string  $table_name
    **
    ** @example
    ** $orders_db = new FlatDB;
    ** $orders_db->createTable('Administrators');
    **/
    public function createTable($table_name, $table_fields) {           
        // Create the file
        $tbl_name = $table_name.self::$table_extension;
        $header = '';
        foreach($table_fields as $field) {
            $header .= $field.self::$field_deliemeter;
        }
        file_put_contents($tbl_name, $header);

    }

    /*
    ** This method opens a table for querying, editing, etc
    ** 
    ** @param   string  $table_name
    **
    ** @example
    ** $orders_db = new FlatDB;
    ** $orders_db->openTable('Test.csv');
    **/ 
    public function openTable($table_name) {        
        // Check if this table is found
        $table_name = $table_name.self::$table_extension;
        if(file_exists($table_name) === FALSE) throw new Exception('Table not found.');

        // Set the table in a property
        $this->table_name = $table_name;

        // Get the fields
        $table = file($this->table_name, FILE_IGNORE_NEW_LINES); 
        $table_fields = explode(self::$field_deliemeter, $table[0]);
        unset($table[0]);

        // Put all records in an array
        $records = array();
        $num = 0;
        foreach($table as $record) {
            $records_temp = explode(self::$field_deliemeter, $record);
            $count = count($records_temp);
            for($i = 0; $i < $count; $i++) 
                $records[$num][$table_fields[$i]] = $records_temp[$i];
            $num++;
        }

        $this->table_contents['FIELDS'] = $table_fields;
        $this->table_contents['RECORDS'] = $records;
    }

    /*
    ** This method returns fields selected by the user based on a where criteria
    ** 
    ** @param   array   $select an array containing the fields the user wants to select, if he wants all fields he should use a *
    ** @param   array   $where  an array which has field => value combinations
    ** @return  array   it returns an array containing the records
    **
    ** @example
    ** $orders_db = new FlatDB;
    ** $orders_db->openTable('Test.csv');
    ** $select = array("id", "name", "group_id");
    ** $where = array("group_id" => 2);
    ** $orders_db->getRecords($select, $where);
    **/
    public function getRecords($select, $where = array()) {
        // Do some checks
        if(is_array($select) === FALSE) throw new Exception('First argument must be an array');
        if(is_array($where) === FALSE && isset($where)) throw new Exception('Second arguement must be an array');
        if(empty($this->table_name) === TRUE) throw new Exception('There is no connection to a table opened.');

        // If the array contains only one key which is a *, then select all fields
        if($select[0] == '*') $select = $this->table_contents['FIELDS'];

        // Check if the fieldnames in select are all found
        foreach($select as $field_name)
            if(in_array($field_name, $this->table_contents['FIELDS']) === FALSE) throw new Exception($field_name." is not found in the table.");

        // Check if the fieldnames in where are all found
        foreach($where as $field_name => $value)
            if(in_array($field_name, $this->table_contents['FIELDS']) === FALSE) throw new Exception($field['name']." is not found in the table.");

        // Find the record that the user queried in where
        $user_records = $this->table_contents['RECORDS'];
        if(isset($where)) {
            foreach($where as $field => $value) {
                foreach($this->table_contents['RECORDS'] as $key => $record) {
                    if($record[$field] != $value) {
                        unset($user_records[$key]);
                    }
                }
            }
        }

        // Preserve only the keys that the user asked for
        $final_array = array();
        $temp_fields = array_flip($select);
        foreach($user_records as &$record) {
            $final_array[] = array_intersect_key($record, $temp_fields);
        }

        return $final_array;
    }

    /*
    ** This method updates fields based on a criteria
    ** 
    ** @param   array   $update an array containing the fields the user wants to update
    ** @param   array   $where  an array which has field => value combinations which is the criteria
    **
    ** @example
    ** $orders_db = new FlatDB;
    ** $orders_db->openTable('Test.csv');
    ** $update = array("group_id" => 1);
    ** $where = array("group_id" => 2);
    ** $orders_db->updateRecords($update, $where);
    **/
    public function updateRecords($update, $where) {
        // Check if the connection is opened
        if(empty($this->table_name) === TRUE) throw new Exception('There is no connection to a table opened.');

        // Check if each field in update and where are found
        foreach($update as $field => $value) 
            if(in_array($field, $this->table_contents['FIELDS']) === FALSE) throw new Exception($field." is not found.");

        foreach($where as $field => $value)
            if(in_array($field, $this->table_contents['FIELDS']) === FALSE) throw new Exception($field." is not found.");

        // Find the record that the user queried in where
        $user_records = $this->table_contents['RECORDS'];
        $preserved_records = array();
        foreach($where as $field => $value) {
            foreach($this->table_contents['RECORDS'] as $key => $record) {
                if($record[$field] != $value) {
                    unset($user_records[$key]);
                    $preserved_records[$key] = $record;
                }
            }
        }

        // Update whatever needs updating
        $user_records_temp = $user_records;
        foreach($user_records_temp as $key => $record) {
            foreach($update as $field => $value) {
                $user_records[$key][$field] = $value;
            }
        }

        // Merge the preserved records and the records that were updated, then sort them by their record number
        $user_records += $preserved_records;
        ksort($user_records, SORT_NUMERIC);

        // Modify the property of the records and insert the new table
        $this->table_contents['RECORDS'] = $user_records;

        // Implode it so we can save it in a file
        $final_array[] = implode(self::$field_deliemeter, $this->table_contents['FIELDS']);
        foreach($user_records as $record)
            $final_array[] = implode(self::$field_deliemeter, $record);

        // Implode by linebreaks
        $data = implode(self::$linebreak, $final_array);

        // Save the file
        file_put_contents($this->table_name, $data);
    }

    /*
    ** This method inserts a new record to the table
    ** 
    ** @param   array   $insert an array containing field => value combinations
    ** @param   array   $where  an array which has field => value combinations which is the criteria
    **
    ** @example
    ** $orders_db = new FlatDB;
    ** $orders_db->openTable('Test.csv');
    ** $array = array("id" => 7, "name" => "Jack", "password" => "1234567", "group_id" => 2);
    ** $orders_db->insertRecord($array);
    **/
    public function insertRecord($insert) {
        if(is_array($insert) === FALSE) throw new Exception('The values need to be in an array');
        if(empty($this->table_name) === TRUE) throw new Exception('You need to open a connection to a table first.');

        // Check if each field in insert is found
        foreach($insert as $field => $value) 
            if(in_array($field, $this->table_contents['FIELDS']) === FALSE) throw new Exception($field." is not found.");

        // Build the new record
        $newRecord = array();
        foreach($this->table_contents['FIELDS'] as $field) {
            if(isset($insert[$field])) $newRecord[$field] = $insert[$field]; 
            else $newRecord[$field] = NULL;
        }

        // Add the new record to the pre-existing table and save it in the records
        $records = $this->table_contents['RECORDS'];
        $records[] = $newRecord;
        $this->table_contents['RECORDS'] = $records;

        // Format it for saving
        $data = array();
        $data[] = implode(self::$field_deliemeter, $this->table_contents['FIELDS']);

        foreach($records as $record)
            $data[] = implode(self::$field_deliemeter, $record);

        // Implode by linebreaks
        $data = implode(self::$linebreak, $data);

        // Save in file
        file_put_contents($this->table_name, $data);

    }

    /*
    ** This method deletes records from a table
    ** 
    ** @param   array   $where  an array which has field => value combinations which is the criteria
    **
    ** @example
    ** $orders_db = new FlatDB;
    ** $orders_db->openTable('Test.csv');
    ** $where = array("group_id" => 3);
    ** $orders_db->deleteRecords($where);
    **/
    public function deleteRecords($where) {
        if(is_array($where) === FALSE) throw new Exception('The argument must be an array');
        if(empty($this->table_name) === TRUE) throw new Exception('You need to open a connection to a database first.');

        // Check if each field in insert is found
        foreach($where as $field => $value) 
            if(in_array($field, $this->table_contents['FIELDS']) === FALSE) throw new Exception($field." is not found.");

        // Find the records that match and delete them
        $records = $this->table_contents['RECORDS'];
        foreach($records as $key => $record) {
            foreach($where as $field => $value) {
                if($record[$field] == $value) unset($records[$key]);
            }
        }

        // Save the records in the property
        $this->table_contents['RECORDS'] = $records;

        // Format it for saving
        $data = array();
        $data[] = implode(self::$field_deliemeter, $this->table_contents['FIELDS']);

        foreach($records as $record)
            $data[] = implode(self::$field_deliemeter, $record);

        // Implode by linebreaks
        $data = implode(self::$linebreak, $data);           

        // Save the file
        file_put_contents($this->table_name, $data);
    }

}
