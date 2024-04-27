#!/bin/bash

username=$1

if [[ -n "$username" ]]; then
	cd /var/www/html/VPN

	/usr/bin/cp user/user.cnf user/"$username".cnf
	/usr/bin/sed -i "s/username/$username/g" user/"$username".cnf

	/usr/bin/openssl req -config user/"$username".cnf -newkey rsa:2048 -sha256 -nodes -out user/"$username".csr -outform PEM
	/usr/bin/openssl ca -batch -config private/hackthebox-ca.cnf -policy signing_policy -extensions signing_req -out user/"$username".crt -infiles user/"$username".csr

	/usr/bin/cp example/example.ovpn user/"$username".ovpn

	# Insert the user certificate
	temp="$(mktemp -q /var/www/html/VPN/user/$username.XXXXXX)"
	/usr/bin/awk -v r="$(< user/$username.crt)" '/example-user-certificate/{printf "%s\n",r;next} 1' user/"$username".ovpn > $temp && mv $temp user/"$username".ovpn

	# Insert the private key
	temp="$(mktemp -q /var/www/html/VPN/user/$username.XXXXXX)"
	/usr/bin/awk -v r="$(< user/$username.key)" '/example-private-key/{printf "%s\n",r;next} 1' user/"$username".ovpn > $temp && mv $temp user/"$username".ovpn

else
    echo "Error"
fi
