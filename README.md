zend2skeleton
=============

1. Download Zend Skeleton application and add these folders to the Module folder.
2. Add the skeleton to virtual hosts + hosts in windows.

<VirtualHost *:80>
    DocumentRoot "C:/wamp/ZendFramework-2.1.0/ZendSkeletonApplication/public"
    ServerName zend2
    <Directory "C:/wamp/ZendFramework-2.1.0/ZendSkeletonApplication/public">
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>