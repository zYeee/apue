#include<stdio.h>
#include<string.h>
#include<stdlib.h>
#include"netdb.h"
#include"arpa/inet.h"
#include"netinet/in.h"
#include"unistd.h"

int open_listen(int port);
int open_client(char *hostname, int port);
void echo(int connfd);
