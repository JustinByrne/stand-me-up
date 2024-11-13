# Stand me up

This project helps generate stand-up responses by fetching time entries from
[Clockify](https://clockify.me/). It utilizes the Clockify API to gather
information about your tasks and automatically generates a stand-up report.

## Features
- Fetches time entries from Clockify.
- Generates stand-up responses based on your activity.
- Requires minimal setup using environment variables.

## Prerequisites
- [Node.js](https://nodejs.org/)
- [PHP](https://www.php.net/)
- A Clockify account with an API key.

## Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/JustinByrne/stand-me-up
cd ./stand-me-up
```

### 2. Install Dependencies

Make sure to run the following command to install all necessary dependencies:

```bash
npm install
composer install
```

### 3. Set up Environment Variables

Create a `.env` file in the root directory and add your Clockify credentials:

```bash
cp .env.example .env
php artisan key:generate
```

Then update the following

```env
CLOCKIFY_API_KEY="your_clockify_api_key"
CLOCKIFY_USER_ID="your_clockify_user_id"
CLOCKIFY_WORKSPACE_ID="your_clockify_workspace_id"

REPO_URL="repo_url_used_to_link_issues"
```

#### How to get your Clockify API Key

1. Log in to your Clockify account.
2. Go to the [Clockify Profile Settings](https://clockify.me/user/settings).
3. Scroll down to the **API** section and copy your API key.

#### How to get your User ID and Workspace ID

1. Once you've added your Clockify API Key to the `.env` file, start your
application.
2. Visit the `/ids` route in your browser (e.g., http://localhost:8000/ids).
3. Copy the `user_id` and `workspace_id` from the displayed results.

### 4. Setup the Database

The application can use SQLite to make it easier to run, when running the
following, make sure to allow the application to create the database for you.

```bash
php artisan migrate
```

### 5. Run the Application

```bash
composer run dev
```

### 6. Generate Stand-up Report

By default the home page will show yesterdays entries, however the date can be
changed to get an alternative date.

## Basic Usage

By default the application with format the description of a time entry and wrap
the issue number within an anchor tag, this is based on a `ABC-123` style issue
number.

Additionally the application will change descriptions of testing and pr review
tasks accordingly, however, if the task names don't match these can be added
into the `.env` file as a lower case comma separated list as needed.

```env
CLOCKIFY_TESTING_TASKS="testing,acceptance testing"
CLOCKIFY_REVIEWING_TASKS="pr review"
```

## License
This project is licensed under the [MIT License](LICENSE).

## Support
If you encounter any issues, feel free to open a
[GitHub Issue](https://github.com/JustinByrne/stand-me-up/issues).

## Acknowledgements
- [Clockify API Documentation](https://clockify.me/developers-api)
- [Laravel Documentation](https://laravel.com/docs)
- [Node.js Documentation](https://nodejs.org/en/docs/)