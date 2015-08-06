#include<stdio.h>

#define LL(x) (x<<1)
#define RR(x) ((x<<1)|1)


int main(){
    int x;
    scanf("%d", &x);
    printf("%d\n", RR(x));
    return 0;
}
