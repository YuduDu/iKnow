from pymongo import MongoClient
client = MongoClient('localhost', 27017)

db = client.iknowTest
print "haha1"

datas = db.Login
print "haha2"

for data in datas.find({"status":True}):
	print "userName:" + data["userName"]
	print "Password:" + data["password"]
