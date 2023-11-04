import requests
import json
import mig_function as fun
url_local = 'https://demo.sandemoindoteknologi.co.id'
print('Started')
r = requests.get('https://gemasulawesi.com/wp-json/wp/v2/posts?per_page=100&page=1')

data_artikel = r.json()
print('Data fetched')
n=0

url_insert = 'https://demo.sandemoindoteknologi.co.id/api/editorial/insert'

for data in data_artikel:
    try:
        category_id = fun.check_category(url_local, data)
        tags = fun.check_tags(url_local, data)

        # upload image 
        images = fun.upload_images(url_local, data['featured_media'])
        
        post_data = {
            'origin_id': data['id'],
            'title': data['title']['rendered'],
            'slug': data['slug'],
            'category': category_id,
            'description': data['yoast_head_json']['twitter_description'],
            'article': data['content']['rendered'],
            'allow_comment': False,
            'view_in_welcome_page': False,
            'author_id': 1,
            'editor_id': 1,
            'status': 'published',
            'post_image': images['data']['image_id'],
            'tags': json.dumps(tags)
        }

        
        # print(post_data)
        res = fun.insert_post(url_insert, post_data)
        # print(res)
        print(res.status_code)
    except:
        print('error')
    n+=1