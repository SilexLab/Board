URL Rewriting
=============

To get the full potential and beauty of SilexBoard we recommend to use URL rewriting.
The codes for nginx and Apache's mod_rewrite are below.

### nginx

#### Try files method
You should prefer to use this method to rewrite URLs.
```sh
location / {
	try_files $uri $uri/ /index.php?q=$uri&$args;
}
```

#### Rewrite module method
This method isn't very recommended.
```sh
if (!-e $request_filename)
{
	rewrite ^(.+)$ /index.php?q=$1 last;
}

if (-f $request_filename) {
	break;
}
```

#### Both
If you want to be on the safe side, you can use both, like:
```sh
if (!-e $request_filename)
{
	rewrite ^(.+)$ /index.php?q=$1 last;
}

if (-f $request_filename) {
	break;
}

location / {
	try_files $uri $uri/ /index.php?q=$uri&$args;
}
```

### Apache (mod_rewrite, .htaccess)
```
RewriteEngine On

# Only rewrite if file does not exist
RewriteCond %{REQUEST_FILENAME} !-f

# Put everything into the index file
RewriteRule ^(.*)$ index.php?q=$1

```
