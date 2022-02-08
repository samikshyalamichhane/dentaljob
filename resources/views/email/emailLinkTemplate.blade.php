<?php
$domain=Request::root();
?>
Hello from <a href="{{$domain}}">{{$domain}}!</a> <br>
You are receiving this email because you ar someone else has requested a <br> 
password for your user account.It can be safely ignored if you did not request a <br>
password reset.Click the link below to reset your password. <br>
 <a href="{{$domain}}/reset-password/{{$token}}">{{$domain}}/reset-password/{{$token}}</a> <br>
 Thank you for using <a href="{{$domain}}">{{$domain}}!</a> <br>
 <a href="{{$domain}}">{{$domain}}!</a>