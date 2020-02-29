#!/usr/bin/python3
#Created by Sugiarta W.

import requests
from bs4 import BeautifulSoup as bs
from random import *

for i in range(1000):
	s = requests.session()

	url = "https://docs.google.com/forms/d/e/1FAIpQLSe5eHBKR4L6gcAIQLrrkgkPQ1DJR6g_EzJy4YDw684J5OChzg/viewform?fbzx=9067213235385542172"

	response = s.get(url)

	url = "https://docs.google.com/forms/u/1/d/e/1FAIpQLSe5eHBKR4L6gcAIQLrrkgkPQ1DJR6g_EzJy4YDw684J5OChzg/formResponse"

	q1 = ['Option 1','Option 2','Option 3','Option 4','Option 5',]
	shuffle(q1)
	q2 = ['Option 1','Option 2','Option 3','Option 4','Option 5',]
	shuffle(q2)
	q3 = "Halo Alsut From Kemanggisan"
	q4 = randint(1,10)
	q5 = randint(1,10)
	dr = bs(response.text,'html.parser').find('input', {'name':'draftResponse'}).get('value')
	fbzx = bs(response.text,'html.parser').find('input', {'name':'fbzx'}).get('value')

	asd = []
	index = 0
	ramd = randint(1,5)
	for j in range(ramd):
		asd.append(q2[index])
		index += 1

	params = {
		'entry.3299327':q1[0],
		'entry.68985689':asd,
		'entry.458413899':q3,
		'entry.158349389':q4,
		'entry.241215511':q5,
		'fvv':'1',
		'draftResponse':dr,
		'pageHistory':'0',
		'fbzx':fbzx
	}

	s.post(url, data=params)
	s.close()
	print(i)
