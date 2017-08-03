#include "global.h"
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
