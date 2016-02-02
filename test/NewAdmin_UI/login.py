# -*- coding: utf8 -*-
import sys
reload(sys)
sys.setdefaultencoding("utf-8")

from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait

from test import test

class login (test):

    def __init__(self):
        test.__init__(self)
        self.collection = self.db.get_collection("Login")

    def __del__(self):
        self.driver.close()

    def test_step(self,data):
        driver = self.driver
        driver.get("http://gene.rnet.missouri.edu/iKnow/Admin/1210/login.php")
        assert "欢迎登录后台管理系统" in driver.title
        elem = driver.find_element_by_id("username")
        elem.send_keys(data["userName"])
        elem = driver.find_element_by_id("password")
        elem.send_keys(data["password"])
        elem.send_keys(Keys.RETURN)
        return driver

    def test_normal_login(self):
        datas = self.collection.find({"status":True})
        print "Testing Normal login function with vaild information:"
        for data in datas:
            driver = self.test_step(data)
            try:
                assert "密码错误" not in driver.page_source
            except:
                print "Normal login function Testing FAILED! "
                print "Failed information: "
                print "         username:"+data["userName"]
                print "         password:"+data['password']+"\n"

            print "Normal login function Testing Done.\n\n"

    # def test_invaild_login(self):
    #     datas = self.collection.find({"status":False,"type":"invaild"})
    #     print "Testing Login function with invaild information: "
    #     for data in datas:
    #         driver = self.test_step(data)
    #         try:
    #             alert = driver.switch_to_alert()
    #             alert_txt = alert.text
    #
    #         except:
    #             try:
    #                 assert "main" not in driver.current_url()
    #             except:
    #                 print "Login function Testing FAILED! "
    #                 print "Failed information: invaild information loged in system"
    #                 print "         username: "+data["userName"]
    #                 print "         password: "+data["password"]
    #                 continue
    #             continue
    #
    #         try:
    #             assert "密码错误" in alert_txt
    #         except:
    #             print "Login function Testing FAILED! "
    #             print "Failed information: '密码错误' was not in alert text"
    #             print "         username: "+data["userName"]
    #             print "         password: "+data["password"]
    #
    #         alert.accept()
    #     print "Invaild information Login test is done."

    def test_blank_login(self):
        datas = self.collection.find({"status":False,"type":"blank"})
        print "Testing login function with blank information:"
        for data in datas:
            driver = self.test_step(data)
            alert_txt = self.invaild_information_get_alert(driver)
            if not alert_txt:
                print "Blank Test FAILED!!"
                print "Failed information: Blank information logged in system"
                print "         url: "+driver.current_url
                print "         username: "+data["userName"]
                print "         password: "+data["password"]
                print "\n\n"
            else:
                try:
                    assert "请登录" in alert_txt
                except:
                    print "Blank Test FAILED!!"
                    print "Failed information: '请登录' not in alert txt"
                    print "         username: "+data["userName"]
                    print "         password: "+data["password"]
                    print "\n"

        print "Blank information Login test is done.\n\n"

    def invaild_information_get_alert(self,driver):
            try:
                alert = driver.switch_to_alert()
                alert_txt = alert.text

            except:
                try:
                    assert "main" not in driver.current_url
                except:
                    return False

            else:
                alert.accept()
                return alert_txt


    def test_invaild_information(self):
        datas = self.collection.find({"status":False,"type":"invaild"})
        print "Testing Login function with invaild information: "
        for data in datas:
            driver = self.test_step(data)
            alert_txt = self.invaild_information_get_alert(driver)
            if not alert_txt:
                print "Invaild information Test FAILED! "
                print "Failed information: invaild information logged in system"
                print "         url: "+ driver.current_url
                print "         username: "+data["userName"]
                print "         password: "+data["password"]
                print "\n"
            else:
                try:
                    assert "密码错误" in alert_txt
                except:
                    print "Login function Testing FAILED! "
                    print "Failed information: '密码错误' was not in alert text"
                    print "         username: "+data["userName"]
                    print "         password: "+data["password"]
                    print "\n"

        print "Invaild information Login test is done.\n\n"


login1 = login()
login1.test_normal_login()
login1.test_invaild_information()
login1.test_blank_login()
del login1
