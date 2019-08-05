<?php

include "db.php";
include "qr_action.php";

class DataOperation extends Database
{
    public function insert_op($table,$fields)
    {
        $sql =" ";
        $sql.= "INSERT INTO ".$table." ";
        $sql.= "(".implode(",",array_keys($fields)).") VALUES (";
        $sql.= "'".implode("','",array_values($fields))."')";
        $query = mysqli_query($this->connection,$sql);
        if($query)
        {
            return true;
        }
        
    }

    public function update_op($table,$arguments,$fields)
    {
        $sql = " ";
        $condition = " ";
        foreach ($arguments as $key => $value) 
        {
            // id = '1' AND name = 'my name' AND (continues...)
            $condition .= $key ." = '" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);

        $sql.= "UPDATE ".$table." SET ";
        foreach ($fields as $key => $value) 
        {
            //name = 'My Name' , qty = '2', (continues...)
            $sql .= $key ." = '" . $value . "', ";
        }
        $sql = substr($sql, 0, -2);
        $sql.= " WHERE ".$condition;
        $query = mysqli_query($this->connection,$sql);
        if($query)
        {
            return true;
        }
    }

    public function display_op($table)
    {
        $sql ="SELECT * FROM ".$table;
        $dis_array = array();
        $query = mysqli_query($this->connection,$sql);
        while($row = mysqli_fetch_assoc($query))
        {
            $dis_array[] = $row;
        }
        return $dis_array;
    }

    public function select_op($table,$arg)
    {
        $sql = " ";
        $condition = " ";
        foreach ($arg as $key => $value) 
        {
            // id = '1' AND name = 'my name' AND (continues...)
            $condition .= $key ." = '" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        $sql .= "SELECT * FROM ". $table. " WHERE ". $condition;
        $query = mysqli_query($this->connection,$sql);
        $row = mysqli_fetch_assoc($query);
        return $row;
    }

    public function delete_op($table,$arg)
    {
        $sql = " ";
        $condition = " ";
        foreach ($arg as $key => $value) 
        {
            // id = '1' AND name = 'my name' AND (continues...)
            $condition .= $key ." = '" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);

        $sql.= "DELETE FROM ".$table." WHERE ".$condition;
        // echo $sql;
        $query = mysqli_query($this->connection,$sql);
        if($query)
        {
            return true;
        }
    }
}

$obj = new DataOperation;

//If clicked on submit
if (isset($_REQUEST["submit"]))
{   
    //Declaring array for QR
    $myArray = array(
        //"This is array_keys" => $_REQUEST["This is array_values"],
        //
        "name"  => $_REQUEST["name"],
        "qty"   => $_REQUEST["qty"]
    );
    $qr_link = $obj1-> Generate_QR($myArray);
    
    $myArray1 = array(
        //"This is array_keys" => $_REQUEST["This is array_values"],
        //
        "name"  => $_REQUEST["name"],
        "qty"   => $_REQUEST["qty"],
        "image" => $qr_link,
    );
     

    //inset_op is function name for calling the function from object(obj) of class(DataOperation)
    //qr_generation is table name
    
    if ($obj-> insert_op("qr_generation",$myArray1))
    {
        header("location:index.php?INSERT_SUCCESS");
    }
}

//If clicked on update
if (isset($_REQUEST["update"]))
{
    $id  = $_REQUEST["id"];
    $arg = array("id" => $id );
    $myArray = array(
        "name"  => $_REQUEST["name"],
        "qty"   => $_REQUEST["qty"],
        "image" => " ",
        "link"  => " "
    );

    // $obj-> update_op("qr_generation",$arg,$myArray);
    if ($obj-> update_op("qr_generation",$arg,$myArray))
    {
        header("location:index.php?UPDATE_SUCCESS");
    }
}
//If clicked on update delete
if (isset($_REQUEST["delete"]))
{
    $id  = $_REQUEST["id"];
    $arg = array("id" => $id );
    
    if ($obj-> delete_op("qr_generation",$arg))
    {
        header("location:index.php?DELETE_SUCCESS");
    }
}


?>