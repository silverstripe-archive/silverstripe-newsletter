<h2><% _t('TRACKEDLINKSINTHISNEWSLETTER', 'Tracked Links in this Newsletter') %></h2>

<% if NewsletterLinks %>
	<table summary="List of tracked links in this newsletter and number of visits">
		<thead>
			<tr>
				<th>Link<th>
				<th>Clicks</th>
			</tr>
		<thead>
		
		<tbody>
			<% control NewsletterLinks %>
				<tr>
					<td>$Original</td>
					<td>$Visits</td>
				</tr>
			<% end_control %>
		</tbody>
	</table>
<% else %>
	<p><%  _t('NOTRACKEDLINKS', 'No tracked links') %></p>
<% end_if %>