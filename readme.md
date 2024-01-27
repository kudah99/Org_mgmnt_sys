# Organisation Management System - Interview task

## Introduction

This project is an exciting interview application assignment to test expertise
in web development and mobile app synchronization. This is an comprehensive guide on setting up a  Laravel web application,
a Flutter mobile application, and a Docker environment for the Laravel application.
The Laravel web application serves as the backend, providing APIs for the Flutter mobile application.

### Interview project tasks
- <b>PHASE1: WEB DEVELOPMENT TASKS:</b>
  - [X] Implement a registration system for members of the organisation with basic details
  - [X] Create a searchable member directory
- <b>PHASE 2: MOBILE DEVELOPMENT TASKS (FLUTTER)</b>
  - [X] Implement a basic system to record member contributions.
  - [X] Create a view to display individual contribution statements.

## Laravel Web Application

### Prerequisites

- PHP >= 7.3
- Composer
- Postgres
- Docker (Optional)
- Laravel CLI

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/kudah99/Org_mgmnt_sys.git
   # you can checkout into other branches for specific feature  
   # To view other branches run git branch
   ```

2. Navigate to the project directory:

   ```bash
   cd web_app
   ```

3. Install dependencies:

   ```bash
   composer install
   ```

4. Create a copy of the `.env.example` file and rename it to `.env`. Update the database configuration with your credentials.

   ```bash
   cp .env.example .env
   ```

5. Generate the application key:

   ```bash
   php artisan key:generate
   ```

7. Start the development server:

   ```bash
   php artisan serve
   ```
### Optional docker Setup for Laravel

#### Prerequisites

- Docker
- Docker Compose

#### Setup

1. Navigate to the Laravel project directory.

   ```bash
   cd web_app
   ```

2. Build and run the Docker containers:

   ```bash
   docker-compose up -d --build
   ```

3. Visit [http://localhost:8000](http://localhost:8000) to access your Laravel web application.


### Live Demo

Visit the live demo of the Laravel app at [Your Laravel App Live Demo](https://oms-ivory.vercel.app/).

### API Documentation

Explore the API documentation at [API Documentation](https://oms-ivory.vercel.app/docs).

## Flutter Mobile Application

### Prerequisites

- Flutter SDK
- Dart SDK
- Android Studio / Xcode for emulator or physical devices

### Installation

1. Clone the Flutter project:

   ```bash
   git clone https://github.com/kudah99/Org_mgmnt_sys.git
   ```

2. Navigate to the project directory:

   ```bash
   cd mobile_app
   ```

3. Install dependencies:

   ```bash
   flutter pub get
   ```

4. Run the app:

   ```bash
   flutter run
   ```

### APK Download

Download the Flutter APK at [Your Flutter App APK](https://drive.google.com/file/d/1d-XXCiJrcFVmVQS3zG7oJxKHUXMwbNSd/view?usp=sharing).


