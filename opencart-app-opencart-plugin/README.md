1. Install opencart 3.0.3.8
2. Copy the "admin" and "catalog" folder in the installed directory.
3. Save the shurjopay merchant credentials in Admin settings of plugin.
4. Download and install additional extension "SEO URL issue fix in Opencart 3.x By Sainent" (version 3.x(1.2))
5. Rewrite .htaccess and set root folder name of the project 
6. Go to Admin Panel, go to Design, select SEO url
	->create new SEO url exactly with QUERY = "extension/payment/shurjopay/callback" and KEYWORD = "callback".
7. Go to Admin Panel, System/Settings, Edit "Your Store (Default)"
	->Select "Server"
	->Check "Use SEO URLs"
