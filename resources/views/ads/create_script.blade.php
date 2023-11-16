<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Ads Management - Create Scripts') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Buat Script Ads</h3>
        </div>
        <div class="card-body">
            <div class="col-md-6 mx-auto">
                <form method="POST" enctype="multipart/form-data" action="{{route('ads.store_script')}}">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="formTitle">Title <sup>*</sup></label>
                        <input type="hidden" name="type" value="html" required> 
                        <input type="text" name="title" id="formTitle" class="form-control" required> 
                    </div>
                    <div class="form-group mb-2" id="formScript" >
                        <label for="formImage">Isi script</label>
                        <textarea name="value" id="script" class="form-control" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary form-control"> 
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('custom-scripts')
    
    @endpush
</x-app-layout>
