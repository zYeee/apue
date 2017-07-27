#include "stdio.h"
#include "stdlib.h"
#include <sys/malloc.h>

#define MAX_LEVEL 32


typedef struct node{
  int key;
  int value;
  struct node *forward[0];
}node;

typedef struct sList{
  int level;
  node *head;
}sList;

int genRandomInt(){
  int k=1;
  while (rand()%2){
    k++;
  }
  k=(k<MAX_LEVEL)?k:MAX_LEVEL;  
  return k;
}
node* createNode(int h, int key, int value){
  node *n = (node *)malloc(sizeof(node)+h*sizeof(node));
  n->key = key;
  n->value = value;
  return n;

}
sList* sInit(){
  sList *l = (sList *)malloc(sizeof(sList));
  l->level = 0;
  l->head = createNode(MAX_LEVEL, 0, 0);
  for(int i=0;i<MAX_LEVEL;i++){
    l->head->forward[i] = NULL;
  }
  return l;
}
void sInsert(sList *l, int key, int value){
  int h = l->level;
  node *update[MAX_LEVEL];

  node *p = l->head;
  node *q;

  for (int i=h-1; i>=0; i--){
    while (1){
      q = p->forward[i];
      if(!q || q->key>key) break;
      p = q;
    }

    update[i] = p;
  }

  int k = genRandomInt();
  node *new = createNode(k, key, value);

  if (k>h){
    l->level = k;
    for (int i=h; i<k; i++){
      l->head->forward[i] = new;
    }
  }

  for (int i=0; i<h; i++){
    new->forward[i] = update[i]->forward[i];
    update[i]->forward[i] = new;
  }

}

int sFind(sList* l, int key){
  node *p = l->head;
  node *q;
  int h = l->level;
  for (int i=h-1; i>=0; i--){
    while (1){
      q = p->forward[i];
      if (q->key == key){
        return q->value;
      }
      if (!q || q->key>key) break;
      p = q;
    }
  }
  return -1;
}

int main(){
  int n, i;
  sList *l = sInit();
  scanf("%d", &n);
  for (i = 0; i < n; i++){
    int key, value;
    scanf("%d%d", &key, &value);
    sInsert(l, key, value);
  }

  printf("ok, input the key:\n");

  while(scanf("%d", &n)){
    printf("%d\n", sFind(l, n));
  }
  return 0;
}
