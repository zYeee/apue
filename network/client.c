#include "global.h"
int main(){
  char buf[1000];
  int clientfd = open_client("localhost", 9301);
  while (scanf("%s", buf)){
    write(clientfd, buf, strlen(buf)+1);
    read(clientfd, buf, 999);
    printf("length : %d %s\n", strlen(buf), buf);
  }
}
