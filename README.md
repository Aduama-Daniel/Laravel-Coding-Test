

```markdown
# Laravel Todo API

## Introduction

The Laravel Todo API is a simple API for managing todos. It allows you to retrieve all todos, retrieve a single todo, create a new todo, update a todo, and delete a todo.

## Installation

To install the Laravel Todo API, follow these steps:


```bash
# Install dependencies
composer install

# Copy the environment file
cp .env.example .env

# Generate the application key
php artisan key:generate

# Run migrations
php artisan migrate
```

## Authentication

Some endpoints in the API require user authentication using Laravel Sanctum. Here's how to authenticate and make authenticated requests:

1. **Register a User:**
   - Before making authenticated requests, you need to register a user.
   - Use the following endpoint to register a new user:

   ```bash
   curl -X POST -H "Content-Type: application/json" -d '{"name":"Your Name","email":"your@email.com","password":"yourpassword"}' http://your-api-url/register
   ```

   Replace `Your Name`, `your@email.com`, and `yourpassword` with your desired user details.

2. **Login to Get Token:**
   - After registering, you need to log in to obtain an authentication token.
   - Use the following endpoint to log in:

   ```bash
   curl -X POST -H "Content-Type: application/json" -d '{"email":"your@email.com","password":"yourpassword"}' http://your-api-url/login
   ```

   Save the token from the response; you'll need it for authenticated requests.

3. **Include Token in Authenticated Requests:**
   - For routes that require authentication (POST, PUT, DELETE), include the obtained token in the request headers:

   ```bash
   curl -X POST -H "Content-Type: application/json" -H "Authorization: Bearer YOUR_TOKEN" -d '{"title":"New Todo"}' http://your-api-url/api/todos
   ```

   Replace `YOUR_TOKEN` with the token obtained during login.


## API Endpoints

### 1. Retrieve All Todos

- **HTTP Method:** GET
- **Endpoint URL:** `/api/todos`
- **Parameters:** None
- **Expected Response:**
  ```json
  [
    {
      "id": 1,
      "title": "Todo 1",
      "completed": false,
      "description":"What is there todo"
    },
    {
      "id": 2,
      "title": "Todo 2",
      "completed": true,
       "description":"What is already done"
    }
   
  ]
  ```

### 2. Retrieve Single Todo

- **HTTP Method:** GET
- **Endpoint URL:** `/api/todos/{id}`
- **Parameters:**
  - `id` (integer) - The ID of the todo to retrieve
- **Expected Response:**
  ```json
  {
    "id": 1,
    "title": "Todo 1",
    "completed": false,
     "description":"What is there todo"
  }
  ```

### 3. Create Todo

- **HTTP Method:** POST
- **Endpoint URL:** `/api/todos`
- **Parameters:**
  - `title` (string, required) - The title of the todo
- **Request Body:**
  ```json
  {
    "title": "New Todo",
    "description":"Not alot to be done"
  }
  ```
- **Expected Response:**
  ```json
  {
    "id": 3,
    "title": "New Todo",
    "completed": false,
    "description":"Not alot to be done"
  }
  ```

### 4. Fetch Data from JSON Placeholder

- **HTTP Method:** GET
- **Endpoint URL:** `/fetch-from-placeholder`
- **Authentication:** No authentication required
- **Expected Response:**
  ```json
  
    {
        "userId": 1,
        "id": 1,
        "title": "delectus aut autem",
        "completed": false
    },
    {
        "userId": 1,
        "id": 2,
        "title": "quis ut nam facilis et officia qui",
        "completed": false
    },
    {
        "userId": 1,
        "id": 3,
        "title": "fugiat veniam minus",
        "completed": false
    },
    {
        "userId": 1,
        "id": 4,
        "title": "et porro tempora",
        "completed": true
    },
    {
        "userId": 1,
        "id": 5,
        "title": "laboriosam mollitia et enim quasi adipisci quia provident illum",
        "completed": false
    }
    
  ```

## Examples

Provide examples of how to use your API. Include example requests and responses.

### Example 1: Retrieve All Todos

**Request:**
```bash
curl -X GET http://127.0.0.1:8000/api/todos
```

**Response:**
```json
[
  {
    "id": 1,
    "title": "Todo 1",
    "completed": false
  },
  {
    "id": 2,
    "title": "Todo 2",
    "completed": true
  }
  
]
```

### Example 2: Retrieve Single Todo

**Request:**
```bash
curl -X GET http://127.0.0.1:8000/api/todos/2
```

**Response:**
```json
{
  "id": 2,
  "title": "Todo 1",
  "completed": false
}
```

### Example 3: Create Todo (Authenticated)

**Request:**
```bash
# Log in to obtain the authentication token
curl -X POST -H "Content-Type: application/json" -d '{"name":"yourname","email":"your@email.com","password":"yourpassword"}' http://127.0.0.1:8000/api/register
# Use the obtained token to create a new todo
curl -X POST -H "Content-Type: application/json" -H "Authorization: Bearer YOUR_TOKEN" -d '{"title":"New Todo"}' http://127.0.0.1:8000/api/todos




## Error Messages

List the possible error messages that your API can return, and explain what each one means.

- **400 Bad Request:** Invalid request format or parameters.
- **401 Bad Request:** Invalid credentials.
- **404 Not Found:** The requested resource does not exist.
- **500 Internal Server Error:** An unexpected error occurred on the server.

## Testing

Explain how to run the tests for your API.

```bash
# Example command for running tests
php artisan test
```










