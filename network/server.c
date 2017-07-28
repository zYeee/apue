#include"stdio.h"
#include"string.h"
#include <netdb.h>
#include <arpa/inet.h>
#include <netinet/in.h>

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
int main(){
  struct sockaddr_in clientaddr;
  int listenfd = open_listen(930);
  printf("%d\n", listenfd);
  int clientlen = sizeof(clientaddr);
  int connfd = accept(listenfd, (struct sockaddr *)&clientaddr, &clientlen);
  printf("%d", connfd);
}
