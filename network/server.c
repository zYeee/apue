#include "global.h"

int main(){
  struct sockaddr_in clientaddr;
  struct hostent *hp;
  char *haddrp;
  int listenfd = open_listen(9301);
  int clientlen = sizeof(clientaddr);
  while (1){
    int connfd = accept(listenfd, (struct sockaddr *)&clientaddr, &clientlen);
    printf("connfd:%d\n", connfd);
    hp = gethostbyaddr((const char *)&clientaddr.sin_addr.s_addr,
        sizeof(clientaddr.sin_addr.s_addr), AF_INET);
    haddrp = inet_ntoa(clientaddr.sin_addr);
    printf("to %s :(%s)\n", hp->h_name, haddrp);
    echo(connfd);
    close(connfd);
  }
}
