<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{number_format($countPublished*1000, 0,',','.')}}</h3>

              <p>Published</p>
            </div>
            <div class="icon">
              <i class="fa fa-check-square"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{number_format($countScheduled, 0,',','.')}}</h3>

              <p>Scheduled</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{number_format($countDraft, 0,',','.')}}</h3>

              <p>Draft</p>
            </div>
            <div class="icon">
              <i class="fa fa-copy"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{number_format($countTrash, 0,',','.')}}</h3>

              <p>Trash</p>
            </div>
            <div class="icon">
              <i class="fa fa-trash"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
</x-app-layout>
