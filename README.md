Write in Laravel PHP a simple backend app which does the following:
Having an API which provide an ability to login (list of users may be pre-defined in DB)
Having an API to create/read/update user's profile data. Which includes: Username, User image (on creation uploaded via API as a file), year of birth
Having an API to add a tweet (containing only a text up to 140 chars)
Having a public API to list all tweets of a user with the specific userID (each tweet should also include creation date, and a link to user image)
Having a public API to list a random tweet of a random user (this tweet should also include creation date, and a link to user image)
Please let me know if you have any questions. 

This was everything I received as a task.

Standard procedure for me is to write a text file, translating task to my language and ensuring I will not forget something simple.
Current file is a little bloated, to be better readable.
Everything I have questions about I mark with QUESTION: block.
Everything I can implement, but it was not required goes under TODO: group. 

I decided to use task to simplify it a bit for me, so main reason is "SIMPLE backend app".
So - security and\or paranoia is set to minimal values.

Project name and localhost - simpla.pi 



Database:
    tweets{
        id  -   int. autoincrement
        creator - int, index, = id of user author in users table
        text - char 140 - hard limit on size as requested
        timestamps - default
    }

    user{
        add columns
        birthdate - DATE
    }

TODO: depending on project can be wise to remove all "extra" user data from 'user' table used for login purposes to some
tables designed to store this rather cold data.
Also, no user removal were required, so no soft delete, delete cascade, removal of unused avatars implemented.



User Images:
User image => avatar
uploads to public/avatars
naming - simplest and most stupid approach, user_id.jpg as only unique value without adding tables in database.

TODO: in real project where I must care about security, obscurity and inodes in folder(hosting dependent) I would create
a DB table, to save images with long unique names (SHA5, murmur maybe), and to serve them with slug of username 
as image name. Depends on project and task actually.  



User authentication:
Laravel passport used, easier to install and use than to invent something "maybe not simpler and definitely more buggy".
Implementing any additional security layers is an overkill for simple app.



Auth routes:
    
    POST api/register -> standard (name - email - password - password_confirmation)
    POST api/login -> standard (email - password)

    POST api/add-tweet -> (text)
    POST api/update-user -> (name - image - birthdate) //because PUT will not upload file, and it is wise to have single
        page for user editing themselves.

Public routes:

    GET api/randomtweet -> random tweet from all tweets, (tweet - link to user image - creation date)
    GET api/tweets/user_id -> all tweets from user or 404, (tweet - link to user image - creation date)

No auth or middleware except out-of-the-box here.

