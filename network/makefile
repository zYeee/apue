bins = server fork_server select_server client 
bins_special = pthread_server prethreading_server
bins_all = $(bins) $(bins_special)
all: $(bins) $(bins_special)

#<targets ...> : <target-pattern> : <prereq-patterns> $@ --> target-patterns $< --> prereq-patterns
$(bins) : % : %.o global.o

pthread_server :  pthread_server.o
	cc -o pthread_server global.o pthread_server.o -lpthread

prethreading_server : prethreading_server.o sbuf.o
	cc -o prethreading_server global.o sbuf.o prethreading_server.o  -lpthread

.PHONY : all clean
clean:
	-rm *.o $(bins_all)
