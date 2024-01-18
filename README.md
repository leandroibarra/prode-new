# Prode New

## Server

### Authentication
```
curl --location 'http://api.prode-new.loc/api/v1/auth/login' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email": "admin@prode.loc",
    "password": "12345678"
}'
```

### Refresh Token
```
curl --location --request POST 'http://api.prode-new.loc/api/v1/auth/refresh' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vYXBpLnByb2RlLW5ldy5sb2MvYXBpL3YxL2F1dGgvbG9naW4iLCJpYXQiOjE3MDQwMjU5NDgsImV4cCI6MTcwNDAyOTU0OCwibmJmIjoxNzA0MDI1OTQ4LCJqdGkiOiJFWDJobzBUcjVOeWFmS0tNIiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.KeF_5dUwrJBF_Kfz5c7DcjN17mgs0KxO5Unljsknd7s'
```

### Logout
```
curl --location --request POST 'http://api.prode-new.loc/api/v1/auth/logout' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vYXBpLnByb2RlLW5ldy5sb2MvYXBpL3YxL2F1dGgvcmVmcmVzaCIsImlhdCI6MTcwNDAyNTk0OCwiZXhwIjoxNzA0MDI5NTgzLCJuYmYiOjE3MDQwMjU5ODMsImp0aSI6ImI5Y2F1bnd6VXViRUFEbngiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.86tySeipH6fNmpkx2egkAgnMUfYd5296Yyz6YD3KYas'
```

### Filtering
````
curl --location 'http://api.prode-new.loc/api/v1/teams/2?filter=id:in:1|2|3' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vYXBpLnByb2RlLW5ldy5sb2MvYXBpL3YxL2F1dGgvbG9naW4iLCJpYXQiOjE3MDQzMDkxMjgsImV4cCI6MTcwNDMxMjcyOCwibmJmIjoxNzA0MzA5MTI4LCJqdGkiOiIzcUNOS2YzSDNDTlRyM0pXIiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.JcR1h3kwC1xR6Y02MbGnLAsEwj7dHfO0_-nJA3jn_T0'
````

### Pagination
```
curl --location 'http://api.prode-new.loc/api/v1/teams/2?filter=name:ct: a&page=1'
```
