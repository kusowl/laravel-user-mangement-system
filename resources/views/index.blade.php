<x-layout>
    <header>
        <h1>
            Laravel User Management System
        </h1>
        <p>
            A scalable User Management System (toy) built with Laravel, designed to simplify user administration and
            role-based access control.
        </p>
    </header>
    <h2>
        Features
    </h2>

    <div class="rounded-box border-base-content/5 bg-base-100 overflow-x-auto border">
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th>Feature</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Admin Dashboard</th>
                    <td>Admins can view, edit, and manage all users.</td>
                </tr>
                <tr>
                    <th>Authentication</th>
                    <td>Manual authentication using Laravel's Auth Facade.</td>
                </tr>
                <tr>
                    <th>Authorization</th>
                    <td>Admins have separate permission for user management, implemented using Laravel's Policy and
                        Gate.</td>
                </tr>

                <tr>
                    <th>Profile Management</th>
                    <td>Users can update their profiles, change passwords, and upload avatars.</td>
                </tr>
                <tr>
                    <th>Role-Based Access Control</th>
                    <td>Assign roles (Admin, User) and permissions to users.</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layout>
