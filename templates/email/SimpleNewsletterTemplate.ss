<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<% base_tag %>
		<title>$Subject</title>
		<style type="text/css">
			/* Client-specific Styles */
			#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" button. */
			body{width:100% !important;} .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
			body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */

			/* Reset Styles */
			body{margin:0; padding:0;}
			table td{border-collapse:collapse;}
			#backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}

			/* Template Styles */
			body, #backgroundTable{
				background-color:#FFFFFF;
			}

			/**
			* @tab Page
			* @section email border
			* @tip Set the border for your email.
			*/
			#templateContainer{
				border: 1px solid #B29E80;
				background-color:#D2C4AE;
			}
			/**
			* @tab Header
			* @section header style
			* @tip Set the background color and border for your email's header area.
			* @theme header
			*/
			#templateHeader{
				border-bottom:1px solid #FFFFFF;
			}

			/**
			* @tab Header
			* @section header text
			* @tip Set the styling for your email's header text. Choose a size and color that is easy to read.
			*/
			.headerContent{
				line-height:2%;
				padding:0;
			}

			#templateBody{
				background-color:#FFFFFF;
			}
			/**
			* @tab Body
			* @section body text
			* @tip Set the styling for your email's main content text. Choose a size and color that is easy to read.
			* @theme main
			*/
			.bodyContent div{
				color:#000000;
				font-family:'Lucida Sans Unicode',sans-serif,Verdana,Arial;
				font-size:13pt;
				line-height:140%;
				text-align:left;
			}
			.bodyContent div a{
				color:#000000;
			}
		</style>
	</head>
	<body sytle="width:100% !important; -webkit-text-size-adjust:none;margin:0; padding:0;background-color:#FFFFFF;" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
		<center>
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable" sytle="height:100% !important; margin:0; padding:0; width:100% !important; background-color:#FFFFFF;">
				<tr>
					<td align="center" valign="top" sytle="border-collapse:collapse;">
						<table border="0" cellpadding="0" cellspacing="0" width="751" id="templateContainer" sytle="border: 1px solid #B29E80;background-color:#D2C4AE;">
							<% include NewsletterHeader %>
							<tr>
								<td align="center" valign="top" sytle="border-collapse:collapse;">
									<table border="0" cellpadding="20" cellspacing="0" width="751" id="templateBody" style="background-color:#FFFFFF;">
										<tr>
											<td valign="top" class="bodyContent" sytle="border-collapse:collapse;">
												<div sytle="color:#000000;font-family:'Lucida Sans Unicode',sans-serif,Verdana,Arial;font-size:13pt;line-height:140%;text-align:left;">
													$Body
													<% include UnsubscribeFooter %>
												</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<% include NewsletterFooter %>
						</table>
						<br />
					</td>
				</tr>
			</table>
		</center>
	</body>
</html>