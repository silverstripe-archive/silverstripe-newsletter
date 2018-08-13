<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>

    <style type="text/css">
* { margin: 0; padding: 0; font-size: 100%; font-family:-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";}

img { max-width: 100%; margin: 0 auto; display: block; }

body, .body-wrap { width: 100% !important; height: 100%; background: #f8f8f8; }

a { color: #71bc37; text-decoration: none; }

a:hover { text-decoration: underline; }

.text-center { text-align: center; }

.text-right { text-align: right; }

.text-left { text-align: left; }

.button { display: inline-block; color: white; background: #71bc37; border: solid #71bc37; border-width: 10px 20px 8px; font-weight: bold; border-radius: 4px; }

.button:hover { text-decoration: none; }

h1, h2, h3, h4, h5, h6 { margin-bottom: 20px; line-height: 1.25; }

h1 { font-size: 32px; }

h2 { font-size: 28px; }

h3 { font-size: 24px; }

h4 { font-size: 20px; }

h5 { font-size: 16px; }

p, ul, ol { font-size: 16px; font-weight: normal; margin-bottom: 20px; }

.container { display: block !important; clear: both !important; margin: 0 auto !important; max-width: 580px !important; }

.container table { width: 100% !important; border-collapse: collapse; }

.container .masthead { padding: 80px 0; background: #000; color: white; }

.container .masthead h1 { margin: 0 auto !important; max-width: 90%; text-transform: uppercase; }

.container .content { background: white; padding: 30px 35px; }

.container .content.footer { background: none; }

.container .content.footer p { margin-bottom: 0; color: #888; text-align: center; font-size: 14px; }

.container .content.footer a { color: #888; text-decoration: none; font-weight: bold; }

.container .content.footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<table class="body-wrap">
    <tr>
        <td class="container">
            <table>
                <tr style="text-align: center">
                    <p style="color: #999; text-align: center"><small>If you're having trouble viewing this email <a href="$OnlineLink">view as a web page</a></small></p>
                </tr>

                <tr>
                    <td align="center" class="masthead">
                        <h1>$Subject</h1>
                    </td>
                </tr>
                <tr>
                    <td class="content">
                       $Body
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="container">
            <table>
                <tr>
                    <td class="content footer" align="center">
                        <p>Sent by <a href="$BaseURL">$SiteConfig.Title</a></p>
                        <p>To unsubscribe <a href="$UnsubscribeLink">click here</a>. If you're having trouble viewing this email <a href="$OnlineLink">view as a web page</a></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
