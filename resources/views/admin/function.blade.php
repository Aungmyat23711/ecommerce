<?php
function update()
{
    $connection=mysqli_connect('localhost','root','','series');
    $name=$_POST['type'];
    $eid=$_GET['eid'];
    $query="update types set name='$type' where id='$eid'";
    $go_query=mysqli_query($connection,$query);
    if(!$go_query)
    {
        die("QUERY FAILED" .mysqli_error($connection));
    }else{
        header("location:type.blade.php");
    }
}

?>