# HTB - MAILROOM

## Introduction
**Maquina:** Mailroom
**IP:** 10.10.11.209
**Local:** 10.10.16.75

```shell 
$ target=10.10.11.209
$ echo $target 
10.10.10.161
```

## Reconocimiento 
```shell 
$ nmap -p- --open -sS --min-rate 5000 -vvv -n -Pn -oG allPorts $target
# Nmap 7.93 scan initiated Wed Aug 23 02:53:21 2023 as: nmap -p- --open -sS --min-rate 5000 -vvv -n -Pn -oG allPorts 10.10.11.209
# Ports scanned: TCP(65535;1-65535) UDP(0;) SCTP(0;) PROTOCOLS(0;)
Host: 10.10.11.209 ()	Status: Up
Host: 10.10.11.209 ()	Ports: 22/open/tcp//ssh///, 80/open/tcp//http///
# Nmap done at Wed Aug 23 02:53:37 2023 -- 1 IP address (1 host up) scanned in 15.84 seconds
```

Captuamos los puertos: 
```shell 
ports=$(grep -oP '\d+/open/tcp//[^/]+' allPorts | awk -F '/' '{ printf "%s,", $1 }' | sed 's/,$//')
```

```shell 
nmap -sCV -p $ports -oN targeted $target
# Nmap 7.93 scan initiated Wed Aug 23 03:02:23 2023 as: nmap -sCV -p 22,80 -oN targeted 10.10.11.209
Nmap scan report for 10.10.11.209
Host is up (0.23s latency).

PORT   STATE SERVICE VERSION
22/tcp open  ssh     OpenSSH 8.2p1 Ubuntu 4ubuntu0.5 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   3072 94bb2ffcaeb9b182afd789811aa76ce5 (RSA)
|   256 821beb758b9630cf946e7957d9ddeca7 (ECDSA)
|_  256 19fb45feb9e4275de5bbf35497dd68cf (ED25519)
80/tcp open  http    Apache httpd 2.4.54 ((Debian))
|_http-server-header: Apache/2.4.54 (Debian)
|_http-title: The Mail Room
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel

Service detection performed. Please report any incorrect results at https://nmap.org/submit/ .
# Nmap done at Wed Aug 23 03:02:44 2023 -- 1 IP address (1 host up) scanned in 21.87 seconds
```
## Website - TCP 80

<img src="assets/mailroom_01.png" alt="Frontpage"/>

La página también tiene `mailroom.htb` en el pie de página, la agregamos a  `/etc/hosts`:

```shell
$ echo "$target mailroom.htb" | sudo tee -a /etc/hosts
10.10.11.209 mailroom.htb
```
## Directory Brute Force

```bash
$ feroxbuster -u http://mailroom.htb -x php
 ___  ___  __   __     __      __         __   ___
|__  |__  |__) |__) | /  `    /  \ \_/ | |  \ |__
|    |___ |  \ |  \ | \__,    \__/ / \ | |__/ |___
by Ben "epi" Risher 🤓                 ver: 2.3.3
───────────────────────────┬──────────────────────
 🎯  Target Url            │ http://mailroom.htb
 🚀  Threads               │ 50
 📖  Wordlist              │ /usr/share/seclists/Discovery/Web-Content/raft-medium-directories.txt
 👌  Status Codes          │ [200, 204, 301, 302, 307, 308, 401, 403, 405, 500]
 💥  Timeout (secs)        │ 7
 🦡  User-Agent            │ feroxbuster/2.3.3
 💉  Config File           │ /etc/feroxbuster/ferox-config.toml
 💲  Extensions            │ [php]
 🔃  Recursion Depth       │ 4
 🎉  New Version Available │ https://github.com/epi052/feroxbuster/releases/latest
───────────────────────────┴──────────────────────
 🏁  Press [ENTER] to use the Scan Cancel Menu™
──────────────────────────────────────────────────
301        9l       28w      309c http://mailroom.htb/js
301        9l       28w      313c http://mailroom.htb/assets
200       86l      271w     4317c http://mailroom.htb/contact.php
403        9l       28w      277c http://mailroom.htb/template
301        9l       28w      310c http://mailroom.htb/css
200      118l      394w     6891c http://mailroom.htb/about.php
301        9l       28w      317c http://mailroom.htb/javascript
200       75l      321w     4336c http://mailroom.htb/services.php
200      128l      534w     7748c http://mailroom.htb/index.php
301        9l       28w      311c http://mailroom.htb/font
301        9l       28w      324c http://mailroom.htb/javascript/jquery
200    10870l    44283w   287600c http://mailroom.htb/javascript/jquery/jquery
403        9l       28w      277c http://mailroom.htb/server-status
301        9l       28w      316c http://mailroom.htb/inquiries
[####################] - 9m    479984/479984  0s      found:14      errors:14195
[####################] - 9m     59998/59998   110/s   http://mailroom.htb
[####################] - 8m     59998/59998   115/s   http://mailroom.htb/js
[####################] - 9m     59998/59998   111/s   http://mailroom.htb/assets
[####################] - 8m     59998/59998   115/s   http://mailroom.htb/css
[####################] - 9m     59998/59998   110/s   http://mailroom.htb/javascript
[####################] - 9m     59998/59998   111/s   http://mailroom.htb/font
[####################] - 8m     59998/59998   113/s   http://mailroom.htb/javascript/jquery
[####################] - 8m     59998/59998   122/s   http://mailroom.htb/inquiries

```
Nada interesante.

## Subdomain Brute Force
```shell
********************************************************
* Wfuzz 3.1.0 - The Web Fuzzer                         *
********************************************************

Target: http://10.10.11.209/
Total requests: 4989

=====================================================================
ID           Response   Lines    Word       Chars       Payload
=====================================================================

000000262:   200        267 L    1181 W     13089 Ch    "git"

Total time: 122.9632
Processed Requests: 4989
Filtered Requests: 4988
Requests/sec.: 40.57309
```
Encontramos uno, así que agregaré `git.mailroom.htb` a mi archivo de hosts.


