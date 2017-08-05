#include "sbuf.h"

#define NTHREADS 4
#define SBUFSIZE 16

sbuf_t sbuf;

void *thread(void *vargp){
  pthread_detach(pthread_self());
  int tidNo = (long long)vargp;
  while(1){
    int connfd = sbuf_remove(&sbuf);
    printf("the %d thread get the connection %d\n", tidNo, connfd);
    close(connfd);
  }
}

int main(){
  int listenfd, port, connfd;
  struct sockaddr_in clientaddr;
  int clientlen = sizeof(clientaddr);
  pthread_t tid;

  listenfd = open_listen(9301);

  sbuf_init(&sbuf, SBUFSIZE);
  long long i;

  for(i=0; i<NTHREADS; i++){
    printf("%d\n", i);
    pthread_create(&tid, NULL, thread, (void *)i);
  }
  while (1){
    connfd = accept(listenfd, (struct sockaddr *)&clientaddr, &clientlen);
    sbuf_insert(&sbuf, connfd);
  }
}
