<x-app-layout>


    <div class="card">

        <div class="card-body table-responsive">
            <table class="table table-sm">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Rubrik</th>
                        <th>Author</th>
                        <th>Editor</th>
                        <th>Date Created</th>
                        <th>Date Published</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td class="text-left">{{ $post->title }}</td>
                            <td><span class="badge badge-primary">{{ $post->status }}</span></td>
                            <td><span class="badge badge-secondary">{{ $post->rubrik->rubrik_name }}</span></td>
                            <td>{{ $post->author->display_name }}</td>
                            <td>{{ $post->editor->display_name }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->published_at }}</td>
                            <td>
                                <button class="btn btn-default btn-sm" onclick="select_article('{{$post->post_id}}')">Choose</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('custom-scripts')
        <script>
            function select_article(post_id)
            {
                window.parent.change_article(post_id)
            }
        </script>
    @endpush

</x-app-layout>
