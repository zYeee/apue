#include<stdio.h>
#include<string.h>
#include"netdb.h"
#include"arpa/inet.h"
#include"netinet/in.h"
#include"unistd.h"

typedef struct {
  int maxfd;
  fd_set read_set;
  fd_set ready_set;
  int nready;
  int maxi;
  int clientfd[FD_SETSIZE];
} pool;

int open_listen(int port){
  int listenfd, optval = 1;
  struct sockaddr_in serveraddr;

  listenfd = socket(AF_INET, SOCK_STREAM, 0);
  setsockopt(listenfd, SOL_SOCKET, SO_REUSEADDR, (const void *)&optval, sizeof(int));

  bzero((char *) &serveraddr, sizeof(serveraddr));
  serveraddr.sin_family = AF_INET;
  serveraddr.sin_addr.s_addr = htonl(INADDR_ANY);
  serveraddr.sin_port = htons((unsigned short)port);

  bind(listenfd, (struct sockaddr *)&serveraddr, sizeof(serveraddr));
  listen(listenfd, 1024);
  return listenfd;
}

void init_pool(int listenfd, pool *p){
  int i;
  p->maxi = -1;
  for (i=0; i<FD_SETSIZE; i++){
    p->clientfd[i] = -1;
  }

  p->maxfd = listenfd;
  FD_ZERO(&p->read_set);
  FD_SET(listenfd, &p->read_set);
}

void add_client(int connfd, pool *p){
  int i;
  p->nready--;
  for (i=0;i<FD_SETSIZE;i++){
    if (p->clientfd[i]<0){
      p->clientfd[i] = connfd;
      FD_SET(connfd, &p->read_set);
      p->maxfd = connfd > p->maxfd ? connfd : p->maxfd;
      p->maxi = i > p->maxi ? i : p->maxi;
      break;
    }
  }
}

void check_clients(pool *p){
  int i, connfd, n;
  char buf[1000];

  for (i=0; (i <= p->maxi)&&(p->nready>0);i++){
    connfd = p->clientfd[i];
    if (connfd && FD_ISSET(connfd, &p->ready_set)){
      p->nready--;
      if (read(connfd, buf, 999)){
        printf("connfd:%d length : %d %s\n",connfd, strlen(buf), buf);
        write(connfd, buf, strlen(buf));
      }
      else {
        close(connfd);
        FD_CLR(connfd, &p->read_set);
        p->clientfd[i] = -1;
      }
    }
  }
}

int main(){
  struct sockaddr_in clientaddr;
  int listenfd = open_listen(9301);
  int clientlen = sizeof(clientaddr);
  static pool pool;
  init_pool(listenfd, &pool);
  while(1){
    pool.ready_set = pool.read_set;
    pool.nready = select(pool.maxfd + 1, &pool.ready_set, NULL, NULL, NULL);

    if (FD_ISSET(listenfd, &pool.ready_set)){
      int connfd = accept(listenfd, (struct sockaddr *)&clientaddr, &clientlen);
      printf("connected connfd:%d\n", connfd);
      add_client(connfd, &pool);
    }

    check_clients(&pool);
  }
}
