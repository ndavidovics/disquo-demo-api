## DISQUO Demo Notes API

Main URL: http://54.196.211.73/api

#Register a user:

curl -i -H 'Accept: application/json' -d '{"name":"Foo","email":"email@mail.com","password":"12345678","c_password":"12345678"}' http://54.196.211.73/api/register

POST http://54.196.211.73/api/register 

Required Post Parameters:

name, email, password, c_password

Returns:

Bearer Token




#Login:

curl -i -H 'Accept: application/json' -d '{"email":"email@mail.com","password":"12345678"}' http://54.196.211.73/api/login

POST http://54.196.211.73/api/register 

Required Post Parameters:

email, password

Returns:

Bearer Token


sample login: test@gmail.com  password:12345678


To access CRUD operations, you need to include Token in Authorization header associated with a registered user



#List Notes: 

curl -i -H 'Accept: application/json' -H "Authorization: Bearer {token}" http://54.196.211.73/api/notes

GET http://54.196.211.73/api/notes

Returns all notes associated with user


#Create Note:

curl -i -H 'Accept: application/json' -H "Authorization: Bearer {token}" -d '{"title":"title","text":"sample note text"}' http://54.196.211.73/api/note

POST http://54.196.211.73/api/note

Post Parameters:

title, text

Returns:

Created Note


#Retrieve Note:

curl -i -H 'Accept: application/json' -H "Authorization: Bearer {token}" http://54.196.211.73/api/note/{note_id}

GET http://54.196.211.73/api/note/{note_id}

Returns:

Retrieved Note



#Update Note:

curl -i -H 'Accept: application/json' -H "Authorization: Bearer {token}" -X PUT -d '{"title":"title","text":"sample note text"}' http://54.196.211.73/api/note/{note_id}

PUT http://54.196.211.73/api/note/{note_id}

Post Parameters:

title, text

Returns:

Updated Note



#Delete Note:

curl -i -H 'Accept: application/json' -H "Authorization: Bearer {token}" -X DELETE http://54.196.211.73/api/note/{note_id}

DELETE http://54.196.211.73/api/note/{note_id}

Returns:

True upon success



