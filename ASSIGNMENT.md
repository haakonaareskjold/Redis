Create a simple webserver that has the ability to update a counter per request.
For each request the webserver receives, add a log row with the current count of requests. You can write the log to stdout.

To test your webserver, we will use the tool Apache benchmark (ab) 
If we run the tool like this: 
$ ab -n 100 -c 10 <server>

Your webservers request counter should stop at exactly 100.
If possible, limit the use of external libraries as much as possible.
