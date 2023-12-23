<x-app-layout>
    <div class="card mt-1">
        <form action="{{route('assets.video.update')}}" method="POST">
        @csrf
        @method('PUT')
            <div class="card-body">
                <div class="col-12">
                    <iframe style="width: 100%; height:320px" class="mb-3" src="https://www.youtube.com/embed/{{getYoutubeData($video->url)->id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                <div class="form-group">   
                    <input type="hidden" id="video_id" name="video_id" value="{{$video->video_id}}">
                    <label>Title</label>
                    <input autocomplete="off" type="text" id="title" name="title" class="form-control" value="{{$video->title}}">
                </div>
                <div class="form-group">   
                    <label>Description</label>
                    <textarea required class="form-control" name="description" id="description" cols="30" rows="10">{{$video->description}}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary text-white bg-primary" type="submit" name="submit">Save</button>
                <a href="{{route('assets.video.index')}}" class="btn btn-default">Close</a>
            </div>
        </form>
    </div>
</x-app-layout>