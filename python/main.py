import time 
import task 
import multiprocessing as mp

url_local = 'https://demo.sandemoindoteknologi.co.id'
number_of_page = 1 # jumlah halaman isi 100 post 


if __name__ == '__main__':
    n=1
    while n<=number_of_page:
        mp.Process(target=task.do_task, args=(100,n, url_local,)).start()
        n+=1

