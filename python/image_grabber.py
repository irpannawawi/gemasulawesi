import requests 
url = 'https://demo.sandemoindoteknologi.co.id'

# get post in local
posts = requests.get(url+'/api/posts').json()

for post in posts:
    # get post in source
    try:
        url_source = 'https://gemasulawesi.com/wp-json/wp/v2/posts/'+str(post['origin_id'])
        origin_post = requests.get(url_source).json()
        print('getting origin post')
    except:
        print('error while get origin post')
    
    try:
        media_url = "https://www.gemasulawesi.com/wp-json/wp/v2/media/"+str(origin_post['featured_media'])
        media = requests.get(media_url).json()
        print('getting origin media')

    except:
        print('error while getting media data')

    try:
        # upload image
        post_data = {
            'image_url': media['source_url'],
            'file_name': media['slug']+'.'+media['mime_type'].split('/')[1]
        }
        upload_url = url+'/api/photo/upload_image_only'
        res = requests.post(upload_url,  json=post_data)
        print(res.content)
    except:
        print('error while inserting')