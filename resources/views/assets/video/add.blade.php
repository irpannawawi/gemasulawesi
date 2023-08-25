<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Video') }}
        </h2>
    </x-slot>
    <div class="card">
        <form action="{{route('assets.video.insert')}}" method="POST">
        @csrf
            <div class="card-body">
                <div class="form-group">   
                    <input type="hidden" id="uploader_id" name="uploader_id" value="{{Auth::user()->id}}">
                    <label>Youtube Url</label>
                    <input autocomplete="off" type="text" id="input_url" name="input_url" class="form-control" value="">
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary text-white bg-primary" type="submit" name="submit">Save</button>
                <a href="{{route('assets.video.index')}}" class="btn btn-default">Close</a>
            </div>
        </form>
    </div>
</x-app-layout>