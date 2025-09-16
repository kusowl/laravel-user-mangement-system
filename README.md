
# Laravel User Management System

*A scalable User Management System (toy) built with Laravel, designed to simplify user administration and role-based access control.*

---

## Features

| Feature                | Description                                                                                     |
|------------------------|-------------------------------------------------------------------------------------------------|
| Admin Dashboard        | Admins can view, edit, and manage all users.                                                   |
| Authentication         | Manual authentication using Laravel's Auth Facade.                                            |
| Authorization          | Admins have separate permission for user management, implemented using Laravel's Policy and Gate. |
| Profile Management     | Users can update their profiles, change passwords, and upload avatars.                         |
| Role-Based Access Control | Assign roles (Admin, User) and permissions to users.                                        |

## Tech Stack



| Laravel      | PHP         | Tailwind CSS | Vite        | Axios       | daisyUI |
|--------------|-------------|--------------|-------------|-------------|---------|
| <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" width="50" height="50" /> | <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg" width="50" height="50" /> | <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg" width="50" height="50" /> | <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vitejs/vitejs-original.svg" width="50" height="50" /> | <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/axios/axios-plain.svg" width="50" height="50" /> | <img src="https://img.daisyui.com/images/daisyui/mark-static.svg" width="50" height="50" /> |
| v12.0        | v8.4       | v4        | v7.0.4       | v2.11        | v5.1.6   |

## Installation

1. **Clone the repository:**
```bash
    git clone https://github.com/kusowl/laravel-user-mangement-system.git
    cd laravel-user-mangement-system
```
   
2. **Install dependencies:**
```bash
   composer install
   npm install
```
   
3.**Set up environment variables:**
   
```bash
    cp .env.example .env
    php artisan key:generate
```
    
4.**Run migrations and seeders:**
 ```bash
     php artisan migrate --seed
```
    
5. **Compile frontend assets and start the development server:**
 ```bash
    composer run dev
```
     
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
