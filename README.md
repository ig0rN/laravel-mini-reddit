# eyesee-reddit mini app
 
## Installation

- pull repository from git
- open terminal, go to project file and run command 'composer update'
- make a copy of '.env.examples' and name it '.env'
- set database credentials
- in terminal run command 'php artisan migrate:fresh --seed'
- in 'oauth_clients' you will find 'secrets' field filled up after seed

## Other notes about project

- This is my first real API project. Until now I worked in Laravel just with blades and practiced API beside.
- I focused on the main thing such as:
    1) registration / login
    2) CRUD
    3) other logic
    4) testing app via Postman
    5) writing documentation
- I didn't make FE because my main goal is to provide a good BE in the deadline of 9 hours because I'm applying for BE Dev.
- If it's necessary I can easily make some simple bootstrap pages and show data with JQuery.

## API endpoints

| HTTP method | Endpoint | Function | Post Data |
| --- | --- | --- | --- |
| --- | --- | --- | --- |
| GET | /threads | Retrive all threads with all their comments | / |
| POST | /threads | Create new thread and retrive it | 'name' - string/required, 'content' - string/required, 'comments_visible' - 0,1/optional |
| GET | /threads/{thread_id} | Retrive sprecific thread | / |
| PUT | /threads/{thread_id} | Update specific thread and retrive it | / |
| DELETE | /threads/{thread_id} | Delete specific thread | / |
| POST | /threads/{thread_id} | Comment on specific thread | 'content' - string/required |
| --- | --- | --- | --- |
| GET | /comments/{comment_id} | Retrive sprecific comment | / |
| POST | /comments/{comment_id} | Comment on specific comment | 'content' - string/required |
| DELETE | /comments/{comment_id} | Delete specific comment | / |