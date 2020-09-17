# Redis benchmarking test

### Requirement
* Docker
* Docker-compose

### How to run
* simply use `docker-compose up` and everything will happen automatically

### What is happening?
1. When running the docker-compose services first the PHP container will boot up a local webserver,
then it runs a php script that outputs to STDERR for every GET request sent by using Redis for
memory caching. If it surpasses 100 request, it will reset the counter.

2. To make this happen, a service is installing composer with the required predis package,
and not least a service is installing a container with Redis.

3. Finally, a service with Apache2 benchmark tool will execute a command running 100 GET requests
towards the network bridge IP.