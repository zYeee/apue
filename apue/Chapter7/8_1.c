#include<apue.h>
int globvar = 6;
char buf[] = "a write to stdout\n";
int main(){
    int var;
    pid_t pid;
    
    var = 88;

    printf("before fork\n");
    if((pid = fork()) < 0){
        printf("error") ;
    }
    else if(pid == 0){
        globvar++;
        var++;
    }
    else{
        sleep(2);
    }
    printf("pid = %ld, glob = %d, var = %d\n", (long)getpid(), globvar, var);
    exit(0);
    return 0;
}
