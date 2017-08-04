bins = server fork_server select_server pthread_server client 
all : $(bins) 

server:global.o server.o
fork_server:global.o fork_server.o
select_server:global.o select_server.o
pthread_server:global.o pthread_server.o
	cc -o pthread_server global.o pthread_server.o -lpthread
client:global.o client.o

.PHONY : clean
clean:
	-rm *.o $(bins)
