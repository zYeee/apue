all : server fork_server select_server client

server:global.o server.o
fork_server:global.o fork_server.o
select_server:global.o select_server.o
client:global.o client.o

clean:
	rm *.o server fork_server select_server client
