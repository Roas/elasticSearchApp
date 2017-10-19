import xml.etree.cElementTree as ET
from datetime import datetime
from elasticsearch import Elasticsearch
from elasticsearch import helpers
import xmltodict

es = Elasticsearch(timeout=60, max_retries=10, retry_on_timeout=True)
actions = []
i = 1
index = 1
roundCount = 0
def process_buffer(buf):
    global actions, i, index
    page = xmltodict.parse(buf)
    createInput(page)
    if i < 10672:
        i += 1
    else:
        global es
        global roundCount
        roundCount += 1
        print "Time for bulk : " + str(roundCount)
        helpers.bulk(es, actions)
        i = 0
        actions = []
    index += 1

def createInput(page):
    global actions, index
    try:
        sourcedict = {'title': page['page']['title'],
            'text': page['page']['revision']['text']['#text']}
        foo = {'_index': 'wikipedia', '_op_type': 'create', '_type': "wikipedia pagina",
            '_id': index, '_source': sourcedict}
        actions.append(foo)
    except KeyError:
        print "No text found."

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
