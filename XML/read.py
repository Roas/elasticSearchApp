import xml.etree.cElementTree as ET
from datetime import datetime
from elasticsearch import Elasticsearch
from elasticsearch import helpers
import xmltodict
import re

es = Elasticsearch(timeout=60, max_retries=10, retry_on_timeout=True)
actions = []
i = 0
index = 1
roundCount = 0
def process_buffer(buf):
    global actions, i, index
    page = xmltodict.parse(buf)
    try:
	text = page['page']['revision']['text']['#text']
        if (text[0] != '#'):
            createInput(page, text)
    except KeyError:
        print "No text found."
    if i < 788: # 788, 10672, 820
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

def checkfacet(text):
    facet = re.search(r'\[\[Categorie:(.*)Land(.*)\]\]', text)
    if (facet):
        return "Land"
    facet = re.search(r'\[\[Categorie:(.*)Dier(.*)\]\]', text)
    if (facet):
        return "Dier"
    facet = re.search(r'\[\[Categorie:(.*)Sport(.*)\]\]', text)
    if (facet):
        return "Sport"
    facet = re.search(r'\[\[Categorie:(.*)Televisie(.*)\]\]', text)
    if (facet):
        return "Televisie"
    facet = re.search(r'\[\[Categorie:(.*)Internet(.*)\]\]', text)
    if (facet):
        return "Internet"
    facet = re.search(r'\[\[Categorie:(.*)Muziek(.*)\]\]', text)
    if (facet):
        return "Muziek"
    facet = re.search(r'\[\[Categorie:(.*)Beroep(.*)\]\]', text)
    if (facet):
        return "Beroep"
    facet = re.search(r'\[\[Categorie:(.*)Geneeskunde(.*)\]\]', text)
    if (facet):
        return "Geneeskunde"
    facet = re.search(r'\[\[Categorie:(.*)Economie(.*)\]\]', text)
    if (facet):
        return "Economie"
    facet = re.search(r'\[\[Categorie:(.*)Politiek(.*)\]\]', text)
    if (facet):
        return "Politiek"
    return ""

def createInput(page, text):
    global actions, index
    facet = checkfacet(text)
    sourcedict = {'title': page['page']['title'],
        'text': text, 'facet': facet}
    foo = {'_index': 'wikipedia', '_op_type': 'create', '_type': "wikipedia pagina",
        '_id': index, '_source': sourcedict}
    actions.append(foo)

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
