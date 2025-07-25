<?php

class DB
{
    var $db_host = "";
    var $db_user = "";
    var $db_pass = "";
    var $db_name = "";
    var $db_link = "";
    var $result = 0;

    function __construct($db_host, $db_user, $db_pass, $db_name)
    {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    function open()
    {
        $this->db_link = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }


    function execute($query)
    {
        $this->result = mysqli_query($this->db_link, $query);
        if (!$this->result) {
            die("Query failed: " . mysqli_error($this->db_link));
        }
        return $this->result;
    }


    function getResult()
    {
        return mysqli_fetch_array($this->result);
    }

    function close()
    {
        mysqli_close($this->db_link);
    }
}
