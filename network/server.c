#include "stdio.h"
#include <netdb.h>
int open_clientfd(char *hostname, int port){
  int clientfd;
  struct hostent *hp;
  hp = gethostbyname(hostname);
  printf("%s", hp->h_name);
}
int main(){
  int a = open_clientfd("localhost", 80);

}
