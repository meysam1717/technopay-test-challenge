# TechnoPay Test Challenge


## Installation

Follow these steps to set up and run Project.

Use Specification Pattern for Order filtering in this test case but there is another options like
- Chain of responsibility pattern
- Using Laravel's scope functions

Or for Mocking SMS and Mail Services we can Provide mock mail or sms driver rather than Mock services that I provide

### Prerequisites

Before you begin, ensure you have the following software installed on your system:

- [Docker](https://www.docker.com/)

### Step 1: Clone the Repository

```
git clone https://github.com/meysam1717/technopay-test-challenge
cd technopay-test-challenge
```

### Step 3: Initialize the .env and .env.testing File

```
cp .env.example .env
cp .env.testing.example .env.testing
```

### Step 4: Start the Docker Containers
Start the development environment using Docker Sail:

```
./vendor/bin/sail up -d
```

### Step 5: Generate an Application Key
Generate a unique application key:

```
./vendor/bin/sail artisan key:generate
```

### Step 6: Run Migrations
Migrate the database tables:

```
./vendor/bin/sail artisan migrate
```

### Step 6: Run Seeders If Needed
Migrate the database tables:

```
./vendor/bin/sail artisan db:seed
```



## License
This project is open-source and available under the MIT License.
