import requests
import json

url_local = 'http://gemasulawesi.test'
print('Started')
r = requests.get('https://gemasulawesi.com/wp-json/wp/v2/posts?per_page=10&page=2')

data_art = r.json()
print('Data fetched')
n=0

url_insert = 'http://gemasulawesi.test/api/editorial/insert'
def insert_post(dt):
        req = requests.post(url_insert, dt)
        return req
for data in data_art:
    # ======================== Category check ===============================
    print('Checking category')
    # check category name
    if(len(data['categories'])>1):
        category_id = data['categories'][1]
    else:
        category_id = data['categories'][0]
    # gat category name
    category_url = 'https://gemasulawesi.com/wp-json/wp/v2/categories/'+str(category_id)
    r_cat = requests.get(category_url).json()
    category_name = r_cat['name']

    # check cat name in database
    get_local_category = requests.get(url_local+'/api/rubrik', {'rubrik_name':category_name}).json()
    if(get_local_category['status']==True):
        local_cat_id = get_local_category['data'][0]['rubrik_id']
    else:
        set_local_category = requests.post(url_local+'/api/rubrik/insert', {'rubrik_name':category_name}).json()
        local_cat_id = set_local_category['data']['rubrik_id']
    # ======================== ./Category check ===============================
    arr_tag = []
    # ======================== Tags check ================================
    print('Checking Tags')
    for tag in data['tags']:
        # gat category name
        tag_url = 'https://gemasulawesi.com/wp-json/wp/v2/tags/'+str(tag)
        r_tag = requests.get(tag_url).json()
        tag_name = r_tag['name']
        get_local_tag = requests.get(url_local+'/api/tag', {'tag_name':tag_name}).json()
        if(get_local_tag['status']==True):
            local_tag_id = get_local_tag['data'][0]['tag_id']
        else:
            set_local_tag = requests.post(url_local+'/api/tag/insert', {'tag_name':tag_name}).json()
            local_tag_id = set_local_tag['data']['tag_id']
        
        arr_tag.append(str(local_tag_id))
    # ======================== ./Tags check ===============================

    post_data = {
        'post_id': data['id'],
        'title': data['title']['rendered'],
        'slug': data['slug'],
        'category': local_cat_id,
        'description': data['yoast_head_json']['twitter_description'],
        'article': data['content']['rendered'],
        'allow_comment': True,
        'view_in_welcome_page': False,
        'author_id': 1,
        'editor_id': 1,
        'status': 'published',
        'post_image': data['yoast_head_json']['twitter_image'],
        'tags': json.dumps(arr_tag)
    }

    print('inserting article')
    res = insert_post(post_data)
    print(res.json())
    print(res.status_code)
    n+=1