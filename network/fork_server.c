#include<sys/types.h>
#include<sys/wait.h>
#include"global.h"
void sigchld_handler(int sig){
  while (waitpid(-1, NULL, 0) > 0);
  return;
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

