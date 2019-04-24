<style>
    table { border-collapse: collapse; width: 100%; }
    table, th, td { border: 1px solid black; }
    th, td { padding: 5px; }
</style>

<table>
    <tr>
        <th>SL</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
    </tr>

    @php($i=1)
    @foreach ($users as $user)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
        </tr>
    @endforeach

</table>
