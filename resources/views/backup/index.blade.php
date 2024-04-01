<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Backup/Restore') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary btn-xs" id="backup-btn" href="{{route('backup.create')}}"><i
                    class="fa fa-plus"></i>Backup</a>
                    <a class="btn border btn-xs" href="{{ explode('?',$_SERVER['REQUEST_URI'])[0] }}"><i class="fa fa-sync"></i> Refresh</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-sm">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Database</th>
                        <th>Assets</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($backups as $backup)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $backup->name }}</td>
                            <td>{{ $backup->size }}</td>
                            <td>
                                <a class="btn btn-default"
                                    href="{{ Storage::disk('s3')->temporaryUrl($backup->name . '/' .    'database_'.$backup->name . '.sql', now()->addHours(12)) }}"><i class="fa fa-download"></i></a>
                            </td>
                            <td>
                                <a class="btn btn-default"
                                    href="{{ Storage::disk('s3')->temporaryUrl($backup->name . '/' .    'assets_'.$backup->name . '.zip', now()->addHours(12)) }}"><i class="fa fa-download"></i></a>
                            </td>
                            <td>
                                <a class="btn btn-danger"
                                    href="{{ route('backup.delete', ['backupFilename' => $backup->name]) }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>
