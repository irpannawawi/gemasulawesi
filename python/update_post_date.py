import requests as rq
url_local = 'http://gemasulawesi.test'

posts = rq.get(url_local+'/api/posts').json()

for post in posts:
    try:
        url_source = 'https://gemasulawesi.com/wp-json/wp/v2/posts/'+str(post['origin_id'])
        origin_post = rq.get(url_source).json()
        # update date
        update = rq.post(url_local+'/api/update_post_date', data={'origin_id': post['origin_id'], 'date':origin_post['date'] })
        print(f'{update.json()['status']} {post['origin_id']}')
    except:
        print(f'Error while updating {post['origin_id']}')
