<?php 
require_once('../includes/conn.php');
$sql = mysqli_query($conn, "SELECT * FROM  general order by id desc LIMIT 1");
            if(mysqli_num_rows($sql) > 0){
              $web = mysqli_fetch_assoc($sql);
            }
$temp='
<html>
<head>
<style>
.table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}


.button {
  background-color: #008CBA; /* Blue */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 8px;
  cursor: pointer;
  
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
}

.button:hover {
  background-color: #4CAF50; /* Green */
  color: white;
}

</style>
</head>

<body>

<b><span>'.$web['name'].'</span></b>

<h3>Hey <span>'.$name.'</span>,</h3>

You have successful purchase a <span>'.$exam.'</span> <span>'.$type.'</span> on <span>'.$date.'</span>. Thanks for choosing <span>'.$web['web'].'</span>   <br>

<strong>Your transaction details are as follows:</strong> <p>

<table class"table" >
  
  <tr>
    <td>Exam</td>
    <td><span>'.$exam.'</span></td>
  </tr>
  <tr>
    <td>Quantity</td>
    <td><span>'.$quantity.'</span></td>
  </tr>
    <tr>
    <td>Amount</td>
    <td><span>'.$amount.'</span></td>
  </tr>
    <tr>
    <td>Card Pin</td>
    <td><span>'.$cardpin.'</span></td>
  </tr>
     <tr>
    <td>New Balance</td>
    <td> N<span>'.$total.'</span></td>
  </tr>
  <tr>
    <td>Date</td>
    <td><span>'.$date.'</span></td>
  </tr>
</table> 


<p>if the cardpin is not succesful you can reply this mail</P> 
<br><p>


Thank you for choosing <span>'.$web['name'].'</span> <p>
 
<p>

</body><html>

'?>