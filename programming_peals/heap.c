#include<stdio.h>

#define LL(x) (x<<1)
#define RR(x) ((x<<1)|1)

void swap(int *a, int *b){
    *a = *a ^ *b;
    *b = *a ^ *b;
    *a = *a ^ *b;
}
void create_heap(int x, int heap[],int num){
    heap[num] = x;
    while(num && heap[num/2] > heap[num]){
        swap(&heap[num], &heap[num/2]);
        num /= 2;
    }
}
void output(int heap[], int num){
    int i;
    for(i = 1;i <= num; i++){
        printf("%d%s", heap[i],i == num?"\n":" ");
    }
}
int main(){
    int x;
    int num = 1;
    int heap[1000];
    while(1){
        scanf("%d", &x);
        create_heap(x, heap, num);
        output(heap, num);
        num++;
    }
    return 0;
}
