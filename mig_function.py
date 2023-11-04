import requests

def check_category(url_local, data):
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
    return local_cat_id
    # ======================== ./Category check ===============================


def check_tags(url_local, data):
     # ======================== Tags check ================================
    print('Checking Tags')
    arr_tag = []
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
    return arr_tag
    # ======================== ./Tags check ===============================


def insert_post(url_insert, dt):
    print('inserting article')
    req = requests.post(url_insert, headers={'Accept': 'Application/json'}, json=dt)
    return req

def upload_images(local_url, media_id):
    # getting media info
    media_url = "https://www.gemasulawesi.com/wp-json/wp/v2/media/"+str(media_id)
    media = requests.get(media_url).json()
    # print(media)
    # upload image
    post_data = {
        'author': 1,
        'caption': media['caption']['rendered'],
        'credit': media['media_details']['image_meta']['credit'],
        'source': media['media_details']['image_meta']['copyright'],
        'image_url': media['source_url'],
        'file_name': media['slug']+'.'+media['mime_type'].split('/')[1]
    }
    url = local_url+'/api/photo/upload'
    return requests.post(url,  json=post_data).json()
