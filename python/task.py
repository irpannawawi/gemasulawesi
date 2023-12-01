import requests
import json

def do_task(per_page, page, url_local='http://gemasulawesi.test'):
    print(f'Started page {page}')
    r = requests.get('https://gemasulawesi.com/wp-json/wp/v2/posts?per_page='+str(per_page)+'&page='+str(page)+'&order=asc')
    data_artikel = r.json()
    print('Data fetched')
    # send data to fetch
    requests.post(url=url_local+'/api/migrate',headers={'Accept': 'Application/json'},json=data_artikel)
