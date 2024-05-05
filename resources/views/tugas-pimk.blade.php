<x-app-layout>
    <div class="flex">
        <table class="dark:text-gray-100 mx-auto w-9/12 mt-4">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Verified</th>
            </tr>@dd($users)
            @foreach($users as $user)@dd($user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->email_verified_at == NULL)
                            No
                        @else
                            Yes
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    @push('scripts')
        <script>
            cons test = document.getElementById("test");
        </script>
    @endpush
</x-app-layout>