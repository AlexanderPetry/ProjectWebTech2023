# ProjectWebTech2023
---
## Conncecting via SSH
1. [Install OpenSSH](https://learn.microsoft.com/en-us/windows-server/administration/openssh/openssh_install_firstuse?tabs=powershell)
2. Open Powershell
3. Connect
```
ssh remote_username@remote_host
```

## Install Apache web server
1. Connect via SSH
2. update package manager
```
sudo dnf update
```
3. install Apache web server
```
sudo dnf install httpd 
```
4. to start server
```
sudo systemctl start httpd.service
```
5. to check the status of the server
```
sudo systemctl status httpd.service 
```

## Install PHP on the webserver
1. intall PHP
```
sudo dnf install php
```
2. restart Apache service
```
sudo systemctl restart httpd.service
```

## Extra recources
- [PHP](https://www.w3schools.com/php/default.asp)
- [PHP/PostgeSQL](https://www.php.net/manual/en/book.pgsql.php)
