# -*- coding: utf8 -*-

from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
import monogdb

class test():
    def __init__(self):
        self.driver = webdriver.Firefox()
        self.db = monogdb.mongodb()

