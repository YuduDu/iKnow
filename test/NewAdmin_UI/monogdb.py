from pymongo import MongoClient

class mongodb:
    def __init__(self):
        self.client = MongoClient('localhost',27017)
        self.db = self.client.iknowTest

    def get_collection(self,collection_name):
        return self.db[collection_name]