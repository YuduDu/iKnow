# -*- coding: utf8 -*-

import unittest

from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
#import sys
#reload(sys)

from pymongo import MongoClient
client = MongoClient('localhost', 27017)
db = client.iknowTest
datas = db.iknowTest

class test():

	def teardown_func(self):
		self.driver.close()

	def test_generator(self):
		driver = webdriver.Firefox()
		for data in datas.find({"useCase":"login"}):
			yield self.test, data, driver

	def test(self, data, driver):
		
		driver.get("http://gene.rnet.missouri.edu/iKnow/Admin/1210/login.php")
		assert "UserLogin" in driver.page_source
		elem = driver.find_element_by_id("username")
		elem.send_keys(data["userName"])
		elem = driver.find_element_by_id("password")
		elem.send_keys(data["password"])
		elem.send_keys(Keys.RETURN)
		if(data["status"] == True):
			assert "密码错误" not in driver.page_source
		elif(data["status"] == False):
			assert "main.html" not in driver.current_url	
		else:
			print "Error"