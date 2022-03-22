<style>
	email-body {
		font-family: Avenir, Helvetica, sans-serif;
	    box-sizing: border-box;
	    background-color: #FFFFFF;
	    border-bottom: 1px solid #EDEFF2;
	    border-top: 1px solid #EDEFF2;
	    margin: 0;
	    padding: 0;
	    width: 100%;
	}
	h1   {color: blue;}
	p {
		font-family: Avenir, Helvetica, sans-serif;
	    box-sizing: border-box;
	    color: #74787E;
	    font-size: 16px;
	    line-height: 1.5em;
	    margin-top: 0;
	    text-align: left;
	}
    #password_text{
        color :red;
        
    }
</style>
<div class="email-body">
	
	<h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">
  Hello {{ $passwordChangeSendMail['name'] }},</h1>

	<p>Your Password Has Been successfully Changed!</p>
	<p>This email confirms that your password has been changed.
		To log on to the site, use the following credentials.
     On this date : {{ $passwordChangeSendMail['daymonth'] }}</p>
    <p>And this is your new password :<span id="password_text"> {{ $passwordChangeSendMail['password'] }}</span> </p>
	<p>If you have any questions or encounter any problems logging in, please contact a site administrator.
	Thanks,
</p>
	

</div>
<p>
	Regards,<br>
	www.wizbrand.com.<br>
	Email - info@wizbrand.com<br>
	The Wizbrand Security Team <br>
</p>