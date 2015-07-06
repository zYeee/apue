#include<apue.h>
#include<sys/wait.h>
int main(){
    pid_t pid;
    int status;
    if((pid = fork()) < 0){
        //err_sys("fork error");
    }
    else if(pid == 0){
        return 0;
    }
    printf("%d\n",pid);
    printf("%d\n",wait(&status));
}
