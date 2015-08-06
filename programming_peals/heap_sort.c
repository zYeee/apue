#include<stdio.h>
/**
 * @file heap_sort.c
 * @brief 堆排序
 * @author zhuye,yformat930@126.com
 * @version 1.0
 * @date 2015-08-06
 */

#define LL(x) (x<<1)
#define RR(x) ((x<<1)|1)

void swap(int *a, int *b){
    *a = *a ^ *b;
    *b = *a ^ *b;
    *a = *a ^ *b;
}
void create_heap(int x, int heap[], int index){
    heap[index] = x;
    while(index > 1 && heap[index/2] < heap[index]){
        swap(&heap[index/2], &heap[index]);
        index /= 2;
    }
}
void siftdown(int n,int heap[]){
    int i = 1;
    while(1){
        int c = LL(i);
        if(c > n ){
            break;
        }
        if(c+1 <= n && heap[c] <= heap[RR(i)]){
            c++;
        }
        if(heap[i] >= heap[c]){
            break;
        }
        swap(&heap[i], &heap[c]);
        i = c;
    }
}
void heap_sort(int heap[], int n){
    int i;
    int j;
    for(i = n; i >= 1; i--){
        heap[i+1] = heap[1];
        heap[1] = heap[i];
        siftdown(i, heap);
    }
}
int main(){
    int n, i;
    int tmp;
    int heap[1000];
    while(~scanf("%d", &n)){
        for(i = 0; i < n; i++){
            scanf("%d", &tmp);
            create_heap(tmp, heap, i+1);
        }
        heap_sort(heap, n);
        for(i = 2; i <= n+1 ;i++){
            printf("%d%s", heap[i],i==n+1?"\n":" ");
        }
    }
    return 0;
}
