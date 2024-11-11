<?php
require('../includes/conn.php');

  $sql = mysqli_query($conn, "SELECT * FROM  general order by id desc LIMIT 1");
            if(mysqli_num_rows($sql) > 0){
              $web = mysqli_fetch_assoc($sql);
            }
 $request_dir = $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']);	
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
<span><img src=APP_HOST/upload/'.$web['image'].'></span>
<h3>Hey <span>'.$name.'</span>,</h3>

We are glad to welcome you on Nigeria <br>
most trusted Instant & Automated digital recharge solution.<p> 

We have got lots of stuff to eliminate stress<br>
recharging your devices and in turn put some money <br>
in your wallet while doing so.<p>


<strong>Your login details are as follows:</strong> <p>

<table class="table" >
  
  <tr>
    <td>username</td>
    <td><span>'.$username.'</span></td>
  </tr>
  <tr>
    <td>Password</td>
    <td> <span>'.$password.'</span></td>
  </tr>
  
   <tr>
    <td>Account Type</td>
    <td> SMART USERS </td>
  </tr>
  
</table> <p>
<span>'.$web['name'].'<span> give you the instant and automated recharge of Airtime, <br>
Internet Data, Gotv, Dstv, Startimes, Electric Token,Smile Internet.<p>

<span><a href="https://'.$request_dir.'/login"><button class=button>Try it Now!</button></a></span>  <br>
<p>
Our support team is standby to assist you whenever you need help.<p>
 
 <strong>Email:</strong> <span>'.$web['email'].'</span>
<p>
Warm Regards, <p>


<span>'.$web['name'].'</span>

</boddy>
</html>
';
?>