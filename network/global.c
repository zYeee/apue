#include"global.h"

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

int open_client(char *hostname, int port){
  int clientfd;
  struct hostent *hp;
  struct sockaddr_in serveraddr;
  clientfd = socket(AF_INET, SOCK_STREAM, 0);
  hp = gethostbyname(hostname);
  bzero((char *) &serveraddr, sizeof(serveraddr));
  serveraddr.sin_family = AF_INET;
  bcopy((char *) hp->h_addr_list[0],
      (char *)&serveraddr.sin_addr.s_addr, hp->h_length);
  serveraddr.sin_port = htons(port);
  connect(clientfd, (struct sockaddr *)&serveraddr, sizeof(serveraddr));
  return clientfd;
}

void echo(int connfd){
  size_t n;
  char buf[1000];
  int len;
  while (len = read(connfd, buf, 999)){
    printf("length : %d %s\n", strlen(buf), buf);
    write(connfd, buf, len);
  }
}

