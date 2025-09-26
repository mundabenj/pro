<?php

// email subject for registration verification
$lang['reg_ver_subject'] = "Account Activation Code - {{site_name}}";

// email body for registration verification
$lang['reg_ver_body'] = "
Hello {{fullname}},

You requested an account on <strong>{{site_name}}</strong>.
Your activation code is:
<h2>{{activation_code}}</h2>
Regards,
{{mail_from_name}}
";