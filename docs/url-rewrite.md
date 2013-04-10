URL Rewriting
=============

To get the full potential and beauty of SilexBoard we recommend to use URL rewriting.
The codes for nginx and Apache's mod_rewrite are below.

### nginx
```
# Rewrite #
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
# Rewrite end #
```

### Apache (mod_rewrite, .htaccess)
```
RewriteEngine On

# Only rewrite if file does not exist
RewriteCond %{REQUEST_FILENAME} !-f

# Put everything into the index file
RewriteRule ^(.*)$ index.php?q=$1

```
