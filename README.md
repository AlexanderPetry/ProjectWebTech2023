# ProjectWebTech2023
---
## Conncecting via SSH
1. [Install OpenSSH](https://learn.microsoft.com/en-us/windows-server/administration/openssh/openssh_install_firstuse?tabs=powershell)
2. Open Powershell
3. Connect
```
ssh root@server-of-team9.pxl.bjth.xyz
```

## Install Caddy web server
1. Connect via SSH
2. update package manager
```
sudo dnf update
```
3. install Apache web server
```
sudo dnf install caddy
```
4. to start server
```
sudo systemctl start caddy
```
5. to check the status of the server
```
sudo systemctl status caddy 
```

## Install PHP on the webserver
1. intall PHP
```
sudo dnf install php
```
2. restart Apache service
```
sudo systemctl restart caddy
```

