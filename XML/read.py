import xml.etree.cElementTree as ET
from datetime import datetime
from elasticsearch import Elasticsearch
import xmltodict

# es = Elasticsearch()

def process_buffer(buf):
    #es.index(xmltodict.parse(buf)['page'])
    print xmltodict.parse(buf)['page']
    print datetime.now()-startTime
    exit()

startTime = datetime.now()
inputbuffer = ''
with open('wiki.xml','rb') as inputfile:
    append = False
    for line in inputfile:
        print
        if '<page>' in line:
            inputbuffer = line
            append = True
        elif '</page>' in line:
            inputbuffer += line
            append = False
            process_buffer(inputbuffer)
            inputbuffer = None
            del inputbuffer #probably redundant...
        elif append:
            inputbuffer += line
