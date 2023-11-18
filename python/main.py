import time 
import task 
import multiprocessing as mp

url_local = 'https://demo.sandemoindoteknologi.co.id'
page_start = 1 # jumlah halaman isi 100 post 
page_end = 4  

proccess_list = []
lock = mp.Lock()
if __name__ == '__main__':

    while page_start<=page_end:
        p = mp.Process(target=task.do_task, args=(100,page_start, url_local, lock,))
        p.start()
        proccess_list.append(p)
        page_start+=1

    for p in proccess_list:
        p.join()

