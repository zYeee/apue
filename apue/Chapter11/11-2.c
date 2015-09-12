#include <pthread.h>
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>

pthread_t ntid;


void printids(const char *s){
    pid_t pid;
    pthread_t tid;
    
    pid = getpid();
    tid = pthread_self();

    printf("%s:pid %lu tid %lu (0x%lx)\n", s, (unsigned long) pid, (unsigned long) tid, (unsigned long)tid);
}

void *thr_fn(void *arg){
    printids("new thread:");
    return ((void *)0);
}
/**
 * @brief main pthread 库不是 Linux 系统默认的库，连接时需要使用静态库 libpthread.a，所以在使用pthread_create()创建线程，以及调用 pthread_atfork()函数建立fork处理程序时，需要链接该库。
 * gcc thread.c -o thread -lpthread
 * @return 
 */
int main(){
    int err;
    void *p;
    err = pthread_create(&ntid, NULL, thr_fn, NULL);
    pthread_join(ntid, &p);
    printids("main thread:");
    exit(0);
}
