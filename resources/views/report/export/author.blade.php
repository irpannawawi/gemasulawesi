
            <table class="table table-sm table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Editor</th>
                        <th>Articles</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $n = 1;
                        $total = 0;
                    @endphp
                    @foreach ($users as $user)
                        @php
                            $total += $user->posts->count();
                        @endphp
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $user->display_name }}</td>
                            <td>{{ $user->posts->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="text-center">
                    <tr>
                        <th colspan="2">Total</th>
                        <th>{{ $total }}</th>
                    </tr>
                </tfoot>
            </table>
