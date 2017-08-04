#include "global.h"
#include <pthread.h>

void *thread(void *vargp){
  int connfd = *((int *)vargp);
  pthread_detach(pthread_self());
  echo(connfd);
  close(connfd);
  return NULL;
}

int main() {
  int listenfd, connfd, port;
  struct sockaddr_in clientaddr;
  int clientlen = sizeof(clientaddr);
  pthread_t tid;

  listenfd = open_listen(9301);
  while (1){
    // will have rece problem
    connfd = accept(listenfd, (struct sockaddr *)&clientaddr, &clientlen);
    pthread_create(&tid, NULL, thread, &connfd);
  }
}
