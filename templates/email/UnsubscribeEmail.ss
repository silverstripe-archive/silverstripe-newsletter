<html>
	<head>
	</head>
	<body>
		<h1>$Subject</h1>
		<% if Member.FirstName %><p>Dear $Member.FirstName,</p><% end_if %>
		<p>Please click the link below to unsubscribe from our newsletters:</p>
		<p><a href="$Link">$Link</a><br></p>
		<p>Thanks</p>
	</body>
</html>
