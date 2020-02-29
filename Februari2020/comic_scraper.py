#Created by Michael D.
import urllib.request

from bs4 import BeautifulSoup as Soup

import requests

import random



myList = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','za','zb','zc','zd','ze','zf','zg','zh','zi','zj','zk','zl','zm','zn','zo','zp','zq','zr','zs','zt','zu','zv','zw','zx','zy','zz']



the_url = 'https://mangarockteam.com/manga/solo-leveling/106/'

headers = {'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36'}

# result = requests.get(url, headers=headers)



uClient = requests.get(the_url,headers=headers)

target_page = uClient.text



soup_page = Soup(target_page, "html.parser")



# print(soup_page.prettify())

# link_image = []

i=0

for img in soup_page.find_all("img",{"class":"wp-manga-chapter-img img-responsive lazyload effect-fade"}):

    image_source = img.get('data-src')

    print(image_source)

    print("Downloading image...")

    nama_file = "image"+ myList[i] +".jpg"

    file = open(nama_file,'wb')

    req_img = requests.get(image_source)

    file.write(req_img.content)

    # print(req_img.content)

    file.close()

    i=i+1

    

print("Download completed!")
