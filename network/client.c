#include "stdio.h"
#include "string.h"
#include <netdb.h>
#include <arpa/inet.h>
#include <netinet/in.h>
#include <unistd.h>

int open_clientfd(char *hostname, int port){
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
int main(){
  char buf[1000];
  int clientfd = open_clientfd("localhost", 9301);
  while (scanf("%s", buf)){
    write(clientfd, buf, strlen(buf)+1);
    read(clientfd, buf, 999);
    printf("length : %d %s\n", strlen(buf), buf);
  }
}
