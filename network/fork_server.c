#include<stdio.h>
#include<string.h>
#include<sys/types.h>
#include<sys/wait.h>
#include"netdb.h"
#include"arpa/inet.h"
#include"netinet/in.h"
#include"unistd.h"
void sigchld_handler(int sig){
  while (waitpid(-1, NULL, 0) > 0);
  return;
}
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

void echo(int connfd){
  size_t n;
  char buf[1000];
  int len;
  while (len = read(connfd, buf, 999)){
    printf("length : %d %s\n", strlen(buf), buf);
    write(connfd, buf, len);
  }
}

int main(){
  int listenfd, connfd, port;
  struct sockaddr_in clientaddr;
  int clientlen = sizeof(clientaddr);
  struct hostent *hp;
  char *haddrp;
  
  signal(SIGCHLD, sigchld_handler);
  listenfd = open_listen(9301);
  while (1){
    int connfd = accept(listenfd, (struct sockaddr *)&clientaddr, &clientlen);
    if (fork() == 0){
      close(listenfd);
      printf("connfd:%d\n", connfd);
      hp = gethostbyaddr((const char *)&clientaddr.sin_addr.s_addr,
          sizeof(clientaddr.sin_addr.s_addr), AF_INET);
      haddrp = inet_ntoa(clientaddr.sin_addr);
      printf("to %s :(%s)\n", hp->h_name, haddrp);
      echo(connfd);
      close(connfd);
      exit(0);
    }
    close(connfd);
  }
}

