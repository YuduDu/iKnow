# -*- coding: utf-8 -*-
import sys
reload(sys)
sys.setdefaultencoding("utf-8")

import unittest

from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait

from pymongo import MongoClient
client = MongoClient('localhost', 27017)
db = client.iknowTest
datas = db.iknowTest


class LoginTest(unittest.TestCase):
	username = "";
	password = "";
	status = "";
	def __init__(self, data):
		super(MyTest, self).__init__(testName)  # calling the super class init varies for different python versions.  This works for 2.7
		self.username = data["userName"]
		self.password = data["password"]
		self.status = data["status"]

	def setUp(self):
		self.driver = webdriver.Firefox()

	def test_login(self):
		driver = self.driver
		driver.get("http://gene.rnet.missouri.edu/iKnow/Admin/1210/login.php")
		assert "欢迎登录后台管理系统" in driver.title
		elem = driver.find_element_by_id("username")
		elem.send_keys(self.username)
		elem = driver.find_element_by_id("password")
		elem.send_keys(self.password)
		elem.send_keys(Keys.RETURN)
		if(self.status == True):
			assert "密码错误" not in driver.page_source
		elif(self.status == False):
			assert "main.html" not in driver.current_url	
		else:
			print "Error"

	def tearDown(self):
		self.driver.close()

suite = unittest.TestSuite()
for data in datas.find({"useCase":"login"}):
	suite.addTest(LoginTest(data))
unittest.TextTestRunner(verbosity=2).run(suite)

