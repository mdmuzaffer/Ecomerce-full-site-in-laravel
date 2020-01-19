<html>
<header>
<title>Confirmation Muzaffer E-commmerce Website</title>
</header>
<body>
	<table>
		<tr><td>Dear {{$name}}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Please click on the below link to active your account !.</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td><a href="{{url('confirm/'.$code)}}">Confirm Account</a></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thanks & Regards</td></tr>
		<tr><td>Muzaffer E-com Website</td></tr>
	</table>
</body>
</html>