# Automate posts on crypto currency site
Selenium Posts automotion

#### Example json Create post

Board need to be specified 

```json
{
    "user" : "myuser",
    "pass" : "mypassword",
    "ccode" : "01624f2a12deacf34ed8",
    "forum_url" : "index.php?action=post;board=33.0",
    "subject" : "One subject",
    "post" : "Post content"
}
```

Example return SUCCESS, HTTP CODE 200, OK

```json
{
  "message" : "created",
  "topic" : "5064710"
}
```

Example return ERROR HTTP CODE 400, ERROR

Note: Topic number its returned on created on json response

#### Example json Update post
```json
{
    "user" : "myuser",
    "pass" : "mypassword",
    "ccode" : "01624f2a12deacf34ed8",
    "forum_url" : "index.php?",
    "topic" : "5064710",
    "subject" : "One subject",
    "post" : "Post content"
}
```

Example return SUCCESS, HTTP CODE 200, OK
```json
{
  "message":"updated"
}
```

Example return ERROR HTTP CODE 400, ERROR

Note: Topic number its returned on created on json response
