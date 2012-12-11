<% if FirstName %>Dear $FirstName,<br ><% end_if %>
<br />
<p>
	<% _t('Newsletter.VerificationExpiredContent1',  'The verification link is only validate for 2 days.') %>
	<br />
	<% _t('Newsletter.VerificationExpiredContent2',  'please resubmit the form if you still want to subscribe to our mailing lists!') %>
</p>