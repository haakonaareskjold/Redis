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

2. To make this happen, a service is installing redis, which will be used for caching.
There is also the composer container which installs the required dependency, to make the AB container run after
composer is not started, but also ready- I've added a healthcheck on the PHP container which simply just adds a delay
before the final service is executed.

3. In the end a server running Apache2 benchmark tool will execute a command running 100 GET requests
towards the IP address assigned to the docker container with PHP.