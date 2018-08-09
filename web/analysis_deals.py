# Imports the Google Cloud client library
from google.cloud import language
from google.cloud.language import enums
from google.cloud.language import types
from algoliasearch import algoliasearch
import six;

client = algoliasearch.Client("WEQ1ZSOQ0G", '385f901dcaf5f9c89672ba880f4b5eab')
index = client.init_index('deal_search')

# Instantiates a client
client = language.LanguageServiceClient()
query = "" # Empty query will match all records
res = index.browse_all({"query": query, "filters": ""})


    
def classify_text(text):
    """Classifies content categories of the provided text."""
    client = language.LanguageServiceClient()

    if isinstance(text, six.binary_type):
        text = text.decode('utf-8')

    document = types.Document(
        content=text.encode('utf-8'),
        type=enums.Document.Type.PLAIN_TEXT)

    categories = client.classify_text(document).categories
    
    returnVal = [] 
    for category in categories:
         dict = {}
#        print(u'=' * 20)
#        print(u'{:<16}: {}'.format('name', category.name))
#        print(u'{:<16}: {}'.format('confidence', category.confidence))    
	 dict["name"] = category.name;
	 dict["confidence"] = category.confidence;
	 print dict;
	 returnVal.append(dict)
   
    return returnVal;

    
def entities_text(text):
    """Detects entities in the text."""
    client = language.LanguageServiceClient()

    if isinstance(text, six.binary_type):
        text = text.decode('utf-8')

    # Instantiates a plain text document.
    document = types.Document(
        content=text,
        type=enums.Document.Type.PLAIN_TEXT)

    # Detects entities in the document. You can also analyze HTML with:
    #   document.type == enums.Document.Type.HTML
    entities = client.analyze_entities(document).entities

    # entity types from enums.Entity.Type
    entity_type = ('UNKNOWN', 'PERSON', 'LOCATION', 'ORGANIZATION',
                   'EVENT', 'WORK_OF_ART', 'CONSUMER_GOOD', 'OTHER')

    for entity in entities:
        print('=' * 20)
        print(u'{:<16}: {}'.format('name', entity.name))
        print(u'{:<16}: {}'.format('type', entity_type[entity.type]))
        print(u'{:<16}: {}'.format('metadata', entity.metadata))
        print(u'{:<16}: {}'.format('salience', entity.salience))
        print(u'{:<16}: {}'.format('wikipedia_url',
              entity.metadata.get('wikipedia_url', '-')))
        
        

for hit in res:
    text = hit["deal_title"] + ' ' + hit["deal_description"];
    id = hit["objectID"];
    val = classify_text(text);
    index.partial_update_objects([{"objectID":id,"deal_category":val}]);
    
