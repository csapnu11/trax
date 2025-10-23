<x-app-layout>
    <h1 class="text-2xl font-semibold text-indigo-600">Admin Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}. Only admins can access this page.</p>
</x-app-layout>
