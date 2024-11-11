<?php
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
  background-color: #008CBA; // Blue
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 8px;
  cursor: pointer;
  
  -webkit-transition-duration: 0.4s; // Safari
  transition-duration: 0.4s;
}

.button:hover {
  background-color: #4CAF50; // Green
  color: white;
}

</style>
</head>

<body>


<h3>Hello Admin,</h3>
<h4><p>I AM <span>'.$name.'</span></p></h4>

<h1><p><b><span> '.$message.'</span></b></p></h1>

<p>
Warm Regards, <p>


</body><html>

';
?>