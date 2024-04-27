# Introduction
**Maquina:** Sau
**IP:** 10.10.11.224
**Local:** 10.10.14.208

```shell 
$ target=10.10.11.224
$ echo $target 
10.10.11.224
```
# Reconocimiento 
```shell 
$ nmap -p- --open -sS --min-rate 5000 -vvv -n -Pn -oG allPorts 10.10.11.224
# Ports scanned: TCP(65535;1-65535) UDP(0;) SCTP(0;) PROTOCOLS(0;)
Host: 10.10.11.224 ()	Status: Up
Host: 10.10.11.224 ()	Ports: 22/open/tcp//ssh///
# Nmap done at Sun Jan  7 13:11:20 2024 -- 1 IP address (1 host up) scanned in 18.72 seconds
```

```shell 
$ nmap -sCV -p 22 -oN targeted 10.10.11.224
Nmap scan report for 10.10.11.224
Host is up (0.17s latency).

PORT   STATE SERVICE VERSION
22/tcp open  ssh     OpenSSH 8.2p1 Ubuntu 4ubuntu0.7 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   3072 aa8867d7133d083a8ace9dc4ddf3e1ed (RSA)
|   256 ec2eb105872a0c7db149876495dc8a21 (ECDSA)
|_  256 b30c47fba2f212ccce0b58820e504336 (ED25519)
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel

Service detection performed. Please report any incorrect results at https://nmap.org/submit/ .
# Nmap done at Sun Jan  7 13:13:06 2024 -- 1 IP address (1 host up) scanned in 9.82 seconds
```