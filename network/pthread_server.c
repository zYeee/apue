#include "global.h"
#include <pthread.h>

void *thread(void *vargp){
  int connfd = *((int *)vargp);
  printf("connected: conned:%d\n", connfd);
  pthread_detach(pthread_self());
  free(vargp); //function of free only can free the malloc and calloc
  echo(connfd);
  close(connfd);
  return NULL;
}

int main() {
  int listenfd, port, *connfdp;
  struct sockaddr_in clientaddr;
  int clientlen = sizeof(clientaddr);
  pthread_t tid;

  listenfd = open_listen(9301);
  while (1){
    /* will have rece problem
    int connfd = accept(listenfd, (struct sockaddr *)&clientaddr, &clientlen);*/
    connfdp = malloc(sizeof(int));
    *connfdp = accept(listenfd, (struct sockaddr *)&clientaddr, &clientlen);
    pthread_create(&tid, NULL, thread, connfdp);
  }
}
