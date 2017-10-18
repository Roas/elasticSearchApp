import xml.etree.cElementTree as ET
from datetime import datetime
from elasticsearch import Elasticsearch
import xmltodict

es = Elasticsearch()

i = 1
def process_buffer(buf):
    global i
    es.index(index=xmltodict.parse(buf)['page']['id'], doc_type="wikipedia pagina",
        id=xmltodict.parse(buf)['page']['id'], body=xmltodict.parse(buf)['page'])
    print i
    i += 1

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
