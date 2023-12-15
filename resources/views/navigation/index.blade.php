<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Nav Management') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <a class="btn border btn-xs" href="{{ explode('?', $_SERVER['REQUEST_URI'])[0] }}"><i class="fa fa-sync"></i>
                Refresh</a>
            <div class="col-3 float-right">
                <form action="{{ $_SERVER['REQUEST_URI'] }}" id="formSearch">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="q"
                            aria-label="Search" value="{{ !empty($q) ? $q : '' }}" aria-describedby="basic-addon1">
                        <div class="input-group-prepend">
                            <button class="input-group-text btn btn-default" id="basic-addon1"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <h3>List Menu</h3>
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                            href="#list-home" role="tab" style="padding:8px;" aria-controls="home">1. Home</a>
                            @php
                                $n=2;
                            @endphp
                        @foreach ($navs as $nav)
                            <a class="list-group-item list-group-item-action" id="list-nav-{{ $nav->nav_id }}"
                                data-toggle="list" href="#nav-{{ $nav->nav_id }}" role="tab" style="padding:8px;"
                                aria-controls="{{ $nav->nav_id }}">{{ $n++.'. '.$nav->nav_name }} <span
                                    class="badge badge-secondary">{{ $nav->nav_type == 'normal' ? '' : 'Dropdown' }}</span></a>
                        @endforeach
                        <a class="list-group-item" role="button" data-toggle="modal" data-target="#addMenuModal">+
                            Tambah menu</a>
                    </div>
                </div>
                <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                            aria-labelledby="list-home-list">
                            Data tidak bisa dirubah</div>
                        {{-- @dd($navs[0]->navlinks) --}}
                        @foreach ($navs as $nav)
                            <div class="tab-pane fade" id="nav-{{ $nav->nav_id }}" role="tabpanel"
                                aria-labelledby="list-nav-{{ $nav->nav_id }}">

                                <div class="row" style="display: flex; justify-content: space-between; align-items: center">
                                    <div class="col-4">
                                        <p style="float: left">Order priority
                                            <a href="{{route('nav.up', ['id'=>$nav->nav_id])}}"><i class="fa fa-arrow-up"></i></a>
                                            <a href="{{route('nav.down', ['id'=>$nav->nav_id])}}"><i class="fa fa-arrow-down"></i></a>
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-end">
                                            <a class="" role="button" onclick="fillNavId('{{$nav->nav_id}}','{{$nav->nav_name}}')" data-toggle="modal" data-target="#modalEditNav"> <i class="fa fa-edit"></i></a>
                                            <a class="delete-btn  text-danger" href="{{route('nav.delete', ['id'=>$nav->nav_id])}}"> <i class="fa fa-trash"></i></a>
                                            
                                        </p>
                                    </div>
                                </div>

                                <p style="display: inline-block;"><b>Contains rubrik: </b></p>
                                <ol class="list-group col-lg-5 col-md-5">
                                    @foreach ($nav->navlinks as $links)
                                        <li class="list-group-item"><i class="fa fa-arrow-right"></i> {{ $links->rubrik->rubrik_name }}</li>
                                    @endforeach
                                    @if ($nav->nav_type == 'dropdown')
                                        <li><a href="#" role="button" data-toggle="modal"
                                                data-target="#addRubrik" onclick="fillNavId('{{ $nav->nav_id }}')">+
                                                Tambah rubrik</a></li>
                                    @endif
                                </ol>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Modals add menu --}}

    <div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMenuModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('nav.add') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="type">Jenis menu</label>
                            <select name="nav_type" id="navTypeInput" class="form-control">
                                <option value="normal">Normal</option>
                                <option value="dropdown">Dropdown</option>
                            </select>
                        </div>

                        <div class="form-group mb-2" id="navRubrik">
                            <label for="rubrik">link to rubrik</label>
                            <select name="nav_rubrik" id="navRubrikInput" class="form-control">
                                @foreach ($rubriks as $rubrik)
                                    <option value="{{ $rubrik->rubrik_id }}">{{ $rubrik->rubrik_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="nav">Nama menu</label>
                            <input type="text" name="nav_name" class="form-control" required autocomplete="off">
                        </div>

                        <div class="form-group mb-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal add rubrik --}}
    <div class="modal fade" id="addRubrik" tabindex="-1" role="dialog" aria-labelledby="addRubrikLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRubrikLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('nav.addRubrik')}}" method="POST">
                    @csrf
                    <input type="hidden" name="nav_id" id="nav_id" class="form-control" required
                    autocomplete="off" id="navId">

                    @foreach ($rubriksAll as $rubrik)
                    <div class="form-check mb-2">
                        <input class="form-check-input" name="rubriks[]" type="checkbox" value="{{$rubrik->rubrik_id}}" id="flexCheck{{$rubrik->rubrik_id}}">
                        <label class="form-check-label" for="flexCheck{{$rubrik->rubrik_id}}">
                            {{$rubrik->rubrik_name}}
                        </label>
                    </div>
                    @endforeach
                    <div class="form-group mb-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" id="addRubrikButton" class="btn btn-primary">Simpan</button>
                        
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

        {{-- Modal edit rubrik --}}
        <div class="modal fade" id="modalEditNav" tabindex="-1" role="dialog" aria-labelledby="modalEditNavLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditNavLabel">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('nav.update')}}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" name="nav_id" id="nav_id_edit" class="form-control" required
                    autocomplete="off" id="navId">

                    <div class="form-group">
                        <label for="nav_name">Nama Menu</label>
                        <input type="text" name="nav_name" id="nav_name_edit" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" id="modalEditNavButton" class="btn btn-primary">Simpan</button>
                        
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    @push('custom-scripts')
        <script>
            function fillNavId(id, name=null) {
                $.get('{{url('/nav/list_rubrik')}}/'+id, {}, (res)=>{
                    res.forEach(element => {
                        console.log(element.rubrik_id)
                        $('#flexCheck'+element.rubrik_id).attr('checked', true)
                    });
                })
                $('#nav_id').val(id)
                $('#nav_id_edit').val(id)
                $('#nav_name_edit').val(name)
            }
            document.addEventListener("DOMContentLoaded", () => {
                //  fill id
                $('#navTypeInput').on('change', () => {
                    navType = $('#navTypeInput').val()
                    if (navType == 'normal') {
                        $('#navRubrik').show();
                    } else {
                        $('#navRubrik').hide();
                    }
                });
                @if(Session::has('last_load'))
                   $('#list-nav-{{ session('last_load') }}').click() 
                @endif
                $('#listMenu').Treeview()
            });
        </script>
    @endpush
</x-app-layout>
