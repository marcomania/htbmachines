```bash
$ sudo nmap -p- --open -sS --min-rate 5000 -vvv -n -Pn 10.10.11.218 -oG allPorts

# Nmap 7.93 scan initiated Mon Jul 31 00:03:13 2023 as: nmap -p- --open -sS --min-rate 5000 -vvv -n -Pn -oG allPorts 10.10.11.218
# Ports scanned: TCP(65535;1-65535) UDP(0;) SCTP(0;) PROTOCOLS(0;)
Host: 10.10.11.218 ()	Status: Up
Host: 10.10.11.218 ()	Ports: 22/open/tcp//ssh///, 80/open/tcp//http///, 443/open/tcp//https///
# Nmap done at Mon Jul 31 00:03:28 2023 -- 1 IP address (1 host up) scanned in 15.90 seconds
```

```bash
$ ports=$(grep -oP '\d+/open' allPorts | cut -d '/' -f 1 | tr '\n' ',' | sed 's/,$//')

$ nmap -p$ports -sC -sV 10.10.11.218 -oN targeted
Starting Nmap 7.93 ( https://nmap.org ) at 2023-07-31 00:21 -05
Nmap scan report for 10.10.11.218
Host is up (0.30s latency).

PORT    STATE SERVICE  VERSION
22/tcp  open  ssh      OpenSSH 8.9p1 Ubuntu 3ubuntu0.1 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   256 b7896c0b20ed49b2c1867c2992741c1f (ECDSA)
|_  256 18cd9d08a621a8b8b6f79f8d405154fb (ED25519)
80/tcp  open  http     nginx 1.18.0 (Ubuntu)
|_http-title: Did not follow redirect to https://ssa.htb/
|_http-server-header: nginx/1.18.0 (Ubuntu)
443/tcp open  ssl/http nginx 1.18.0 (Ubuntu)
|_http-title: Secret Spy Agency | Secret Security Service
| ssl-cert: Subject: commonName=SSA/organizationName=Secret Spy Agency/stateOrProvinceName=Classified/countryName=SA
| Not valid before: 2023-05-04T18:03:25
|_Not valid after:  2050-09-19T18:03:25
|_http-server-header: nginx/1.18.0 (Ubuntu)
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel

```

Añadimos en `/etc/hosts` el nombre de dominio ssa.htb.
```bash
$ echo "10.10.11.218 ssa.htb" | sudo tee -a /etc/hosts
# Host addresses
127.0.0.1  localhost

# Others
10.10.11.218 ssa.htb
```
