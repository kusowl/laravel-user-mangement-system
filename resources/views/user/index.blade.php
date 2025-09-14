<x-layout>
    @php
        $adminRole = \App\UserRoles::Admin->value;
        $userRole = \App\UserRoles::User->value;
        $currentUser = Auth::user();
    @endphp
    <div class="container">

        <!-- Header -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-2xl font-bold">Users</h1>

            <!-- Search + Filter -->
            <form method="GET" action="{{ route('user.index') }}" class="mt-4 flex flex-wrap gap-2 sm:mt-0">
                <!-- Search -->
                <input type="text" name="search_key" placeholder="Search by name or email"
                    value="{{ request('search') }}" class="input input-bordered w-full sm:w-64" />

                <!-- Role Filter -->
                <select name="role" class="select select-bordered w-full sm:w-40">
                    <option value="">All Roles</option>
                    <option value="{{ $adminRole }}" {{ request('role') == $adminRole ? 'selected' : '' }}>Admin
                    </option>
                    <option value="{{ $userRole }}" {{ request('role') == $userRole ? 'selected' : '' }}>User
                    </option>
                </select>

                <!-- Sort -->
                <select name="sort" class="select select-bordered w-full sm:w-40">
                    <option value="">Sort By</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="email" {{ request('sort') == 'email' ? 'selected' : '' }}>Email</option>
                    <option value="role" {{ request('sort') == 'role' ? 'selected' : '' }}>Role</option>
                </select>

                <button class="btn btn-primary" type="submit">Apply</button>
            </form>
        </div>
        <!-- Users Table -->
        <div class="rounded-box border-base-content/5 overflow-x-auto border">
            <table class="table-zebra table w-full">
                <thead>
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">Role</th>
                        @canany(['delete', 'disable'], $currentUser)
                            <th class="text-center">Actions</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="font-medium">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span
                                    class="badge badge-soft {{ $user->role == $adminRole ? 'badge-secondary' : 'badge-primary' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="flex justify-end gap-2">
                                <!-- Deactivate -->
                                @can('disable', $currentUser)
                                    <form action="{{ route('user.deactivate', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-warning">Deactivate</button>
                                    </form>
                                @endcan
                                @can('delete', $currentUser)
                                    <!-- Delete -->
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-error">Delete</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->appends(request()->query())->links() }}
        </div>

    </div>
</x-layout>
