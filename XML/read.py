import xml.etree.cElementTree as ET
from datetime import datetime
from elasticsearch import Elasticsearch
from elasticsearch import helpers
import xmltodict

i = 1
actions = []
def process_buffer(buf):
    global i
    global actions
    foo = {'_index': xmltodict.parse(buf)['page']['id'], '_type': "wikipedia pagina",
        '_id': xmltodict.parse(buf)['page']['id'], '_source': xmltodict.parse(buf)['page']}
    actions.append(foo)
    print i
    i += 1

inputbuffer = ''
with open('wiki.xml','rb') as inputfile:
    append = False
    for line in inputfile:
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

es = Elasticsearch()
print "Time for bulk"
helpers.bulk(es, actions)
