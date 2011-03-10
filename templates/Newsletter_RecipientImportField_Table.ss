<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<% base_tag %>
	$MetaTags

	<script src="sapphire/thirdparty/prototype/prototype.js" type="text/javascript"></script>
	<script src="sapphire/thirdparty/behaviour/behaviour.js" type="text/javascript"></script>
	<script src="newsletter/javascript/Newsletter_UploadForm.js" type="text/javascript"></script>	
</head>
<body onload="">
<h1><% _t('CONTENTSOF','Contents of') %> $FileName</h1>
<form method="post" action="admin/newsletter/UploadForm" name="UploadForm">
	<% control CustomSetFields %>
		$FieldHolder
	<% end_control %>
	<input type="submit" name="action_confirm" value="<% _t('YES','Confirm') %>" />
	<input type="submit" name="action_cancel" value="<% _t('NO','Cancel') %>" />
	<input type="hidden" name="ID" value="$TypeID" />
	<table summary="<% _t('RECIMPORTED','Recipients imported from') %> $FileName">
		<tbody>
			<tr>
				<% control ColumnHeaders %>
					<th>
						$Field
					</th>
				<% end_control %>
			</tr>
			<% control Rows %>
			<tr>
				<% control Cells %>
					<td>$Value</td>
				<% end_control %>
			</tr>
			<% end_control %>
		</tbody>
	</table>
</form>
</body>
</html>