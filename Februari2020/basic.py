#!/usr/bin/python3
#Created by Sugiarta W.

'''
pip install requests
python basic requests documentation : https://2.python-requests.org/en/master/
pip install beautifulsoup4
'''

import requests
from bs4 import BeautifulSoup as b

#making session
s = requests.session()


#requesting

url = "https://xkcd.com/353/"
result = s.get(url)

soup = b(result.text, 'html.parser')
soup = soup.prettify()
# print(soup)

# print(result.text)
# print(result.headers)
 

#check methods & attributes
# print(dir(result))
# print(help(result))


#save file

image_url = b(result.text, 'html.parser').find('div', {'id':'comic'}).find('img')['src']
# image_url = "https:" + image_url
image = s.get("https:" + image_url)
# print(image.content)

with open("image.png", "wb") as f:
	f.write(image.content)
	f.close()

#get
url = "https://httpbin.org/get"
payload = {"page" : 2, "count" : 25}
result = requests.get(url, params=payload)
print(result.text)


# post
url = "https://httpbin.org/post"
payload = {"username" : "henky", "password" : "tornado"}
result = requests.post(url, data=payload)
print(result.text)

#json

result_dict = result.json()
print(result_dict['form']['username'])


#basic auth
url = "https://httpbin.org/basic-auth/someone/here"
result = requests.get(url, auth=("someone", "here"))
print(result)

#timeout

url = "https://httpbin.org/delay/10"
try:
	result = requests.get(url)
	print(result)
except requests.exceptions.ReadTimeout:
	print("timeout")
