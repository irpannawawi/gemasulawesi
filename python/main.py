import time 
import task 
import multiprocessing as mp

url_local = 'http://gemasulawesi.test'
page_start = int(input('page start:')) # jumlah halaman isi 100 post 
page_end = int(input('Page End:'))
per_page = int(input('per page:'))

proccess_list = []
lock = mp.Lock()
if __name__ == '__main__':

    while page_start<=page_end:
        task.do_task(per_page=per_page, page=page_start)
        page_start= page_start+1
